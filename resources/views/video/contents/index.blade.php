@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <!--中间内容开始-->
  <div class="container  video-index">

    <div class="row no-gutters">
      <div class="col-percent-40 rounded-lg-lg zfpr-8">
        <div id="carouselExampleCaptions" class="carousel slide rounded-lg" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{asset('/web/img/l1.jpg')}}" class="d-block w-100 rounded-lg" alt="...">
              <div class="carousel-caption zf-carousel-caption d-none d-md-block">
                <p>11111111111111111111</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{asset('/web/img/l2.jpg')}}" class="d-block w-100 rounded-lg" alt="...">
              <div class="carousel-caption zf-carousel-caption d-none d-md-block">
                <p>111111111111111111111</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-percent-60 zfpl-8 d-flex flex-wrap justify-content-between align-content-between">
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
        <div class="float-left recommend-item">
          <a href='' target="_blank">
            <div class="recommend-top skeleton">
              <picture>
                <img class="video-img rounded-lg"
                     src="https://pic.rmb.bdstatic.com/be4d8290d9f6842178374d4eb47c639d.jpeg@s_2,w_454,h_256,q_100">
              </picture>
              <div class="recommend-mask">
                <p class="recommend-mask-title text-white  overflow-hidden ">林延秋7-2测评，教牛头滚破解对方屏风马，棋友直呼惊呆</p>
                <div class="recommend-info">
                  <p class="text-white">楚河汉界说象棋</p>
                  <p class="text-white">
                  <span class="float-left">
                    <i class="iconfont iconplay"></i>
                    <span>6万</span>
                  </span>
                    <span class="float-left pl-5">
                    <i class="iconfont iconcomments"></i>
                    <span>86</span>
                  </span>
                  </p>
                </div>
              </div>
              <div class="recommend-title text-truncate text-white">林延秋7-2测评，教大家牛头滚破解对方屏风马，棋友直呼惊呆</div>
            </div>
          </a>
        </div>
      </div>
    </div>

    {{--分类循环开始--}}
    @category
    @foreach($categories as $key => $value)
      @php
        $contents = $value->content()->orderBy('release_at','desc')->limit(5)->get();
      @endphp
      @if (count($contents))
        <div>
          <h3 class="card-title">
            <a class="float-left card-title-txt text-black" href="/tab/yingshi">{{$value->name}}</a>
            <a href="/tab/yingshi" class="card-title-more float-right text-decoration-none">
              更多
              <i class="iconfont iconarrow-right"></i>
            </a>
          </h3>
          <div class="d-flex flex-wrap justify-content-start align-content-between  except-first-ml-16">
            @foreach ($contents as $k => $v)
              <div class="card-item rounded-lg">
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
          </div>
        </div>
      @endif
    @endforeach
    @endcategory
    {{--分类循环结束--}}
  </div>
  <!--中间内容结束-->
@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')

@endsection
{{--后置js结束--}}
