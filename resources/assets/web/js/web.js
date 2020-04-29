/**
 * 重新优化layer 弹框的方法
 * @param url
 * @param title
 * @param options
 */
function openIframeLayer(url, title, options) {
  var params = {
    type       : 2,
    title      : title,
    shadeClose : true,
    anim       : -1,
    shade      : [0.001, '#000000'],
    shadeClose : true,
    area       : ['95%', '90%'],
    move       : false,
    content    : url,
    yes        : function (index, layero) {
      layer.close(index);
    }
  };
  params = options ? $.extend(params, options) : params;
  layer.open(params);
}

/**
 * 删除弹框的方法
 */
$('.zf-delete').click(function () {

  $url = $(this).data('url');

  layer.confirm('确定删除该数据，删除后不可恢复！', {

    btn: ['确定删除', '点错了']
  }, function () {

    axios.delete($url).then(
      function (data) {
        layer.msg('删除成功', {icon: 1});
        if (data.data.url) {
          setTimeout(function () {
            window.location.href = data.data.url;
          }, 1000);
        } else {
          setTimeout(function () {
            location.reload();
          }, 1000);
        }

      }).catch(
      function (error) {
        if (error.response.status == 403) {
          layer.msg(error.response.data, {icon: 2});
        }

      })
  });
})

/**
 * 点击提交数据的方法
 */
$('.zf-post').click(function () {

  $url   = $(this).data('url');
  $title = $(this).data('title');
  $data  = eval('(' + $(this).data('data') + ')');


  layer.confirm($title, {
    btn: ['确定', '取消']
  }, function () {
    axios.post($url, $data).then(
      function (response) {
        layer.msg(response.data.success,{icon: 1})

        if (response.data.url) {
          setTimeout(function () {
            window.location.href = data.data.url;
          }, 1000);
        } else {
          setTimeout(function () {
            location.reload();
          }, 1000);
        }

      }).catch(
      function (error) {
        if (error.response.status == 403) {
          layer.msg(error.response.data, {icon: 2});
        }
      });
  });
})

/**
 * 点击提交数据的测试方法不刷新
 */
$('.zf-post-test').click(function () {

  $url   = $(this).data('url');
  $title = $(this).data('title');
  $data  = eval('(' + $(this).data('data') + ')');

  layer.confirm($title, {
    btn: ['确定', '取消']
  }, function () {
    axios.post($url, $data).then(
      function (response) {
        console.log(response.data)
      }).catch(
      function (error) {
        if (error.response.status == 403) {
          layer.msg(error.response.data, {icon: 2});
        }
      });
  });
})

/**
 * 表格点击行,选中input 选项的方法
 */
$('.data-item-tr').click(function (e) {
  console.log(e);
  var $this = $(this);
  if ($(e.target).is('input')) {
    return;
  }

  var $input = $this.find('input');
  if ($input.is(':checked')) {
    $input.prop('checked', false);
  } else {
    $input.prop('checked', true);
  }
});


/**
 * 表格点击全选的方法
 */
if ($('.js-check-wrap').length) {
  var total_check_all = $('input.js-check-all');              //获取名为 js-check-all 的元素

  $.each(total_check_all, function () {                       //可能会有多个js-check-all each循环一下
    var check_all           = $(this);
    var check_all_direction = check_all.data('direction');    //获取放心 可能是 X 或 Y
    var check_list          = check_all.data('checklist');    //获取检查列表
    var check_items         = $('input.js-check[data-' + check_all_direction + 'id="' + check_list + '"]').not(":disabled");


    /**
     * 实现全选反选
     */
    check_all.change(function (e) {
      var check_wrap = check_all.parents('.js-check-wrap');

      if ($(this).prop('checked')) {
        check_items.prop('checked', true);
        if (check_wrap.find('input.js-check').length === check_wrap.find('input.js-check:checked').length) {
          check_wrap.find(total_check_all).prop('checked', true);
        }
      } else {
        check_items.prop('checked',false);
        check_wrap.find(total_check_all).prop('checked',false);

        var direction_invert = check_all_direction === 'x' ? 'y' : 'x';
        check_wrap.find($('input.js-check-all[data-direction="' + direction_invert + '"]')).prop('checked',false);
      }
    });

    check_items.change(function () {
      if ($(this).prop('checked')) {
        if (check_items.filter(':checked').length === check_items.length) {
          check_all.prop('checked', true);
        }
      } else {
        check_all.prop('checked',false);
      }
    });
  });
}

/**
 * 点击回复的方法
 */
if ($('#zf-comment-form').length > 0) {
  $('.zf-comment-reply').click(function () {
    $("#zf-comment-form input[name='parent_id']").val($(this).data('id'))
  });
}
