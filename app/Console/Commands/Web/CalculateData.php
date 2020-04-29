<?php

namespace App\Console\Commands\Web;

use App\Models\User;
use App\Models\Content;
use App\Models\UserHasContent;
use Illuminate\Console\Command;

class CalculateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:calculate-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '计算用户数据 , 如关注的用户 粉丝 点赞树';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        #用户计算
        User::all()->each(function($item){
            $data['be_follow_count']   = $item->beFollowUser()->count();
            $data['follow_count']      = $item->followUser()->count();

            $data['be_awesome_count']  = UserHasContent::whereIn('content_id',$item->contents()->get()->pluck('id'))->where('type','AWESOME')->count();
            $data['awesome_count']     = $item->awesomeContent()->count();

            $data['be_favorite_count'] = UserHasContent::whereIn('content_id',$item->contents()->get()->pluck('id'))->where('type','FAVORITE')->count();
            $data['favorite_count']    = $item->awesomeContent()->count();

            User::where('id', $item->id)->update($data);
        });

        #内容计算
        Content::all()->each(function($item){
            $data['comment_count']  = $item->comments()->count();
            $data['awesome_count']  = $item->awesomeUser()->count();
            $data['favorite_count'] = $item->favoriteUser()->count();

            Content::where('id', $item->id)->update($data);
        });
    }
}
