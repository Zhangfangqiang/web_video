@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include(env('VIEWLAYER').'.users._left_nav', $user)
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <form action="{{route('web.users.content_list', ['user' => $user->id])}}">
            <div class="row">
              <div class="col">
                <input type="text" name="title" value="{{$request->title ?? $request->title}}" class="form-control" placeholder="标题名">
              </div>
              <div class="col">
                <input type="text" name="type" value="{{$request->type}}" hidden>
                <button class="btn btn-primary" type="submit">搜索</button>
                <a class="btn btn-warning" href="{{route('web.users.content_list',['user' => $user->id ,'type'=>$request->type])}}" type="submit">重置</a>
                @if($request->type == 'RELEASE')
                  <a class="btn btn-danger" href="{{ route('web.contents.create', $user->id) }}">创建</a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>

      {{--筛选出来的内容开始--}}
      <div class="card mt-30">
        <div class="card-header">
          <h5 class="float-left">
            @switch($request->type)
              @case('AWESOME')
                我点赞的内容
              @break
              @case('FAVORITE')
                我收藏的内容
              @break
              @case('RELEASE')
                我发布的内容
              @break
            @endswitch
          </h5>
        </div>
        <div class="card-body">
          @php
            $config = [
                'paginate' => 15,
                'order'    => ['release_at','desc']
            ];

            if(!is_null($request->title)){
                $config['otherWhere'][] = ['title','like','%'.$request->title.'%'];
            }

            switch ($request->type)
            {
                case'AWESOME':
                    $config['otherWhereIn'][] = ['id' , $user->awesomeContent->pluck('id')];
                    break;
                case'FAVORITE':
                    $config['otherWhereIn'][] = ['id' , $user->favoriteContent->pluck('id')];
                    break;
                case'RELEASE':
                    $config['otherWhere'][]   = ['user_id' , '=' , $user->id];
                break;
            }
          @endphp

          {{--循环内容开始--}}
          @content($config)
          @if(count($contents) > 0)
            @foreach($contents as $content)
              <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 text-truncate @if($loop->first) border-top-0  pt-0 @endif">
                <a href="{{ route('web.contents.show', $content->id) }}">
                  {{ $content->title }}
                </a>


                {{--操作按钮开始--}}
                @switch($request->type)
                  {{--我喜欢的内容操作开始--}}
                  @case('AWESOME')
                    <button class="float-right zf-post btn btn-outline-secondary  btn-sm mr-1"
                            data-url="{{route('web.contents.cancel_awesome')}}" data-title="确定要取消点赞?"
                            data-data="{'content_id':'{{$content->id}}'}">
                      <i class="fas fa-mouse"></i>
                      取消点赞
                    </button>
                  @break
                  {{--我新欢的内容操作结束--}}

                  {{--我收藏的内容操作开始--}}
                  @case('FAVORITE')
                    <button class="float-right zf-post btn btn-outline-secondary btn-sm mr-1"
                            data-url="{{route('web.contents.cancel_favorite')}}" data-title="确定取消收藏?"
                            data-data="{'content_id':'{{$content->id}}'}">
                      <i class="fas fa-mouse"></i>
                      取消收藏
                    </button>
                  @break
                  {{--我收藏的内容操作结束--}}

                  {{--我发布的内容操作开始--}}
                  @case('RELEASE')
                    <a href="{{ route('web.contents.edit', $content->id) }}" class="btn btn-outline-secondary btn-sm float-right">
                      <i class="far fa-edit"></i> 编辑
                    </a>
                    <button href="javascript:void(0)"
                       class="zf-delete btn btn-outline-secondary btn-sm float-right mr-1"
                       data-toggle="tooltip"
                       data-original-title="文章管理删除"
                       data-url="{{route('web.contents.destroy',$content->id)}}">
                      <i class="far fa-trash-alt"></i> 删除
                    </button>
                  @break;
                  {{--我发布的内容操作结束--}}
                @endswitch
                {{--操作按钮结束--}}

                <span class="meta float-right text-secondary mr-3">
                    {{ $content->comment_count }} 回复
                    <span> ⋅ </span>
                    {{ $content->created_at->diffForHumans() }}
                  </span>
              </li>
            @endforeach
          @else
            暂无内容
          @endif
          @endcontent
          {{--循环内容结束--}}

          <div class="mt-30">
          {!! $contents->appends($request->except('page'))->render() !!}
          </div>
        </div>
      </div>
      {{--筛选出来的内容结束--}}

    </div>
    {{--右侧内容结束--}}
  </div>
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
