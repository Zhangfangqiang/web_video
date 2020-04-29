<!DOCTYPE html>
<html>
{{--头部标签开始--}}
@yield('head',View::make('admin.layouts._head'))
{{--头部标签结束--}}
<body>

{{--iframe中间内容开始--}}
@yield('content')
{{--iframe中间内容结束--}}

{{--js开始--}}
@yield('js',View::make('admin.layouts._js'))
{{--js结束--}}
</body>
</html>


