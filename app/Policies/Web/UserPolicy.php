<?php

namespace App\Policies\Web;

use App\Models\User;
use App\Models\UserHasUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 判断是否拥有
     * @param User $originalUser
     * @param User $targetUser
     * @return bool
     */
    public function user(User $originalUser, User $targetUser)
    {
        return $originalUser->id === $targetUser->id;
    }

    /**
     * 用户关注授权
     * @param User $originalUser
     * @param User $targetUser
     * @return bool
     */
    public function attention(User $originalUser, User $targetUser)
    {
        #没有自己操作自己的
        if ($originalUser->id === $targetUser->id) {
            return false;
        }

        #如果数据库有就不让他关注
        return !(UserHasUser::where('user_id', $targetUser->id)->where('follow_user_id', $originalUser->id)->count() > 0);
    }

    /**
     * 取消用户关注授权
     * @param User $originalUser
     * @param User $targetUser
     * @return bool
     */
    public function cancelAttention(User $originalUser, User $targetUser)
    {
        #没有自己操作自己的
        if ($originalUser->id === $targetUser->id) {
            return false;
        }

        #如果存在跟随关系
        return (UserHasUser::where('user_id', $targetUser->id)->where('follow_user_id', $originalUser->id)->count() > 0);
    }
}
