@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <!--中间内容开始-->
  <div class="container  video-index">

    {{--推荐内容开始--}}
    <div class="row no-gutters">
      {{--轮播图内容开始--}}
      <div class="col-percent-40 rounded-lg-lg zfpr-8">
        <div id="carouselExampleCaptions" class="carousel slide rounded-lg" data-ride="carousel">
          <div class="carousel-inner">
            @php
              $config = [
                'order' => ['created_at','desc'],
                'offset'=> 0,
                'limit' => 5
              ];
            @endphp
            @content($config)
            @foreach($contents as $key => $value)
              <a href="{{ $value->link() }}" target="_blank">
                <div class="carousel-item @if($loop->first) active @endif">
                  <img src="{{imgRe($value->img , 472 ,265)}}" class="d-block w-100 rounded-lg" alt="">
                  <div class="carousel-caption zf-carousel-caption d-none d-md-block">
                    <p>{{$value->title}}</p>
                  </div>
                </div>
              </a>
            @endforeach
            @endcontent
          </div>

          {{--轮播图左右切换开始--}}
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          {{--轮播图左右切换结束--}}
        </div>
      </div>
      {{--轮播图内容结束--}}

      {{--轮播右侧列表开始--}}
      <div class="col-percent-60 zfpl-8 d-flex flex-wrap justify-content-between align-content-between">
        @php
          $config = [
            'order' => ['created_at','desc'],
            'offset'=> 5,
            'limit' => 6
          ];
        @endphp
        @content($config)
        @foreach($contents as $key => $value)
          <div class="float-left recommend-item">
            <a href='{{ $value->link() }}' target="_blank">
              <div class="recommend-top skeleton">
                <picture>
                  <img class="video-img rounded-lg" src="{{$value->img}}">
                </picture>
                <div class="recommend-mask">
                  <p class="recommend-mask-title text-white  overflow-hidden ">{{$value->title}}</p>
                  <div class="recommend-info">
                    <p class="text-white">{{$value->title}}</p>
                    <p class="text-white">
                      <span class="float-left">
                        <i class="iconfont iconplay"></i>
                        <span>{{$value->watch_count}}</span>
                      </span>
                      <span class="float-left pl-5">
                        <i class="iconfont iconcomments"></i>
                        <span>{{$value->comment_count}}</span>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="recommend-title text-truncate text-white">{{$value->title}}</div>
              </div>
            </a>
          </div>
        @endforeach
        @endcontent
      </div>
      {{--轮播右侧列表结束--}}

    </div>
    {{--推荐内容结束--}}

    {{--需要内容开始--}}
    <div>
      <h3 class="card-title">
        <a class="float-left card-title-txt text-black" href="{{route('web.contents.index',['category' => $category->id ])}}">{{$category->name}}</a>
        <a href="{{route('web.contents.index',['category' => $category->id ])}}" class="card-title-more float-right text-decoration-none">
          更多
          <i class="iconfont iconarrow-right"></i>
        </a>
      </h3>
      <div class="d-flex flex-wrap justify-content-start align-content-between  except-first-ml-16">
        @php
          $config = [
            'otherWhereIn' =>[
               ['id' , App\Models\CategoryHasContent::whereIn('category_id', findChildren($category->id))->get()->pluck('content_id')]
            ],
            'order'    => ['created_at','desc'],
            'paginate' => 30,
          ];
        @endphp
        @content($config)
        @foreach ($contents as $k => $v)
          <div class="card-item rounded-lg" @if($k % 5 == 0) style="margin-left: 0px;" @endif>
            <a href="{{ $v->link() }}" target="_blank" class="text-decoration-none text-black">
              <div class="card-item-top skeleton">
                <picture>
                  <img class="video-img rounded-lg" src="{{$v->img}}">
                </picture>
                <div class="videotime">16:23</div>
              </div>
              <div class="card-bottom">
                <h3 class="card-bottom-title ">{{$v->title}}</h3>
                <p class="card-bottom-nums video-nums clear">
                    <span class="video-com float-left">
                      <i class="iconfont iconplay"></i>
                      <span class="video-com-text">{{$v->watch_count}}</span>
                    </span>
                  <span class="video-com float-left pl-5">
                      <i class="iconfont iconcomments"></i>
                      <span class="video-com-text">{{$v->comment_count}}</span>
                    </span>
                </p>
              </div>
            </a>
          </div>
        @endforeach
        @endcontent
      </div>
    </div>
    {{--需要内容结束--}}
  </div>
  <!--中间内容结束-->
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
