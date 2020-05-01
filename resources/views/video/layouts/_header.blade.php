<!--头部开始-->
<div>
  <header class="video-header container">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-3">
        <h2>
          <a class="text-decoration-none text-black" href="#">{{env('APP_NAME')}}</a>
        </h2>
      </div>
      <div class="col-5 text-center">
        <form action="">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="搜索一下" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class=" btn-danger zf-btn-danger rounded-right pr-2 pl-2" type="button" id="button-addon2">
                <i class="iconfont iconsearch " style="font-size: 20px;"></i>
                搜索
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">

        <ul class="nav icon-nav">
          <li>
            <a href="" class="text-decoration-none text-muted">
              <i class="iconfont iconupload"></i>
              <p>上传</p>
            </a>
          </li>
          <li>
            <a href="" class="text-decoration-none text-muted">
              <i class="iconfont iconfeibu"></i>
              <p>疫情</p>
            </a>
          </li>
          <li>
            <a href="" class="text-decoration-none text-muted">
              <i class="iconfont iconmobile-phone"></i>
              <p>客户端</p>
            </a>
          </li>
        </ul>
        @guest
          <a class="btn btn-sm btn-outline-secondary mr-3" href="{{ route('login') }}">登录</a>
          <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">注册</a>
        @else
          <li class="nav-item dropdown list-none">
            <a class="nav-link dropdown-toggle text-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{imgRe(Auth::user()->avatar , 400 , 400)}}" class="img-responsive img-circle rounded-circle" width="50px" height="50px">
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
          <li class="nav-item list-none">
            <a href="{{ route('web.notifications.index', ['type' => 'App\Notifications\ContentCommentsNotification' ]) }}">
              <span class="badge badge-danger" {{ Auth::user()->notification_count > 0 ? '' : 'hidden' }} >{{ Auth::user()->notification_count }}</span>
            </a>
          </li>
          {{--消息通知按钮结束--}}
        @endguest
      </div>
    </div>
  </header>
</div>
<!--头部结束-->

<!--导航开始-->
<div class="nav-background">
  <div class="nav-scroller container">
    <nav class="nav d-flex justify-content-between">
      @navmenu
      @foreach($navMenus as $key => $value)
        <a class="text-decoration-none text-black" href="{{$value->url}}">{{$value->name}}</a>
      @endforeach
      @endnavmenu
    </nav>
  </div>
</div>
<!--导航结束-->
