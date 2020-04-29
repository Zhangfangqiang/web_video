<?php

namespace App\Policies\Web;

use App\Models\User;
use App\Models\Content;
use App\Models\UserHasContent;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * 用户点赞内容
     * @param User $originalUser
     * @param User $targetUser
     */
    public function awesome(User $originalUser, Content $content)
    {
        #没有自己操作自己的内容
        if ($originalUser->id === $content->user_id) {
            return false;
        }

        return !(UserHasContent::where('user_id', $originalUser->id)->where('content_id', $content->id)->where('type','AWESOME')->count() > 0);
    }

    /**
     * 用户取消点赞内容
     * @param User $originalUser
     * @param Content $content
     * @return bool
     */
    public function cancelAwesome(User $originalUser, Content $content)
    {
        #没有自己操作自己的内容
        if ($originalUser->id === $content->user_id) {
            return false;
        }

        return (UserHasContent::where('user_id', $originalUser->id)->where('content_id', $content->id)->where('type','AWESOME')->count() > 0);
    }

    /**
     * 用户收藏内容
     * @param User $originalUser
     * @param User $targetUser
     */
    public function favorite(User $originalUser, Content $content)
    {
        #没有自己操作自己的内容
        if ($originalUser->id === $content->user_id) {
            return false;
        }

        return !(UserHasContent::where('user_id', $originalUser->id)->where('content_id', $content->id)->where('type','FAVORITE')->count() > 0);
    }

    /**
     * 用户取消收藏内容
     * @param User $originalUser
     * @param Content $content
     * @return bool
     */
    public function cancelFavorite(User $originalUser, Content $content)
    {
        #没有自己操作自己的内容
        if ($originalUser->id === $content->user_id) {
            return false;
        }

        return (UserHasContent::where('user_id', $originalUser->id)->where('content_id', $content->id)->where('type','FAVORITE')->count() > 0);
    }
}
