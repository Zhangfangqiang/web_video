<div class="media @if($key == 0) pt-0 @endif">
  <img src="{{ImgRe($value->user->avatar ,400 ,400)}}" class="mr-3" alt="{{$value->user->name}}">
  <div class="media-body son-p-mb-5">
    <h5 class="mt-0">{{$value->user->name}}</h5>

      {!! $value->content !!}

      <a class="btn btn-sm btn-outline-dark float-right zf-comment-reply" data-id="{{$value['id']}}" href="#zf-comment-form" id="reply{{$value['id']}}">
        <i class="far fa-edit"></i>
        回复
      </a>
      @can('post-data', $value)
        <a class="zf-delete btn btn-sm btn-outline-danger btn-sm float-right mr-1"
           href="javascript:void(0)"
           data-toggle="tooltip"
           data-original-title="评论删除"
           data-url="{{route('web.comments.destroy',$value->id)}}">
          <i class="far fa-trash-alt"></i> 删除
        </a>
      @endcan

    @if(!empty($value->items))
      @each('web.comments._list_each',$value->items , 'value')
    @endif
  </div>
</div>
