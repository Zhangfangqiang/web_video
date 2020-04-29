<?php

namespace App\Notifications\Web;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContentCommentsNotification extends Notification implements  ShouldQueue
{
    use Queueable;

    /**
     * 构造参数
     *
     * @var Comment
     */
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * 通过写入数据库通知
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $content = $this->comment->commentable;                             #获取文章
        $link    =  $content->link(['#reply' . $this->comment->id]);        #通过内容找到该评论 估计评论多的话会有点困难

        #存入数据库里的数据
        return [
            'comment_id'            => $this->comment->id,
            'comment_content'       => $this->comment->content,
            'comment_user_id'       => $this->comment->user->id,
            'comment_user_name'     => $this->comment->user->name,
            'comment_user_avatar'   => $this->comment->user->avatar,
            'content_link'          => $link,
            'content_id'            => $content->id,
            'content_title'         => $content->title,
        ];
    }

    /**
     * 发送通知邮件
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->comment->commentable->link(['#reply' . $this->comment->id]);

        return (new MailMessage)
            ->line('你的话题有新回复！')
            ->action('查看回复', $url);
    }
}
