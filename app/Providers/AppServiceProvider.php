<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Content::observe(\App\Observers\ContentObserver::class);            #模型观察者绑定
        \App\Models\User::observe(\App\Observers\UserObserver::class);                  #模型观察者绑定
        \App\Models\Comment::observe(\App\Observers\CommentObserver::class);            #模型观察者绑定
        \App\Models\NavMenu::observe(\App\Observers\NavMenuObserver::class);            #模型观察者绑定
    }
}
