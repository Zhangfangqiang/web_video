<div class="card mt-3 zf-comments-list" id="zf-comment-list">
  <div class="card-header">
    <h5 class="card-title mb-0">评论列表</h5>
  </div>

  <div class="card-body">

    @php
      $config = [
        'with'          => ['children', 'user'],
        'select'        => \DB::raw(" * , concat(path,',',id) AS paths"),
        'otherWhere'    => [
          ['commentable_type', '=' , get_class($model) ],
          ['commentable_id'  , '=' , $model->id        ]
         ],
         'order'        => ['paths' , 'desc'],
      ];
    @endphp
    {{--评论列表开始--}}
    @comments($config)
      @if(count($comments = $comments->nest()) != 0)
        @each('web.comments._list_each',$comments , 'value')
      @else
        还没有人评论,抢占前排沙发
      @endif
    @endcomments
    {{--评论列表结束--}}
  </div>
</div>

