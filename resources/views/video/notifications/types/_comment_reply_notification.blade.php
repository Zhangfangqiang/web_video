<li class="media  ">
  <div class="media-left">
    <a href="{{ route('web.users.show', $notification->data['comment_user_id']) }}">
      <img class="media-object img-thumbnail mr-3" alt="{{ $notification->data['comment_user_name'] }}" src="{{ imgRe( $notification->data['comment_user_avatar'] , 400 , 400 ) }}" style="width:48px;height:48px;" />
    </a>
  </div>

{{--  @dd($notification->data)--}}

  <div class="media-body">
    <div class="media-heading mt-0 mb-1 text-secondary">
      <a href="{{ route('web.users.show', $notification->data['comment_user_id']) }}">{{ $notification->data['comment_user_name'] }}</a>
      回复了你写的评论
      <a href="{{ $notification->data['prent_comment_link'] }}">{{ $notification->data['prent_comment_content'] }}</a>

      {{--通知时间开始--}}
      <span class="meta float-right" title="{{ $notification->created_at }}">
        <i class="far fa-clock"></i>
        {{ $notification->created_at->diffForHumans() }}
      </span>
      {{--通知时间结束--}}
    </div>
    <div class="reply-content">
      {!! $notification->data['comment_content'] !!}
    </div>
  </div>
</li>

@if(!$loop->last)
  <hr class="mt-1 mb-1">
@else
  <br>
@endif
