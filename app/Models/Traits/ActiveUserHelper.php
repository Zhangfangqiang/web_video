<?php
namespace App\Models\Traits;

use DB;
use Arr;
use Cache;
use Carbon\Carbon;
use App\Models\Content;
use App\Models\Comment;

trait ActiveUserHelper
{
    #用于存放临时用户数据
    protected $users = [];

    #配置信息
    protected $content_weight = 4;   #内容权重
    protected $comment_weight = 1;     #回复权重
    protected $pass_days    = 7;     #多少天内发表过内容
    protected $user_number  = 6;     #取出来多少用户

    #缓存相关配置
    protected $cache_key               = 'larabbs_active_users';
    protected $cache_expire_in_seconds = 65 * 60;

    /**
     * 从缓存中取出权重的方法
     * 如果缓存中没有就另行计算
     * @return mixed
     */
    public function getActiveUsers()
    {
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function(){
            return $this->calculateActiveUsers();
        });
    }

    /**
     * 直接获得用户权重并且缓存
     */
    public function calculateAndCacheActiveUsers()
    {
        #取得活跃用户列表
        $active_users = $this->calculateActiveUsers();
        #加以缓存
        $this->cacheActiveUsers($active_users);
    }

    /**
     * 将数据缓存的方法
     * @param $active_users
     */
    private function cacheActiveUsers($active_users)
    {
        Cache::put($this->cache_key, $active_users, $this->cache_expire_in_seconds);
    }

    /**
     * 计算权重的并且排序的方法
     * @return \Illuminate\Support\Collection
     */
    private function calculateActiveUsers()
    {
        $this->calculateContentScore();
        $this->calculateCommentScore();

        $users        = Arr::sort($this->users, function ($user) {return $user['score'];});          #数组按照得分排序
        $users        = array_reverse($users, true);                                    #我们需要的是倒序，高分靠前，第二个参数为保持数组的 KEY 不变
        $users        = array_slice($users, 0, $this->user_number, true);        #只获取我们想要的数量
        $active_users = collect();                                                                   #新建一个空集合

        foreach ($users as $user_id => $user) {
            #找寻下是否可以找到用户
            $user = $this->find($user_id);
            #如果数据库里有该用户的话
            if ($user) {
                #将此用户实体放入集合的末尾
                $active_users->push($user);
            }
        }
        #返回数据
        return $active_users;
    }

    /**
     * 获得内容权重的方法
     */
    private function calculateContentScore()
    {
        /**
         * 从话题数据表里取出限定时间范围（$pass_days）内，有发表过话题的用户
         * 并且同时取出用户此段时间内发布话题的数量
         */
        $content_users = Content::query()->select(DB::raw('user_id, count(*) as content_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        #根据话题数量计算得分
        foreach ($content_users as $value) {
            $this->users[$value->user_id]['score'] = $value->content_count * $this->content_weight;
        }
    }

    /**
     * 计算评论权重的方法
     */
    private function calculateCommentScore()
    {
        /**
         * 从回复数据表里取出限定时间范围（$pass_days）内，有发表过回复的用户
         * 并且同时取出用户此段时间内发布回复的数量
         */
        $reply_users = Comment::query()->select(DB::raw('user_id, count(*) as comment_count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        #根据回复数量计算得分
        foreach ($reply_users as $value) {
            $reply_score = $value->reply_count * $this->comment_weight;
            if (isset($this->users[$value->user_id])) {
                $this->users[$value->user_id]['score'] += $reply_score;
            } else {
                $this->users[$value->user_id]['score'] = $reply_score;
            }
        }
    }
}
