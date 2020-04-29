@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include('web.users._left_nav')
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      {{--一个简单的用户信息开始--}}
      <div class="card ">
        <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
          <div class="mt-2">
            <a>获赞数:{{$user->be_awesome_count}}</a>
            <a>给赞数:{{$user->awesome_count}}</a>
            <span>|</span>
            <a>粉丝:{{$user->be_follow_count}}</a>
            <a>关注数:{{$user->follow_count}}</a>
            <span>|</span>
            <a>被收藏:{{$user->be_favorite_count}}</a>
            <a>收藏:{{$user->favorite_count}}</a>

            {{--关注权限开始--}}
            @can('attention',$user)
              <button class="btn btn-sm btn-outline-primary float-right zf-post"
                      data-url="{{route('web.users.attention')}}" data-title="确定要关注?"
                      data-data="{'user_id':'{{$user->id}}'} ">关注+
              </button>
            @else
              @if(Auth::user()->id != $user->id)
                <button class="btn btn-sm btn-outline-primary float-right zf-post"
                        data-url="{{route('web.users.cancel_attention')}}" data-title="确定要取消关注?"
                        data-data="{'user_id':'{{$user->id}}'} ">取消关注
                </button>
              @endif
            @endcan
            {{--关注权限结束--}}
          </div>
        </div>
      </div>
      {{--一个简单的用户信息结束--}}

      {{--用户发布的内容开始--}}
      <div class="card mt-30">
        <div class="card-header">
          <h5 class="float-left">最近发布内容</h5>
          <a class="float-right" href="{{ route('web.users.content_list' , ['user' => $user->id, 'type' => 'RELEASE' ]) }}">查看更多</a>
        </div>
        <div class="card-body">
          {{--发布的内容开始--}}
          @php
            $config = [
              'otherWhere' => [
                  ['user_id' ,'=', $user->id]
              ],
              'order' => ['created_at','desc'],
              'offset'=>  0,
              'limit' => 15
            ]
          @endphp
          @content($config)
          @if (count($contents))
            <ul class="list-group border-0">
              @foreach ($contents as $content)
                <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0  pt-0 @endif @if($loop->last) border-bottom-0 pb-0 @endif">
                  <a href="{{ route('web.contents.show', $content->id) }}">
                    {{ $content->title }}
                  </a>
                  <span class="meta float-right text-secondary">
                    {{ $content->comment_count }} 回复
                    <span> ⋅ </span>
                    {{ $content->created_at->diffForHumans() }}
                  </span>
                </li>
              @endforeach
            </ul>
          @else
            <div class="empty-block">暂无数据 ~_~</div>
          @endif
          @endcontent
          {{--发布的内容结束--}}
        </div>
      </div>
      {{--用户发布的内容结束--}}

      {{--点赞分析开始--}}
      <div class="row mt-30">
        {{--那些用户给我的内容点赞开始--}}
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card ">
            <div class="card-header">
              <h5 class="float-left">最近那些用户给我的内容点赞</h5>
            </div>
            <div class="card-body">
              @php
                $beAwesomeUsers = $user->beAllContentAwesomeUsers()->offset(0)->limit(15)->get();
              @endphp
              @if(count($beAwesomeUsers) > 0)
                @foreach($beAwesomeUsers as $beAwesomeUser)
                  <a href="{{route('web.users.show',$beAwesomeUser->id)}}">
                    <img src="{{imgRe($beAwesomeUser->avatar ,400 ,400)}}" width="40" height="40" class="rounded-circle m-1">
                  </a>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        {{--那些用户给我的内容点赞结束--}}

        {{--我给那些用户内容点赞开始--}}
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card ">
            <div class="card-header">
              <h5 class="float-left">最近我给那些用户内容点赞</h5>
            </div>
            <div class="card-body">
              @php
                $awesomeUsers = $user->allContentAwesomeUsers()->offset(0)->limit(15)->get();
              @endphp
              @if(count($awesomeUsers) > 0)
                @foreach($awesomeUsers as $awesomeUser)
                  <a href="{{route('web.users.show',$awesomeUser->id)}}">
                    <img src="{{imgRe($awesomeUser->avatar ,400 ,400)}}" width="40" height="40"
                         class="rounded-circle m-1">
                  </a>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        {{--我给那些用户内容点赞结束--}}
      </div>
      {{--点赞分析结束--}}

      {{--用户发布的评论开始--}}
      <div class="card mt-30">
        <div class="card-header">
          <h5 class="float-left">最近评论内容</h5>
          <a class="float-right" href="">查看更多</a>
        </div>
        <div class="card-body">
          @php
            $config = [
              'with'          => ['user','commentable'],
              'otherWhere'    => [
                ['user_id'         , '=' , $user->id]
               ],
               'order'        => ['created_at' , 'desc'],
               'offset'       => 0,
               'limit'        => 15
            ];
          @endphp
          {{--评论列表开始--}}
          @comments($config)
          @if(count($comments) != 0)
            @foreach($comments as $key => $comment)
              <div class="media">
                <img src="{{ImgRe( $comment->user->avatar ,400 ,400)}}" class="mr-3" alt="" width="40" height="40">
                <div class="media-body">
                  <h5 class="mt-0">你对 : "{{$comment->commentable->title}}" 进行了评论</h5>
                  {!! $comment->content !!}
                </div>
              </div>
              @if(!$loop->last)
              <hr class="mt-0 mb-4">
              @endif
            @endforeach
          @else
            还没有人评论,抢占前排沙发
          @endif
          @endcomments
          {{--评论列表结束--}}

        </div>
      </div>
      {{--用户发布的评论结束--}}

    </div>
    {{--右侧内容结束--}}
  </div>
@endsection
{{--中间内容结束--}}

{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
