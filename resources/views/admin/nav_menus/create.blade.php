@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')
  <style>
    .zf-select {
      border: solid 1px #5FB878;
    }
  </style>
@endsection
{{--后置css样式结束--}}

@section('content')
  <form class="layui-form" style="padding: 15px;">

    <div class="layui-form-item">
      <label class="layui-form-label">父类:</label>
      <div class="layui-input-block nav-menus-parent-id"></div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">状态:</label>
      <div class="layui-input-block">
        <input type="checkbox" name="status" lay-skin="switch" checked lay-text="启用|关闭" value="1">
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
          <option value="_blank">新建窗口打开</option>
          <option value="_self">自身窗口打开</option>
        </select>
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">链接:
      </label>
      <div class="layui-input-block">
        <p style="color: red;font-size: 8px;">(根据分类or自定义)生成链接</p>
        <input  name="url_type" type="text"  id="url-type" value="1" hidden>
        <input  name="url"      type="text"  id="url-type-1" value=""   class="layui-input" style="width: 48%;float: right;">
        <div class="category-id-form-re" style="width: 48%;float: left;"></div>
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
    $layui.use(['index', 'form', 'upload'], function () {
      var $ = layui.$;
      var form = layui.form;
      var upload = layui.upload;
      var nav_id = getQueryVariable('nav_id');

      //给表单nav_id赋值
      $('#nav_id').val(nav_id)

      $("#url-type-1").click(function () {
        checkChange(1);
      });

      /**
       * 渲染内容的分类
       */
      if ($(".category-id-form-re").length > 0) {
        $(".category-id-form-re").each(function (index, item) {
          xmSelect.render({
            el: item,
            name: 'c_id',
            radio: true,
            filterable: true,
            remoteSearch: true,
            on:function(){
              checkChange(2)
            },
            remoteMethod: function (val, cb, show) {
              $.ajax({
                url: '{{route('api.admin.v1.categories.index')}}',
                data: {
                  otherWhere: [
                    ['name', 'like', '%' + val + '%']
                  ],
                  tree: 1,
                  offset: 0,
                  limit: 100,
                },
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                  var AfteData = [];

                  data.data.forEach(function (item, index) {
                    var str = '----'
                    AfteData.push({name: str.repeat(item.level) + item.name, value: item.id})
                  })

                  cb(AfteData);
                }
              })
            }
          })

        })
      }

      function checkChange(i) {
        $('#url-type').val(i)

        if (i == 1) {
          $("#url-type-1").addClass('zf-select')
          $(".category-id-form-re").removeClass('zf-select')
        }else{
          $(".category-id-form-re").addClass('zf-select')
          $("#url-type-1").removeClass('zf-select')
        }
      }
    })
  </script>
@endsection
{{--后置js结束--}}
