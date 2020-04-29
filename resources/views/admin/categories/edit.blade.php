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
        <input type="text" name="name" value="{{old('name') ?? $category->name}}" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">描述:</label>
      <div class="layui-input-block">
        <input type="text" name="description" value="{{old('description') ?? $category->description}}" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item" style="margin-bottom: 0px;">
      <label class="layui-form-label">父类:</label>
      <div class="layui-input-block parent-id-form-re">
      </div>
    </div>

    <input type="button" hidden id="categories-back-submit" lay-filter="categories-back-submit" lay-submit value="确认">
  </form>
@endsection

{{--后置js开始--}}
@section('after_js')
  <script>
    $layui.use(['index', 'form', 'upload'], function () {
      var $ = layui.$;
      var form = layui.form;
      var upload = layui.upload;

      /**
       * 重写
       */
      if ($(".parent-id-form-re").length > 0) {
        $(".parent-id-form-re").each(function (index, item) {
          xmSelect.render({
            el: item,
            name: 'parent_id',
            radio: true,
            filterable: true,
            remoteSearch: true,
            remoteMethod: function (val, cb, show) {
              $.ajax({
                url: '{{route('api.admin.v1.categories.index')}}',
                data: {
                  otherWhere: [
                    ['name', 'like', '%' + val + '%'],
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

                    if (item.id == {{$category->parent_id ?? 'null'}} ) {
                      AfteData.push({name: str.repeat(item.level) + item.name, value: item.id, selected: true})
                    } else {
                      AfteData.push({name: str.repeat(item.level) + item.name, value: item.id})
                    }

                  })

                  cb(AfteData);
                }
              })
            }
          })
        })
      }

    })

  </script>
@endsection
{{--后置js结束--}}
