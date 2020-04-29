<?php

namespace App\Listeners\Web;

use App\Models\User;
use Illuminate\Auth\Events\Login;                                  #获取注册事件

class RecordLoginTime
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        User::where('id', $event->user->id)->update(['last_login_at' => now()]);        #更新登录时间
    }
}
