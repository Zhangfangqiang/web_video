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
          {{--表单搜索开始--}}
          <div class='layui-inline'>
            <label class='layui-form-label'>id</label>
            <div class='layui-input-inline'>
              <input type='text' name='id' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>名称</label>
            <div class='layui-input-inline'>
              <input type='text' name='name' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>邮箱</label>
            <div class='layui-input-inline'>
              <input type='text' name='email' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>我的粉丝数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_follow_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_follow_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>我关注的数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="follow_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="follow_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>被点赞数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_awesome_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_awesome_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>点赞数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="awesome_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="awesome_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>被收藏数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_favorite_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="be_favorite_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>收藏数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="favorite_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="favorite_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">创建时间</label>
            <div class="layui-input-block">
              <input type="text" name="created_at" placeholder=" - " autocomplete="off" class="layui-input" id="users-created_at">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">更新时间</label>
            <div class="layui-input-block">
              <input type="text" name="updated_at" placeholder=" - " autocomplete="off" class="layui-input" id="users-updated_at">
            </div>
          </div>
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-list" lay-submit id="users-search" lay-filter="users-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
            <button class="layui-btn layuiadmin-btn-order" id="users-refresh">
              <i class="layui-icon layui-icon-refresh-3 layuiadmin-button-btn"></i>
            </button>
          </div>
          {{--表单搜索开始--}}
        </div>
      </div>
      {{--搜索框结束--}}

      {{--数据展现开始--}}
      <div class="layui-card-body">
        {{--表格数据内容开始--}}
        <table id="users-table" lay-filter="users-table"></table>
        {{--表格数据内容结束--}}

        {{--对这条数据进行操作的操作栏开始--}}
        <script type="text/html" id="users-operation">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="bind_permissions">权限</a>
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="bind_roles">角色</a>
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
        elem: '#users-updated_at',
        range: true
      });
      laydate.render({
        elem: '#users-created_at',
        range: true
      });

      /**
       * 刷新
       */
      $('#users-refresh').click(function () {
        location.reload();
      })

      /**
       * 监听表单搜索按钮
       */
      form.on('submit(users-search)', function (data) {

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
        table.reload('users-table', {
          where: {'otherWhere': array},
        });
      });

      /**
       * 监听表格渲染
       */
      table.render({
        elem: "#users-table",
        url: "{{route('api.admin.v1.users.index')}}",
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
          {width:50, type: "numbers", fixed: "left"},
          {width:50, field: "id", title: "id"},
          {width:70,  title: "avatar" , templet:'<div><img src="@{{d.avatar}}" width="30" height="30" alt=""></div>'},
          {width:120, field: "name", title: "名称"},
          {minWidth:120,field: "email", title: "邮箱"},
          {width:100, field: "be_follow_count", title: "我的粉丝数"},
          {width:100, field: "follow_count", title: "我关注的数"},
          {width:100, field: "be_awesome_count", title: "被点赞数"},
          {width:100, field: "awesome_count", title: "点赞数"},
          {width:100, field: "be_favorite_count", title: "被收藏数"},
          {width:100, field: "favorite_count", title: "收藏数"},
          {width:170, field: "last_login_at", title: "最后登录时间"},
          {width:170, field: "created_at", title: "创建时间" , sort:true},
          {width:170, field: "updated_at", title: "更新时间" , sort:true},
          {width:220, title: "操作", align: "center", fixed: "right", toolbar: "#users-operation"}
        ]],
        page: !0,
        limit: 15,
        limits: [10, 15, 20, 25, 30],
        text: "对不起，加载出现异常！",
      });

      /**
       * 监听表格排序按钮
       */
      table.on('sort(users-table)', function (obj) {
        table.reload('users-table', {
          initSort: obj,
          where: {
            order: [obj.field, obj.type]
          }
        });
      });

      /**
       * 监听表格操作按钮
       */
      table.on('tool(users-table)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data;                       //获得当前行数据
        var layEvent = obj.event;                      //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var dataId = data.id;                        //获取文章id

        /**
         * 设置权限的方法
         */
        if (layEvent === 'bind_permissions') { //设置权限的方法
          layer.open({
            type: 2,
            title: '设置权限',
            content: "/admin/users/" + dataId + "/bind_permissions",
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
              var iframeWindow = window['layui-layer-iframe' + index];
              var submitID     = 'users-back-submit';
              var submit       = layero.find('iframe').contents().find('#' + submitID);

              //监听提交
              iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                var field = data.field; //获取提交的字段

                //提交 Ajax 成功后，静态更新表格中的数据
                $.ajax({
                  url: "/api/admin/v1/users/" + dataId + "/bind_permissions",
                  type: 'PUT',
                  dataType: 'json',
                  data: field,
                  success: function (data) {
                    layer.msg(data);
                  }
                })

                table.reload('users-table');
                layer.close(index);
              });
              submit.trigger('click');
            }
          })
        }

        /**
         * 设置角色
         */
        if (layEvent === 'bind_roles') { //设置角色
          layer.open({
            type: 2,
            title: '设置角色',
            content: "/admin/users/" + dataId + "/bind_roles",
            area: ['500px', '300px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
              var iframeWindow = window['layui-layer-iframe' + index];
              var submitID     = 'users-back-submit';
              var submit       = layero.find('iframe').contents().find('#' + submitID);

              //监听提交
              iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                var field = data.field; //获取提交的字段

                //提交 Ajax 成功后，静态更新表格中的数据
                $.ajax({
                  url: "/api/admin/v1/users/" + dataId + "/bind_roles",
                  type: 'PUT',
                  dataType: 'json',
                  data: field,
                  success: function (data) {
                    layer.msg(data);
                  }
                })

                table.reload('users-table');
                layer.close(index);
              });
              submit.trigger('click');

            }
          })
        }

        /**
         * 删除方法开始
         */
        if (layEvent === 'delete') {
          layer.confirm('确定删除吗?', function (index) {

            $.ajax({
              url: "/api/admin/v1/users/" + dataId,
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


