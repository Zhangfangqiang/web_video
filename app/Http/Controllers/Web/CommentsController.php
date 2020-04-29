<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Web\CommentRequest;
use App\Notifications\Web\CommentReplyNotification;
use App\Notifications\Web\ContentCommentsNotification;

class CommentsController extends Controller
{
    /**
     * 创建评论的方法
     * @param CommentRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CommentRequest $request)
    {
        if (!\Auth::check()) {                                                  #如果你没有登录
            if (!\Auth::attempt($request->only('email','password'))) {    #并且登录失败
                return redirect(redirect()->back()->getTargetUrl() . '#zf-comment-list')->withErrors('用户名或密码错误');
            }
        }

        $data = $request->only('content', 'captcha', 'commentable_type', 'commentable_id', 'parent_id');

        #如果是对评论回复就多出这一步骤  ^_^ 略略略
        if (!is_null($data['parent_id'])) {
            $parentComment      = Comment::find($data['parent_id']);
            $data['to_user_id'] = $parentComment->user_id;
        }

        $comment         = Comment::create($data);
        #评论对应的文章文章属于的用户      这里是内容评论通知
        $comment->commentable->user->excludeOwnNotify(new ContentCommentsNotification($comment));

        #如果是对评论回复就多出这一步骤  ^_^ 略略略
        if (!is_null($data['parent_id'])) {
            $parentComment->user->excludeOwnNotify(new CommentReplyNotification($comment));
        }

        return redirect(redirect()->back()->getTargetUrl() . '#zf-comment-list');
    }
    
    /**
     * 删除评论的方法
     * @param Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('post-data', $comment);
        $comment->delete();                                 #删除数据
        return response(['url' => redirect()->back()->getTargetUrl()], 200);
    }
}
