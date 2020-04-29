<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

{{--head标签内容开始--}}
@yield('head',View::make('web.layouts._head'))
{{--head标签内容结束--}}

<body>
<div id="app" class="{{ route_class() }}-page">

  {{--头部内容开始--}}
  @yield('header',View::make('web.layouts._header'))
  {{--头部内容结束--}}

  <div class="container mb-90">

    {{--共享提示开始--}}
    @include('web.shared._messages')
    {{--共享提示结束--}}

    {{--中间内容开始--}}
    @yield('content')
    {{--中间内容结束--}}

  </div>

  {{--脚部开始--}}
  @yield('footer',View::make('web.layouts._footer'))
  {{--脚部结束--}}
</div>

{{--js脚本开始--}}
@yield('js',View::make('web.layouts._js'))
{{--js脚本结束--}}

</body>
</html>
