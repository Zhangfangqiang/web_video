@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include('web.users._left_nav' , $user = \Auth::user())
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4>
            <i class="glyphicon glyphicon-edit"></i> 发布内容
          </h4>
        </div>

        <div class="card-body">

          {{--表单错误提示开始--}}
          @include('web.shared._error')
          {{--表单错误提示结束--}}

          <form action="{{route('web.contents.store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title-field">标题</label>
              <input id="title-field" name="title" type="text" value="{{old('title')}}" class="form-control"/>
            </div>

            <div class="form-group">
              <label for="category-name-field">分类</label>
              <input id="category-name-field" name="c_title" type="text" value="{{old('c_title')}}" class="form-control" readonly onclick="doSelectCategory()"/>
              <input id="category-id-field"   name="c_id"    type="text" value="{{old('c_id')}}"    class="form-control" required hidden>
            </div>

            <div class="form-group">
              <label for="content-field">文本内容</label>
              <script id="content-field" style="height: 600px" name="content" type="text/plain">{!! old('content') !!}</script>
            </div>

            @csrf

            <div class="well well-sm">
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{--右侧内容结束--}}
  </div>
@endsection
{{--中间内容结束--}}

{{--后置js开始--}}
@section('after_js')
  {{--百度编辑器开始--}}
  <script type="text/javascript" charset="utf-8" src="{{asset('/web/ueditor/ueditor.config.js')}}"></script>
  <script type="text/javascript" charset="utf-8" src="{{asset('/web/ueditor/ueditor.all.min.js')}}"> </script>
  <script type="text/javascript" charset="utf-8" src="{{asset('/web/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
  {{--百度编辑器结束--}}

  <script>
    var ue = UE.getEditor('content-field');

    /**
     * 选择分类的方法
     */
    function doSelectCategory() {
      var selectedCategoriesId = $('#category-id-field').val();

      /**
       * 调用重新定义的弹框方法
       */
      openIframeLayer(
        "/web/categories/popup_list?ids=" + selectedCategoriesId,
        '请选择分类',
        {
          area: ['300px', '400px'],
          btn: ['确定', '取消'],
          yes: function (index, layero) {
            var iframeWin          = window[layero.find('iframe')[0]['name']];                        //得到iframe页里面的内容,这里的iframe就相当于一个新窗口页面
            var selectedCategories = iframeWin.dateReady();                                           //调用弹框中的dateReady数据准备方法

            if (selectedCategories.selectedCategoriesId.length == 0) {                                //判断从窗口中 dateReady 的方法 调用的数据是否存在 ,如果没有提示选择一个
              layer.msg('请选择分类');
              return;
            }

            $('#category-id-field').val(selectedCategories.selectedCategoriesId.join(','));
            $('#category-name-field').val(selectedCategories.selectedCategoriesName.join(' '));
            layer.close(index);
          }
        }
      );
    }

  </script>
@endsection
{{--后置js结束--}}
