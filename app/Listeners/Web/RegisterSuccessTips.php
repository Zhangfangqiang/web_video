<?php

namespace App\Listeners\Web;

use Illuminate\Auth\Events\Registered;

class RegisterSuccessTips
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        #会话里闪存认证成功后的消息提醒
        session()->flash('success', '注册成功 ^_^');
    }
}
