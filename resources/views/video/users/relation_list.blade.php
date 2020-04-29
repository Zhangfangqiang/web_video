@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

  {{--左侧内容开始--}}
  @include(env('VIEWLAYER').'.users._left_nav', $user)
  {{--左侧内容结束--}}

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h5 class="float-left">
            @switch($request->type)
              @case('FOLLOW')
              我关注的用户
              @break
              @case('BEFOLLOW')
              我的粉丝
              @break
            @endswitch
          </h5>
        </div>
        <div class="card-body">
          <div class="card-columns">
            @php
              switch($request->type){
                case 'FOLLOW':
                  $users = $user->followUser();
                  break;
                case 'BEFOLLOW':
                  $users = $user->beFollowUser();
                  break;
              }
              $users = $users->paginate(16);
            @endphp

            @foreach($users as $user)
              <div class="card">
                <a href="{{route('web.users.show',$user->id)}}">
                  <img src="{{imgRe($user->avatar , 400 ,400)}}" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">{{$user->introduction}}</p>
                  </div>
                @switch($request->type)
                  @case('FOLLOW')
                    <div class="text-center pb-15">
                      <button class="btn btn-secondary">取消关注</button>
                    </div>
                  @break
                  @case('BEFOLLOW')
                  @break
                @endswitch
              </div>
            @endforeach
          </div>

          <div>
            {{$users->appends($request->except('page'))->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
