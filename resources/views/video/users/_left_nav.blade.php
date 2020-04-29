<div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
  <div class="card">
    <img class="card-img-top" src="{{imgRe($user->avatar , 400 , 400)}}" alt="{{ $user->name }}">
    <div class="card-body">
      <h5><strong>个人简介</strong></h5>
      <p>{{ $user->introduction }}</p>
      <hr>
      <h5><strong>注册于</strong></h5>
      <p>{{ $user->created_at->diffForHumans() }}</p>
    </div>
  </div>

  <div class="list-group mt-30">
    <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.show') )}}"                                                      href="{{ route('web.users.show', $user->id) }}">个人中心</a>
    <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.content_list')      && Request::input('type') == 'RELEASE' )}}"  href="{{ route('web.users.content_list' , ['user' => $user->id, 'type' => 'RELEASE' ]) }}">发布的内容</a>
    <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.comment_list') )}}"                                              href="{{ route('web.users.comment_list' , $user->id) }}">评论的内容</a>

    @can('user', $user)
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.relation_user')   && Request::input('type') == 'BEFOLLOW' )}}"                                      href="{{ route('web.users.relation_user'   , ['user' => $user->id , 'type'=>'BEFOLLOW'])  }}">我的粉丝</a>
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.relation_user')   && Request::input('type') == 'FOLLOW' )}}"                                        href="{{ route('web.users.relation_user'   , ['user' => $user->id, 'type'=>'FOLLOW' ]) }}">我关注的用户</a>
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.content_list')    && Request::input('type') == 'AWESOME' )}}"                                       href="{{ route('web.users.content_list' , ['user' => $user->id , 'type' => 'AWESOME' ]) }}">我点赞的内容</a>
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.content_list')    && Request::input('type') == 'FAVORITE' )}}"                                      href="{{ route('web.users.content_list' , ['user' => $user->id , 'type' => 'FAVORITE']) }}">我收藏的内容</a>
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.users.edit') )}}"                                                                                         href="{{ route('web.users.edit'            , $user->id) }}">编辑个人资料</a>
      <a class="list-group-item list-group-item-action {{active_class( if_route('web.notifications.index')   && Request::input('type') == 'App\Notifications\ContentCommentsNotification' )}}" href="{{ route('web.notifications.index'   , ['type' => 'App\Notifications\ContentCommentsNotification' ]) }}">
      消息通知
      <span class="badge badge-danger float-right" {{ $user->notification_count > 0 ? '' : 'hidden' }} >{{ $user->notification_count }}</span>
    </a>
    @endcan
  </div>
</div>
