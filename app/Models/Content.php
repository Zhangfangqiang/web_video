<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\GetPublicData;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use Searchable, GetPublicData;

    /**
     * 定义表格
     * @var string
     */
    protected $table    = 'contents';

    /**
     * 设计可填充的字段
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_comment', 'is_top', 'is_recommended', 'type',
        'watch_count', 'favorite_count', 'like_count', 'comment_count', 'title', 'seo_key', 'excerpt', 'source',
        'content', 'img', 'video', 'more', 'release_at', 'delete_at',
    ];

    /**
     * 定义文件索引名称
     * 你需要添加
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'contents';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

    /**
     * 获取该文章作者
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 该文章属于哪个分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        /**
         * 第一个参数：要关联的表对应的类
         * 第二个参数：中间表的表名
         * 第三个参数：当前表跟中间表对应的外键
         * 第四个参数：要关联的表跟中间表对应的外键
         */
        return $this->belongsToMany('App\Models\Category','category_has_contents','content_id','category_id');
    }

    /**
     * 多态 一对多 获取评论
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * 返回新的连接
     * @param array $params
     * @return string
     */
    public function link($params = [])
    {
        return route('web.contents.show', array_merge([$this->id, $this->english_title], $params));
    }

    /**
     * 内容有多少人关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationUser()
    {
        return $this->belongsToMany(Content::class,'user_has_contents','content_id','user_id');
    }

    /**
     * 我点赞的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function awesomeUser()
    {
        return $this->relationUser()->wherePivot('type','AWESOME');
    }

    /**
     * 我收藏的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteUser()
    {
        return $this->relationUser()->wherePivot('type','FAVORITE');
    }
}
