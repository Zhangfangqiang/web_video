<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 获取评论数据
         */
        Blade::directive('comments', function ($expression) {
            return "<?php
                \$comments = new App\Models\Comment;
                \$comments = \$comments->getData(" . $expression . ");
            ?>
            ";
        });
        /**
         * 获取评论数据尾部标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endcomments' ,function (){
            return '';
        });

        /**
         * 获取通知数据
         */
        Blade::directive('notifications', function ($expression) {
            return "<?php
                \$notifications = new App\Models\Notification ;
                \$notifications = \$notifications->getData(" . $expression . ");
            ?>
            ";
        });
        /**
         * 获取通知数据尾部标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endnotifications' ,function (){
            return '';
        });

        /**
         * 活跃用户标签
         */
        Blade::directive('activeuser', function () {
            return "<?php
                \$user        = new App\Models\User ;
                \$activeusers = \$user->getActiveUsers();
            ?>
            ";
        });
        /**
         * 活跃用户标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endactiveuser' ,function (){
            return '';
        });

        /**
         * 获取分类数据标签
         */
        Blade::directive('category', function ($expression) {
            return "<?php
                \$categories = new App\Models\Category ;
                \$categories = \$categories->getData(" . $expression . ");
            ?>
            ";
        });
        /**
         * 获取分类数据标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endcategory' ,function (){
            return '';
        });

        /**
         * 获取内容数据标签
         */
        Blade::directive('content', function ($expression) {
            return "<?php
                \$contents = new App\Models\Content ;
                \$contents = \$contents->getData(" . $expression . ");
            ?>
            ";
        });
        /**
         * 获取内容数据标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endcontent' ,function (){
            return '';
        });


        /**
         * 获取内容数据标签
         */
        Blade::directive('link', function () {
            return "<?php
                \$links = new App\Models\Link ;
                \$links = \$links->getAllDate();
            ?>
            ";
        });
        /**
         * 获取内容数据标签
         * 这个可以没有但是我就是要好看的双标签 -_-!
         */
        Blade::directive('endlink' ,function (){
            return '';
        });
    }
}
