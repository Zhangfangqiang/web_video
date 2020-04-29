<!DOCTYPE html>
<html>

{{--头部标签开始--}}
@yield('head',View::make('admin.layouts._head'))
{{--头部标签结束--}}

<body class="layui-layout-body">

<div id="LAY_app">
  <div class="layui-layout layui-layout-admin">

    {{--头部导航开始--}}
    @yield('header',View::make('admin.layouts._header'))
    {{--头部导航结束--}}

    {{--左侧菜单开始--}}
    @yield('side_menu',View::make('admin.layouts._side_menu'))
    {{--左侧菜单结束--}}

    {{--窗口标签开始--}}
    @yield('pagetabs',View::make('admin.layouts._pagetabs'))
    {{--窗口标签结束--}}

    {{--主体内容开始--}}
    <div class="layui-body" id="LAY_app_body">
      <div class="layadmin-tabsbody-item layui-show">
        <iframe src="{{layuiRoute('admin.operationg_logs.index')}}" frameborder="0" class="layadmin-iframe"></iframe>
      </div>
    </div>
    {{--主体内容结束--}}

    {{--辅助元素开始--}}
    <div class="layadmin-body-shade" layadmin-event="shade"></div>
    {{--辅助元素结束--}}
  </div>
</div>

{{--js开始--}}
@yield('js',View::make('admin.layouts._js'))
{{--js结束--}}

</body>
</html>


