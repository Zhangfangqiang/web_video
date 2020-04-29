{{--js开始--}}
<script src="{{ mix('/web/js/app.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/web/layer/layer.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{mix('/web/js/web.js')}}"></script>
{{--js结束--}}

{{--后置js开始--}}
@yield('after_js')
{{--后置js结束--}}
