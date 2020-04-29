<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
  <div class="container">

    <a class="navbar-brand " href="{{ url('/') }}">
      {{env('APP_NAME')}}
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto">
        {{--分类标签循环开始--}}
        @category
          @foreach($categories as $key => $value)
            <li class="nav-item {{active_class( if_route('web.contents.index') && Request::input('category') == $value->id )}}">
              <a class="nav-link" href="{{ route('web.contents.index',['category' =>$value->id ]) }}">{{$value->name}}</a>
            </li>
          @endforeach
        @endcategory
        {{--分类标签循环结束--}}
      </ul>

      <ul class="navbar-nav navbar-right">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
        @else

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{imgRe(Auth::user()->avatar , 400 , 400)}}" class="img-responsive img-circle" width="30px" height="30px">
              {{ Auth::user()->name }}
            </a>

            {{--下拉菜单开始--}}
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('web.users.show', Auth::id()) }}">个人中心</a>
              <a class="dropdown-item" href="{{ route('web.contents.create') }}">发布内容</a>
              <a href=""></a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" id="logout" href="#">
                <form action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                  <button class="btn btn-block btn-danger" type="submit" name="button">退出登录</button>
                </form>
              </a>
            </div>
            {{--下拉菜单结束--}}
          </li>

          {{--消息通知按钮开始--}}
          <li class="nav-item">
            <a href="{{ route('web.notifications.index', ['type' => 'App\Notifications\ContentCommentsNotification' ]) }}">
              <span class="badge badge-danger" {{ Auth::user()->notification_count > 0 ? '' : 'hidden' }} >{{ Auth::user()->notification_count }}</span>
            </a>
          </li>
          {{--消息通知按钮结束--}}
        @endguest
      </ul>

    </div>
  </div>
</nav>
