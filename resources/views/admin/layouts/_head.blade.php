<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="authorization" content="Bearer {{getUserBToken()}}">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <title>@yield('title', env('APP_NAME'))</title>
  
  <link rel="stylesheet" href="{{asset('admin/layuiadmin/layui/css/layui.css')}}" media="all">
  <link rel="stylesheet" href="{{asset('admin/layuiadmin/style/admin.css')}}" media="all">

  {{--后置样式开始--}}
  @yield('after_css')
  {{--后置样式结束--}}
</head>
