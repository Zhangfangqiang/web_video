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
            <label class='layui-form-label'>ID</label>
            <div class='layui-input-inline'>
              <input type='text' name='id' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>作者</label>
            <div class='layui-input-inline user-id-form'></div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>父类</label>
            <div class='layui-input-inline'>
              <input type='text' name='parent_id' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>是否评论</label>
            <div class='layui-input-inline'>
              <select name="is_comment" lay-verify="">
                <option value="">全部</option>
                <option value="1">是</option>
                <option value="0">否</option>
              </select>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>是否置顶</label>
            <div class='layui-input-inline'>
              <select name="is_top" lay-verify="">
                <option value="">全部</option>
                <option value="1">是</option>
                <option value="0">否</option>
              </select>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>是否推荐</label>
            <div class='layui-input-inline'>
              <select name="is_recommended" lay-verify="">
                <option value="">全部</option>
                <option value="1">是</option>
                <option value="0">否</option>
              </select>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>类型</label>
            <div class='layui-input-inline'>
              <select name="type" lay-verify="">
                <option value="">全部</option>
                <option value="1">文章</option>
                <option value="2">图片</option>
              </select>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>查看数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="watch_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="watch_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
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
            <label class='layui-form-label'>评论数</label>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="comment_count" placeholder="0" autocomplete="off" class="layui-input" data-where=">=">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
              <input type="text" name="comment_count" placeholder="0" autocomplete="off" class="layui-input" data-where="<=">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>标题</label>
            <div class='layui-input-inline'>
              <input type='text' name='title' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>英文标题</label>
            <div class='layui-input-inline'>
              <input type='text' name='english_title' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>seo关键词</label>
            <div class='layui-input-inline'>
              <input type='text' name='seo_key' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>摘要</label>
            <div class='layui-input-inline'>
              <input type='text' name='excerpt' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>文章来源</label>
            <div class='layui-input-inline'>
              <input type='text' name='source' placeholder='请输入' autocomplete='off' class='layui-input' data-where="like">
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>文本内容</label>
            <div class='layui-input-inline'>
              <input type='text' name='content' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          <div class='layui-inline'>
            <label class='layui-form-label'>视频内容</label>
            <div class='layui-input-inline'>
              <input type='text' name='video' placeholder='请输入' autocomplete='off' class='layui-input'>
            </div>
          </div>
          {{--表单搜索字段开始--}}

          <div class="layui-inline">
            <label class="layui-form-label">创建时间</label>
            <div class="layui-input-block">
              <input type="text" name="created_at" placeholder=" - " autocomplete="off" class="layui-input" id="contents-created_at">
            </div>
          </div>

          <div class="layui-inline">
            <label class="layui-form-label">更新时间</label>
            <div class="layui-input-block">
              <input type="text" name="updated_at" placeholder=" - " autocomplete="off" class="layui-input" id="contents-updated_at">
            </div>
          </div>

          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-list" lay-submit id="contents-search" lay-filter="contents-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
            <button class="layui-btn layuiadmin-btn-order" id="contents-refresh">
              <i class="layui-icon layui-icon-refresh-3 layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      {{--搜索框结束--}}

      {{--数据展现开始--}}
      <div class="layui-card-body">
        <div style="overflow: hidden;padding-bottom: 10px;">
          <a lay-href="{{layuiRoute('admin.contents.create')}}" title="添加内容" class="layui-btn layuiadmin-btn-list" style="float: right;">添加内容</a>
        </div>

        {{--表格数据内容开始--}}
        <table id="contents-table" lay-filter="contents-table"></table>
        {{--表格数据内容结束--}}

        {{--对这条数据进行操作的操作栏开始--}}
        <script type="text/html" id="contents-operation">
          <a class="layui-btn layui-btn-normal layui-btn-xs" lay-href="/admin/contents/@{{d.id}}/edit"  lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
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
        elem: '#contents-updated_at',
        range: true
      });
      laydate.render({
        elem: '#contents-created_at',
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
      $('#contents-refresh').click(function () {
        location.reload();
      })

      /**
       * 监听表单搜索按钮
       */
      form.on('submit(contents-search)', function (data) {

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
        table.reload('contents-table', {
          where: {
            'otherWhere': array,
          },
        });
      });

      /**
       * 监听表格渲染
       */
      table.render({
        elem: "#contents-table",
        url: "{{route('api.admin.v1.contents.index')}}",
        where: {
          with: ['user','category'],
          order:['created_at','desc'],
        },
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
          {width: 50 ,     type: "numbers", fixed: "left"},
          {width: 80 ,     field: "id", title: "id"},
          {width: 100 ,                            title: "分类", templet: '<div>@{{echoCategory(d.category)}}</div>'},

          {width: 80 ,                             title: "评论" , templet:'<div> @{{# if(d.is_comment     == 1){ }} <button class="layui-btn layui-btn-normal layui-btn-xs">是</button> @{{#  } else { }} <button class="layui-btn  layui-btn-danger  layui-btn-xs">否</button> @{{#  } }} </div>'},
          {width: 80 ,                             title: "置顶" , templet:'<div> @{{# if(d.is_top         == 1){ }} <button class="layui-btn layui-btn-normal layui-btn-xs">是</button> @{{#  } else { }} <button class="layui-btn  layui-btn-danger  layui-btn-xs">否</button> @{{#  } }} </div>'},
          {width: 80 ,                             title: "推荐" , templet:'<div> @{{# if(d.is_recommended == 1){ }} <button class="layui-btn layui-btn-normal layui-btn-xs">是</button> @{{#  } else { }} <button class="layui-btn  layui-btn-danger  layui-btn-xs">否</button> @{{#  } }} </div>'},
          {width: 80 ,     field: "type",          title: "类型"           , templet:'<div> @{{# if(d.type == 1){ }} 文章 @{{#  } else if(d.type == 2) { }} 视频 @{{#  } }}  </div>'},

          {width: 200 ,    field: "title",         title: "标题"},
          {width: 200 ,    field: "english_title", title: "英文标题"},
          {width: 120 ,                            title: "作者", templet: '<div>@{{d.user.name}}</div>'},
          {width: 100 ,    field: "parent_id",     title: "父类"},
          {width: 200 ,    field: "seo_key",       title: "seo关键词"},
          {width: 200 ,    field: "excerpt",       title: "摘要"},
          {width: 200 ,    field: "source",        title: "来源"},
          {width: 200 ,    field: "content",       title: "文本内容"},
          {width: 200 ,    field: "video",         title: "视频"},
          {width: 200 ,    field: "img",           title: "图片"},

          {width: 110 ,    field: "watch_count",   title: "查看数"},
          {width: 110 ,    field: "favorite_count",title: "收藏数"},
          {width: 110 ,    field: "awesome_count", title: "点赞数"},
          {width: 110 ,    field: "comment_count", title: "评论数"},

          {width: 170 ,    field: "release_at",    title: "发布时间"},
          {width: 170 ,    field: "delete_at",     title: "删除时间"},
          {width: 170 ,    field: "created_at",    title: "创建时间"},
          {width: 170 ,    field: "updated_at",    title: "更新时间"},
          {minWidth: 200 , field: "more",          title: "更多数据"},
          {width: 160 ,                            title: "操作", align: "center", fixed: "right", toolbar: "#contents-operation"}
        ]],
        page: !0,
        limit: 15,
        limits: [10, 15, 20, 25, 30],
        text: "对不起，加载出现异常！",
      });

      /**
       * 监听表格排序按钮
       */
      table.on('sort(contents-table)', function (obj) {
        table.reload('contents-table', {
          initSort: obj,
          where: {
            order: [obj.field, obj.type]
          }
        });
      });

      /**
       * 监听表格操作按钮
       */
      table.on('tool(contents-table)', function (obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data;                       //获得当前行数据
        var layEvent = obj.event;                      //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var dataId = data.id;                        //获取文章id

        /**
         * 删除方法开始
         */
        if (layEvent === 'delete') {
          layer.confirm('确定删除吗?', function (index) {

            $.ajax({
              url: "/api/admin/v1/contents/" + dataId,
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

    function echoCategory(item) {
      var str = "";
      item.forEach((value, index) => {
        str += value.name+' ,'
      })

      return str.substr(0, str.length - 1);
    }
  </script>
@endsection
{{--后置js结束--}}


