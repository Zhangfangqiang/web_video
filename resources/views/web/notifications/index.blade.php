@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include('web.notifications._left_nav' , $user = \Auth::user())
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4>
            <i class="glyphicon glyphicon-edit"></i>
            @switch($notificationsRequest->type)
              @case('App\Notifications\CommentReplyNotification')
              评论回复通知
              @break
              @case('App\Notifications\ContentCommentsNotification')
              内容评论通知
              @break
            @endswitch
          </h4>
        </div>

        <div class="card-body">
          @php
            $config = [
              'otherWhere' => [
                ['notifiable_id', '=' , Auth::user()->id],
                ['type'         , '=' , $notificationsRequest->type],
              ],
              'order'      =>['created_at' ,'desc'],
              'paginate'   => 15
            ];
          @endphp

          @notifications($config)
          @if(count($notifications) > 0)
            @foreach($notifications as $notification)
              @include('web.notifications.types._' . Str::snake(class_basename($notification->type)))
            @endforeach
          @else
            暂无通知
          @endif
          @endnotifications

          {{$notifications->appends($notificationsRequest->except('page'))->render() }}
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
