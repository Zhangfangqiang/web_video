<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

  {{--head标签内容开始--}}
  @yield('head',View::make(env('VIEWLAYER').'.layouts._head'))
  {{--head标签内容结束--}}

</head>
<body  class="{{ route_class() }}-page">

{{--头部内容开始--}}
@yield('header',View::make(env('VIEWLAYER').'.layouts._header'))
{{--头部内容结束--}}

{{--共享提示开始--}}
@include(env('VIEWLAYER').'.shared._messages')
{{--共享提示结束--}}

{{--中间内容开始--}}
@yield('content')
{{--中间内容结束--}}

{{--脚部开始--}}
@yield('footer',View::make(env('VIEWLAYER').'.layouts._footer'))
{{--脚部结束--}}
</body>

{{--js脚本开始--}}
@yield('js',View::make(env('VIEWLAYER').'.layouts._js'))
{{--js脚本结束--}}
</html>
