<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', env('APP_NAME'))</title>

  {{--样式开始--}}
  <link href="{{ mix('/web/css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="http://at.alicdn.com/t/font_1779380_ahof10civh.css">
  {{--样式结束--}}

  {{--后置样式开始--}}
  @yield('after_css')
  {{--后置样式结束--}}
</head>

