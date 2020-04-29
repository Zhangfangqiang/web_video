<?php

namespace App\Observers;

use App\Models\User;


class UserObserver
{
    /**
     * 监听模型存储前的事件
     * @param User $user
     */
    public function saving(User $user)
    {
        #设置默认头像
        if (empty($user->avatar)) {
            $user->avatar = asset('/web/img/5.jpg');
        }
    }
}
