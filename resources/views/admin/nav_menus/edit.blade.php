@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

@section('content')
  <form class="layui-form" style="padding: 15px;">

    <div class="layui-form-item">
      <label class="layui-form-label">父类:</label>
      <div class="layui-input-block">
        <input type="number" name="parent_id" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">状态:</label>
      <div class="layui-input-block">
        <select name="status" id="" class="layui-input">
          <option value="0">禁用</option>
          <option value="1">开启</option>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">排序:</label>
      <div class="layui-input-block">
        <input type="number" name="list_order" value="1000" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">名称:</label>
      <div class="layui-input-block">
        <input type="text" name="name" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">打开方式:</label>
      <div class="layui-input-block">
        <select name="target" id="" class="layui-input">
          <option value="_self">自身窗口打开</option>
          <option value="_blank">新建窗口打开</option>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">链接:</label>
      <div class="layui-input-block">
        <input type="text" name="url" value="" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">Icon:</label>
      <div class="layui-input-block">
        <input type="text" name="icon" value="" class="layui-input">
      </div>
    </div>

    <!--  lay-submit  绑定触发提交的元素-->
    <!--  lay-filter  事件过滤器，主要用于事件的精确匹配，跟选择器是比较类似的。其实它并不私属于form模块，它在 layui 的很多基于事件的接口中都会应用到。 理解为id选择器 -->
    <input name="nav_id" type="number" value="" id="nav_id" hidden>
    <input type="button" hidden id="nav_menus-back-submit" lay-filter="nav_menus-back-submit" lay-submit value="确认">
  </form>
@endsection

{{--后置js开始--}}
@section('after_js')
<script>
    $layui.use(['index', 'form' , 'upload'],function () {
        var $      = layui.$;
        var form   = layui.form;
        var upload = layui.upload;

        $('#nav_id').val(nav_id)
    })
</script>
@endsection
{{--后置js结束--}}
