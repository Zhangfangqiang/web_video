<div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
  <div class="list-group">
    <a class="list-group-item list-group-item-action {{active_class( if_route('web.notifications.index')   && Request::input('type') == 'App\Notifications\ContentCommentsNotification' )}}" href="{{ route('web.notifications.index', ['type'=> 'App\Notifications\ContentCommentsNotification']) }}">
      内容评论通知
      @php
       $contentComments = Auth::user()->unreadNotificationsType('App\Notifications\ContentCommentsNotification')->count()
      @endphp
      <span class="badge badge-danger float-right" {{ $contentComments > 0 ? '' : 'hidden' }} >{{ $contentComments }}</span>
    </a>
    <a class="list-group-item list-group-item-action {{active_class( if_route('web.notifications.index')   && Request::input('type') == 'App\Notifications\CommentReplyNotification' )}}"    href="{{ route('web.notifications.index', ['type'=> 'App\Notifications\CommentReplyNotification'] ) }}">
      评论回复通知
      @php
       $commentReply = Auth::user()->unreadNotificationsType('App\Notifications\CommentReplyNotification')->count()
      @endphp
      <span class="badge badge-danger float-right" {{ $commentReply > 0 ? '' : 'hidden' }} >{{ $commentReply }}</span>
    </a>
  </div>
</div>
