@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

@section('content')
  <form class="layui-form" style="padding: 15px">
    <div class="layui-form-item">
      <label class="layui-form-label">标题:</label>
      <div class="layui-input-block">
        <input type="text" name="title" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">描述:</label>
      <div class="layui-input-block">
        <input type="text" name="description" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">链接:</label>
      <div class="layui-input-block">
        <input type="text" name="link" value="" class="layui-input">
      </div>
    </div>

    <input type="button" hidden id="links-back-submit" lay-filter="links-back-submit" lay-submit value="确认">
  </form>
@endsection

{{--后置js开始--}}
@section('after_js')
  <script>
    $layui.use(['index', 'form', 'upload'], function () {
      var $ = layui.$;
      var form = layui.form;
      var upload = layui.upload;
    })
  </script>
@endsection
{{--后置js结束--}}
