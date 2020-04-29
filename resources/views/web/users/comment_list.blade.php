@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include('web.users._left_nav', $user)
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h5 class="float-left">评论内容</h5>
        </div>
        <div class="card-body">
          @php
            $config = [
                'with'          => ['user','commentable'],
                'otherWhere'    => [
                  ['user_id'         , '=' , $user->id]
                 ],
                'order'         => ['created_at' , 'desc'],
                'paginate'      => 15
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
          <div>
            {{$comments->appends($request->except('page'))->render()}}
          </div>
        </div>
      </div>
    </div>
    {{--右侧内容结束--}}

  </div>
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
