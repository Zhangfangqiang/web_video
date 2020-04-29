@extends('admin.layouts.iframe')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}

{{--中间内容开始--}}
@section('content')
  <div class="layui-fluid">
    <div class="layui-card">
      {{--搜索框开始--}}
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">

          {{--表单搜索字段开始--}}
          <div class='layui-inline'>
            <label class='layui-form-label'>id</label>
            <div class='layui-input-inline'>
              <input type='text' name='id' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>MD5</label>
            <div class='layui-input-inline'>
              <input type='text' name='md5' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>路径</label>
            <div class='layui-input-inline'>
              <input type='text' name='path' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>文件大小</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="size" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="size" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          {{--表单搜索字段开始--}}

          <div class="layui-inline">
            <label class="layui-form-label">创建时间</label>
            <div class="layui-input-block">
              <input type="text" name="created_at" placeholder=" - " autocomplete="off" class="layui-input"
                     id="upload_records-created_at">
            </div>
          </div>

          <div class="layui-inline">
            <label class="layui-form-label">更新时间</label>
            <div class="layui-input-block">
              <input type="text" name="updated_at" placeholder=" - " autocomplete="off" class="layui-input"
                     id="upload_records-updated_at">
            </div>
          </div>

          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-list" lay-submit id="upload_records-search"
                    lay-filter="upload_records-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
            <button class="layui-btn layuiadmin-btn-order" id="upload_records-refresh">
              <i class="layui-icon layui-icon-refresh-3 layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      {{--搜索框结束--}}

      {{--数据展现开始--}}
      <div class="layui-card-body">
        <div style="overflow: hidden;padding-bottom: 10px;">

        </div>

        {{--表格数据内容开始--}}
        <table id="upload_records-table" lay-filter="upload_records-table"></table>
        {{--表格数据内容结束--}}

        {{--对这条数据进行操作的操作栏开始--}}
        <script type="text/html" id="upload_records-operation">
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
        {{--对这条数据进行操作的操作栏结束--}}

      </div>
      {{--数据展现结束--}}
    </div>
  </div>
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')
  <script>
    $layui.use(['index', 'table', 'laydate'], function () {
      /**
       * 定义引入模块的调用变量 和 php new 一个类使用差不多吧?_?
       */
      var $ = layui.$;
      var form = layui.form;
      var table = layui.table;
      var laydate = layui.laydate;

      /**
       * 渲染表单时间组件
       */
      laydate.render({
        elem: '#upload_records-updated_at',
        range: true
      });
      laydate.render({
        elem: '#upload_records-created_at',
        range: true
      });

      /**
       * 设置ajax csrf_token
       */
      $.ajaxSetup({
        data: {_token: '{{csrf_token()}}'},
      });

      /**
       * 刷新
       */
      $('#upload_records-refresh').click(function () {
        location.reload();
      })

      /**
       * 监听表单搜索按钮
       */
      form.on('submit(upload_records-search)', function (data) {

        var array = [];

        $('.layui-form-item input[name] , .layui-form-item select[name]').each(function (index, item) {
          var val = $(this).val();
          var inputName = $(this).attr('name');
          var where = $(this).data('where');

          if ('' != val && '' != inputName) {
            /*如果是模糊查询*/
            if ('like' == where) {
              val = '%' + val + '%';
            }
            /*如果是=查询*/
            if ('' == where | undefined == where) {
              where = '=';
            }
            /*如果是时间*/
            if (inputName.search("_at") != -1) {
              atWhere = ['>=', '<='];/*时间条件范围查询*/
              val.split(" - ").forEach(function (v, k) {
                array.push([inputName, atWhere[k], v]);
              })
            } else {
              array.push([inputName, where, val]);
            }
          }
        });

        //执行重载
        table.reload('upload_records-search', {
          where: {'otherWhere': array},
        });
      });

      /**
       * 监听表格渲染
       */
      table.render({
        elem: "#upload_records-table",
        url: "{{route('api.admin.v1.upload_records.index')}}",
        request: {
          limitName: 'paginate'
        },
        parseData: function (data) {
          return {
            "code": 0,
            "msg": 0,
            "count": data.meta.total,
            "data": data.data
          }
        },
        cols: [[
          {width:50 ,  type : "numbers", fixed: "left"},
          {width:50 ,  field: "id", title: "ID"},
          {            field: "md5", title: "MD5"},
          {            field: "path", title: "文件路径"},
          {width:120 , field: "size", title: "文件大小"},
          {width:170 , field: "created_at", title: "创建日期"},
          {width:170 , field: "updated_at", title: "创建时间"},
          {width:160 , title: "操作", align: "center", fixed: "right", toolbar: "#upload_records-operation"}
        ]],
        page: !0,
        limit: 15,
        limits: [10, 15, 20, 25, 30],
        text: "对不起，加载出现异常！",
      });

      /**
       * 监听表格排序按钮
       */
      table.on('sort(upload_records-table)', function (obj) {
        table.reload('upload_records-table', {
          initSort: obj,
          where: {
            order: [obj.field, obj.type]
          }
        });
      });

      /**
       * 监听表格操作按钮
       */
      table.on('tool(upload_records-table)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data;                       //获得当前行数据
        var layEvent = obj.event;                      //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var dataId = data.id;                        //获取文章id

        /**
         * 删除方法开始
         */
        if (layEvent === 'delete') {
          layer.confirm('确定删除吗?', function (index) {

            $.ajax({
              url: "/api/admin/v1/upload_records/" + dataId,
              type: 'DELETE',
              dataType: 'json',
              success: function (data) {
                layer.msg(data.message);
              }
            })

            layer.close(index);         //关闭弹框
            obj.del();                  //删除对应行（tr）的DOM结构，并更新缓存
          });
        }
      });
    })
  </script>
@endsection
{{--后置js结束--}}


