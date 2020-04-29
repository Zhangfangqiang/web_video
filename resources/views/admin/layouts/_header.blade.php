<div class="layui-header">
  {{--头部左侧选项开始--}}
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item layadmin-flexible" lay-unselect>
      <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
      </a>
    </li>

    <li class="layui-nav-item layui-hide-xs" lay-unselect>
      <a href="/" target="_blank" title="前台">
        <i class="layui-icon layui-icon-website"></i>
      </a>
    </li>

    <li class="layui-nav-item" lay-unselect>
      <a href="javascript:;" layadmin-event="refresh" title="刷新">
        <i class="layui-icon layui-icon-refresh-3"></i>
      </a>
    </li>

    <li class="layui-nav-item layui-hide-xs" lay-unselect>
      <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search" layadmin-event="serach" lay-action="template/search.html?keywords=">
    </li>
  </ul>
  {{--头部左侧选项结束--}}

  {{--头部右侧选项开始--}}
  <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

    {{--消息通知--}}
    <li class="layui-nav-item" lay-unselect>
      <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
        <i class="layui-icon layui-icon-notice"></i>
        <span class="layui-badge-dot"></span>
      </a>
    </li>
    {{--消息通知结束--}}

    <li class="layui-nav-item layui-hide-xs" lay-unselect>
      <a href="javascript:;" layadmin-event="theme">
        <i class="layui-icon layui-icon-theme"></i>
      </a>
    </li>

    {{--登录后的个人信息开始--}}
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
      <a href="javascript:;" layadmin-event="fullscreen">
        <i class="layui-icon layui-icon-screen-full"></i>
      </a>
    </li>
    {{--登录后的个人信息结束--}}

    <li class="layui-nav-item" lay-unselect style="margin-right: 10px;">
      <a href="javascript:;">
        <cite>{{ Auth::user()->name }}</cite>
      </a>
      <dl class="layui-nav-child">
        <dd><a lay-href="set/user/info.html">基本资料</a></dd>
        <dd><a lay-href="set/user/password.html">修改密码</a></dd>
        <hr>
        <dd style="text-align: center;">
          <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="javascript:void(0)" href="#">
            退出登录
            <form action="{{ route('logout') }}" id="logout-form" method="POST" hidden>
              {{ csrf_field() }}
            </form>
          </a>
        </dd>
      </dl>
    </li>
  </ul>
  {{--头部右侧选项结束--}}
</div>
