@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

@section('content')
  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">添加内容</div>
      <div class="layui-card-body" style="padding: 15px;">


        {{--表单开始--}}
        <div class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
              <input type="checkbox" name="is_comment" value="1" lay-skin="primary" title="是否评论" checked="">
              <input type="checkbox" name="is_top" value="1" lay-skin="primary" title="是否置顶" checked="">
              <input type="checkbox" name="is_recommended" value="1" lay-skin="primary" title="是否推荐" checked="">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">
              数据类型
            </label>
            <div class="layui-input-block">
              <select name="type" class="layui-input">
                <option value="1" {{ $content->type == 1 ? 'selected' : ''}} >文章</option>
                <option value="2" {{ $content->type == 2 ? 'selected' : ''}} >视频</option>
                <option value="3" {{ $content->type == 3 ? 'selected' : ''}} >图片</option>
              </select>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">
              分类:
              <span style="color: red">*</span>
            </label>
            <div class="layui-input-block category-id-form-re"></div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">
              标题:
              <span style="color: red">*</span>
            </label>
            <div class="layui-input-block">
              <input type="text" name="title" value="{{$content->title}}" class="layui-input">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">Seo 关键词:</label>
            <div class="layui-input-block">
              <input type="text" name="seo_key" value="{{$content->seo_key}}" class="layui-input">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">来源:</label>
            <div class="layui-input-block">
              <input type="text" name="source" value="{{$content->source}}" class="layui-input">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">父类</label>
            <div class="layui-input-block">
              <input type="number" name="parent_id" value="" class="layui-input">
            </div>
          </div>

          <div class="layui-form-item" id="aetherupload-wrapper">
            <label class="layui-form-label">图片</label>
            <div class="layui-input-block">
              <img src="{{$content->img}}" style="max-height: 100px;margin: 5px;border: 1px solid #3d3d3d;border-radius: 5px;" alt="">

              <input type="file" class="layui-input" id="aetherupload-resource" onchange="aetherupload(this).upload()"/>
              <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                <div id="aetherupload-progressbar" style="background:blue;height:6px;width:0;"></div>
              </div>
              <span style="font-size:12px;color:#aaa;" id="aetherupload-output"></span>
              <input type="hidden" name="img" value="{{$content->img}}" id="aetherupload-savedpath">
            </div>
          </div>

          <div class="layui-form-item" id="aetherupload-wrapper">
            <label class="layui-form-label">视频文件</label>
            <div class="layui-input-block">
              <input type="file" class="layui-input" id="aetherupload-resource" onchange="aetherupload(this).upload()"/>
              <div class="progress " style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                <div id="aetherupload-progressbar" style="background:blue;height:6px;width:0;"></div>
              </div>
              <span style="font-size:12px;color:#aaa;" id="aetherupload-output"></span>
              <input type="hidden" name="video" value="{{$content->video}}" id="aetherupload-savedpath">
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">文本内容:</label>
            <div class="layui-input-block">
              <script id="content-field" style="height: 600px" name="content" type="text/plain">{!! $content->content !!}</script>
            </div>
          </div>

          <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block">
              <div class="layui-footer" style="left: 0;z-index: 9999999;">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button type="submit" class="layui-btn" lay-submit lay-filter="content-submit-form">提交</button>
              </div>
            </div>
          </div>
        </div>
        {{--表单结束--}}

      </div>
    </div>
  </div>
@endsection

{{--后置js开始--}}
@section('after_js')
  {{--百度编辑器开始--}}
  <script type="text/javascript" charset="utf-8" src="{{asset('/admin/ueditor/ueditor.config.js')}}"></script>
  <script type="text/javascript" charset="utf-8" src="{{asset('/admin/ueditor/ueditor.all.min.js')}}"> </script>
  <script type="text/javascript" charset="utf-8" src="{{asset('/admin/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
  {{--百度编辑器结束--}}

  {{--大文件上传方法开始--}}
  <script src="{{ asset('vendor/aetherupload/js/spark-md5.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="{{ asset('vendor/aetherupload/js/aetherupload.js') }}"></script>
  {{--大文件上传方法结束--}}

  <script>
    // 百度编辑器
    var ue = UE.getEditor('content-field');

    //大文件上传完毕回掉方法
    // success(someCallback)中声名的回调方法需在此定义，参数someCallback可为任意名称，此方法将会在上传完成后被调用
    // 可使用this对象获得resourceName,resourceSize,resourceTempBaseName,resourceExt,groupSubdir,group,savedPath等属性的值
    someCallback = function () {
      // Example
      $('#result').append(
              '<p>执行回调 - 文件已上传，原名：<span >' + this.resourceName + '</span> | 大小：<span >' + parseFloat(this.resourceSize / (1000 * 1000)).toFixed(2) + 'MB' + '</span> | 储存名：<span >' + this.savedPath.substr(this.savedPath.lastIndexOf('_') + 1) + '</span></p>'
      );
    }

    //layui
    $layui.use(['index', 'form', 'upload'], function () {
      var $ = layui.$;
      var form = layui.form;
      var upload = layui.upload;

      /**
       * 全局渲染内容的分类 重写
       */
      if ($(".category-id-form-re").length > 0) {
        $(".category-id-form-re").each(function (index, item) {
          xmSelect.render({
            el: item,
            name: 'c_id',
            radio: false,
            filterable: true,
            remoteSearch: true,
            remoteMethod: function (val, cb, show) {
              c_id   = [];
              c_data = [];

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

                  $.ajax({
                    url: '{{route('api.admin.v1.category_has_contents.index')}}',
                    data: {
                      otherWhere: [
                        ['content_id', '=', {{$content->id}}]
                      ],
                      offset: 0,
                      limit: 100,
                    },
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                      data.data.forEach(function (item, index) {
                        c_id.push(item.category_id)
                      })
                    }
                  })

                  data.data.forEach(function (item, index) {
                    var str = '----'
                    if(c_id.indexOf(item.id) != -1){
                      c_data.push({name: str.repeat(item.level) + item.name, value: item.id ,selected: true})
                    }else{
                      c_data.push({name: str.repeat(item.level) + item.name, value: item.id})
                    }
                  })

                  cb(c_data);
                }
              })
            }
          })
        })
      }

      /**
       * 提交内容的方法
       */
      form.on('submit(content-submit-form)', function(data){

        data.field.content = ue.getContent();

        $.ajax({
          url: "{{route('api.admin.v1.contents.update',$content->id)}}",
          type: 'PUT',
          dataType: 'json',
          data: data.field,
          async: false, //异步
          success: function (data) {
            layer.msg(data.message);
          }
        })
        return false;
      })

    })
  </script>
@endsection
{{--后置js结束--}}
