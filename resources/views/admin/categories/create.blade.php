@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

@section('content')
  <form class="layui-form" style="padding: 15px">
    <div class="layui-form-item">
      <label class="layui-form-label">名称:</label>
      <div class="layui-input-block">
        <input type="text" name="name" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">描述:</label>
      <div class="layui-input-block">
        <input type="text" name="description" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item" style="margin-bottom: 0px;">
      <label class="layui-form-label">父类:</label>
      <div class="layui-input-block parent-id-form">
      </div>
    </div>

    <!--  lay-submit  绑定触发提交的元素-->
    <!--  lay-filter  事件过滤器，主要用于事件的精确匹配，跟选择器是比较类似的。其实它并不私属于form模块，它在 layui 的很多基于事件的接口中都会应用到。 理解为id选择器 -->
    <input type="button" hidden id="categories-back-submit" lay-filter="categories-back-submit" lay-submit value="确认">
  </form>
@endsection

{{--后置js开始--}}
@section('after_js')
  <script>
    $layui.use(['index', 'form', 'upload'], function () {
      var $      = layui.$;
      var form   = layui.form;
      var upload = layui.upload;
    })
  </script>
@endsection
{{--后置js结束--}}
