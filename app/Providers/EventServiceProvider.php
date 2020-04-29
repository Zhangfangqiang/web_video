<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        #注册事件监听
        \Illuminate\Auth\Events\Registered::class => [
            \App\Listeners\Web\SendEmailVerificationNotification::class,
            \App\Listeners\Web\RegisterSuccessTips::class,
        ],
        #验证邮件发送事件
        \Illuminate\Auth\Events\Verified::class => [
            \App\Listeners\Web\EmailVerified::class,
        ],
        #登录事件
        \Illuminate\Auth\Events\Login::class =>[
            \App\Listeners\Web\RecordLoginTime::class,
        ],

        #大型文件上传完成后的事件  作者事件名错了 T_T
        \App\Events\Vendor\AetherUploadBefore::class => [
            \App\Listeners\Vendor\UploadRecordsWrite::class
        ],

        #大型文件上传完成前事件  作者事件名错了 T_T
        \App\Events\Vendor\AetherUploadAfter::class => [

        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
