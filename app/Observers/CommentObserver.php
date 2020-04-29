<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Content;

/**
 * retrieved, restoring, restored,
 * creating, created, updating, updated, saving, saved, deleting, deleted,
 * Class CommentObserver
 * @package App\Observers\Web
 */
class CommentObserver
{
    /**
     * 在数据创建前
     * @param Comment $comment
     */
    public function creating(Comment $comment)
    {
        $comment->status  = 1;
        $comment->user_id = \Auth::user()->id;
        $comment->content = clean($comment->content);
        app($comment->commentable_type)->where('id', $comment->commentable_id)->increment('comment_count', 1);      #评论加1
    }
}
