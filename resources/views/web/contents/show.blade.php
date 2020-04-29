@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')

  <div class="row">
    {{--左侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $content->title }}
          </h1>

          {{--统计内容开始--}}
          <div class="article-meta text-center text-secondary">

            {{--分类开始--}}
            {{categoryHtmlTag($content->category)}}
            {{--分类结束--}}

            <span class="text-success"> | </span>

            <a class="text-secondary" href="{{ route('web.users.show', [$content->user_id]) }}" title="{{ $content->user->name }}">
              <i class="far fa-user"></i>
              {{ $content->user->name }}
            </a>

            <span class="text-success"> | </span>

            最后活跃时间:
            <span class="timeago" title="最后活跃于：{{ $content->updated_at }}">{{ $content->updated_at->diffForHumans() }}</span>

            <span class="text-success"> | </span>

            发布时间:
            <span class="timeago" title="发布时间：{{ $content->updated_at }}">{{ $content->release_at }}</span>
          </div>
          {{--统计内容结束--}}

          {{--内容开始--}}
          <div class="topic-body mt-4 mb-4">
            {!! $content->content !!}
          </div>
          {{--内容结束--}}

          {{--操作开始--}}
          @auth
          <div class="operate">
            <hr>
            {{--删除编辑开始--}}
            @can('post-data', $content)
              <a href="{{ route('web.contents.edit', $content->id) }}" class="btn btn-outline-secondary btn-sm">
                <i class="far fa-edit"></i> 编辑
              </a>

              <a href="javascript:void(0)"
                 class="zf-delete btn btn-outline-secondary btn-sm"
                 data-toggle="tooltip"
                 data-original-title="文章管理删除"
                 data-url="{{route('web.contents.destroy',$content->id)}}">
                <i class="far fa-trash-alt"></i> 删除
              </a>
            @endcan
            {{--删除编辑结束--}}

            {{--关注开始--}}
            @can('attention',App\Models\User::find($content->user_id))
              <button class="btn btn-sm btn-outline-primary float-right zf-post"
                      data-url="{{route('web.users.attention')}}" data-title="确定要关注?"
                      data-data="{'user_id':'{{$content->user_id}}'} ">+关注
              </button>
            @else
              @if(Auth::user()->id != $content->user_id)
                <button class="btn btn-sm btn-outline-primary float-right zf-post"
                        data-url="{{route('web.users.cancel_attention')}}" data-title="确定要取消关注?"
                        data-data="{'user_id':'{{$content->user_id}}'} ">-取消关注
                </button>
              @endif
            @endcan
            {{--关注结束--}}

            {{--点赞开始--}}
            @can('awesome',App\Models\Content::find($content->id))
              <button class="float-right zf-post btn btn-outline-danger btn-sm mr-1"
                      data-url="{{route('web.contents.awesome')}}" data-title="确定点赞"
                      data-data="{'content_id':'{{$content->id}}'}">
                <i class="fas fa-mouse"></i>
                点赞
              </button>
            @else
              @if(Auth::user()->id != $content->user_id)
                <button class="float-right zf-post btn btn-outline-danger btn-sm mr-1"
                        data-url="{{route('web.contents.cancel_awesome')}}" data-title="确定要取消点赞?"
                        data-data="{'content_id':'{{$content->id}}'}">
                  <i class="fas fa-mouse"></i>
                  取消点赞
                </button>
              @endif
            @endcan
            {{--点赞结束--}}

            {{--收藏开始--}}
            @can('favorite',App\Models\Content::find($content->id))
              <button class="float-right zf-post btn btn-outline-warning btn-sm mr-1" style="color: #212529"
                      data-url="{{route('web.contents.favorite')}}" data-title="确定收藏"
                      data-data="{'content_id':'{{$content->id}}'}">
                <i class="fas fa-mouse"></i>
                收藏
              </button>
            @else
              @if(Auth::user()->id != $content->user_id)
                <button class="float-right zf-post btn btn-outline-warning btn-sm mr-1" style="color: #212529"
                        data-url="{{route('web.contents.cancel_favorite')}}" data-title="确定取消收藏"
                        data-data="{'content_id':'{{$content->id}}'}">
                  <i class="fas fa-mouse"></i>
                  取消收藏
                </button>
              @endif
            @endcan
            {{--收藏结束--}}

          </div>
          @endguest
          {{--操作结束--}}

        </div>
      </div>

      {{--评论列表开始--}}
      @include('web.comments._list'   , ['model' =>$content])
      {{--评论列表结束--}}

      {{--评论创建表单开始--}}
      @include('web.comments._create' , ['model' =>$content])
      {{--评论创建表单结束--}}
    </div>
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">
            作者：{{ $content->user->name }}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('web.users.show', $content->user->id) }}">
                <img class="thumbnail img-fluid" src="{{imgRe($content->user->avatar ,400 ,400)}}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--右侧内容结束--}}
  </div>
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
