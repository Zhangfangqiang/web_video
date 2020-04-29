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
          <div class='layui-inline'>
            <label class='layui-form-label'>ID</label>
            <div class='layui-input-inline'>
              <input type='text' name='id' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>标题</label>
            <div class='layui-input-inline'>
              <input type='text' name='title' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>描述</label>
            <div class='layui-input-inline'>
              <input type='text' name='description' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>链接</label>
            <div class='layui-input-inline'>
              <input type='text' name='link' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">创建时间</label>
            <div class="layui-input-block">
              <input type="text" name="created_at" placeholder=" - " autocomplete="off" class="layui-input" id="links-created_at">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">更新时间</label>
            <div class="layui-input-block">
              <input type="text" name="updated_at" placeholder=" - " autocomplete="off" class="layui-input" id="links-updated_at">
            </div>
          </div>

          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-list" lay-submit id="links-search" lay-filter="links-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
            <button class="layui-btn layuiadmin-btn-order" id="links-refresh">
              <i class="layui-icon layui-icon-refresh-3 layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      {{--搜索框结束--}}

      {{--数据展现开始--}}
      <div class="layui-card-body">
        <div style="overflow: hidden;padding-bottom: 10px;">
          <button id="links-create" class="layui-btn layuiadmin-btn-list" data-type="add" style="float: right;">添加
          </button>
        </div>

        {{--表格数据内容开始--}}
        <table id="links-table" lay-filter="links-table"></table>
        {{--表格数据内容结束--}}

        {{--对这条数据进行操作的操作栏开始--}}
        <script type="text/html" id="links-operation">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
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
        elem: '#links-updated_at',
        range: true
      });
      laydate.render({
        elem: '#links-created_at',
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
      $('#links-refresh').click(function () {
        location.reload();
      })

      /**
       * 创建
       */
      $('#links-create').click(function () {
        layer.open({
          type: 2,
          title: '添加links',
          content: "/admin/links/create",
          area: ['500px', '300px'],
          btn: ['确定', '取消'],
          yes: function (index, layero) {

            var iframeWindow = window['layui-layer-iframe' + index];                         //获取弹出的iframe 标签内容 ,和 layero 的区别,layero 带一个外边框
            var submitID = 'links-back-submit';                     //设置弹出框里面的提交按钮id
            var submit = layero.find('iframe').contents().find('#' + submitID);        //获取弹出框表单中,定义的提交按钮

            //监听提交
            iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
              var field = data.field; //获取提交的字段

              //提交 Ajax 成功后，静态更新表格中的数据
              $.ajax({
                url: "{{route('api.admin.v1.links.index')}}",
                type: 'POST',
                dataType: 'json',
                data: field,
                success: function (data) {
                  layer.msg(data.message);
                  location.reload();           //刷新页面
                }
              })
            });
            submit.trigger('click');          //自动触发点击事件
          }
        })
      })

      /**
       * 监听表单搜索按钮
       */
      form.on('submit(links-search)', function (data) {

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
        table.reload('links-table', {
          where: {'otherWhere': array},
        });
      });

      /**
       * 监听表格渲染
       */
      table.render({
        elem: "#links-table",
        url: "{{route('api.admin.v1.links.index')}}",
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
          {width: 50  ,type: "numbers", fixed: "left"},
          {width: 80  ,field: "id",          title: "ID"},
          {width: 200 ,field: "title",       title: "标题"},
          {width: 200 ,field: "description", title: "描述"},
          {widthMin: 100 ,                   title: "链接" , templet:"<div><a href='@{{d.link}}' target='_blank'>@{{d.link}}</a></div>"},
          {width: 170 ,field: "created_at",  title: "创建时间"},
          {width: 170 ,field: "updated_at",  title: "更新时间"},
          {width: 160 ,title: "操作", align: "center", fixed: "right", toolbar: "#links-operation"}
        ]],
        page: !0,
        limit: 15,
        limits: [10, 15, 20, 25, 30],
        text: "对不起，加载出现异常！",
      });

      /**
       * 监听表格排序按钮
       */
      table.on('sort(links-table)', function (obj) {
        table.reload('links-table', {
          initSort: obj,
          where: {
            order: [obj.field, obj.type]
          }
        });
      });

      /**
       * 监听表格操作按钮
       */
      table.on('tool(links-table)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data;                       //获得当前行数据
        var layEvent = obj.event;                      //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var dataId = data.id;                        //获取文章id

        /**
         * 编辑方法开始
         */
        if (layEvent === 'edit') { //编辑
          layer.open({
            type: 2,
            title: '修改links',
            content: "/admin/links/" + dataId + "/edit",
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {

              var iframeWindow = window['layui-layer-iframe' + index];                         //获取弹出的iframe 标签内容 ,和 layero 的区别,layero 带一个外边框
              var submitID = 'links-back-submit';                     //设置弹出框里面的提交按钮id
              var submit = layero.find('iframe').contents().find('#' + submitID);        //获取弹出框表单中,定义的提交按钮

              //监听提交
              iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                var field = data.field; //获取提交的字段

                //提交 Ajax 成功后，静态更新表格中的数据
                $.ajax({
                  url: "/api/admin/v1/links/" + dataId,
                  type: 'PUT',
                  dataType: 'json',
                  data: field,
                  success: function (data) {
                    layer.msg(data.message);
                    table.reload('links-table');           //重载数据
                    layer.close(index);                                        //关闭弹框
                  }
                })

              });
              submit.trigger('click');                                       //自动触发点击事件
            }
          })
        }

        /**
         * 删除方法开始
         */
        if (layEvent === 'delete') {
          layer.confirm('确定删除吗?', function (index) {

            $.ajax({
              url: "/api/admin/v1/links/" + dataId,
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


