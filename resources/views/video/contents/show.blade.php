@extends(env('VIEWLAYER').'.layouts.app')

{{--后置css样式开始--}}
@section('after_css')
  <style>
    @media (min-width: 1665px) {
      .container, .container-sm, .container-md, .container-lg, .container-xl {
        max-width: 1665px;
      }
    }
  </style>
  <link href="http://vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="container video-show">

    <div class="row no-gutters">
      {{--左侧内容开始--}}
      <div class="col-percent-80 show-content" >
        <div>
          <!--视频开始-->
          <div class="video">
            <video style="width: 100%; height: 720px; background: #000;"  id="my-player" class="video-js" controls preload="auto" poster="{{$content->img}}" data-setup='{ "aspectRatio":"640:267", "playbackRates": [1.00,1.50,2.00,2.50] }'>
              <source src="{{$content->video}}" type="video/mp4">

              <p class="vjs-no-js">
                要观看此视频，请启用JavaScript，或者使用下面推荐浏览器
                <a href="https://www.google.cn/chrome/" target="_blank">
                  谷歌浏览器
                </a>
              </p>
            </video>
          </div>
          <!--视频结束-->

          {{--视频信息开始--}}
          <div class="video-info">
            <h2 class="videoinfo-title">{{$content->title}}</h2>

            <div class="videoinfo-text">
              <span class="videoinfo-playnums float-left">来源:{{$content->source}} <span style="color: red;">如作品作者禁止分享转载,请联系发布者删除</span>  | {{$content->watch_count}}次播放&nbsp;|&nbsp;发布时间：{{$content->release_at}}</span>

              {{--操作开始--}}
              @auth
                {{--删除编辑开始--}}
                @can('post-data', $content)
                  <a href="{{ route('web.contents.edit', $content->id) }}"
                     class="btn btn-outline-secondary btn-sm float-right">
                    <i class="far fa-edit"></i> 编辑
                  </a>

                  <a href="javascript:void(0)"
                     class="zf-delete btn btn-outline-secondary btn-sm float-right mr-2"
                     data-toggle="tooltip"
                     data-original-title="文章管理删除"
                     data-url="{{route('web.contents.destroy',$content->id)}}">
                    <i class="far fa-trash-alt"></i> 删除
                  </a>
                @endcan
                {{--删除编辑结束--}}

                {{--点赞开始--}}
                @can('awesome',App\Models\Content::find($content->id))
                  <button class="float-right zf-post btn btn-outline-danger btn-sm mr-1" style="border-color:#ffffff;"
                          data-url="{{route('web.contents.awesome')}}" data-title="确定点赞"
                          data-data="{'content_id':'{{$content->id}}'}">
                    <i class="iconfont icongood fs-22"></i>
                    点赞{{$content->awesome_count}}
                  </button>
                @else
                  @if(Auth::user()->id != $content->user_id)
                    <button class="float-right zf-post btn btn-outline-danger btn-sm mr-1" style="border-color:#ffffff;"
                            data-url="{{route('web.contents.cancel_awesome')}}" data-title="确定要取消点赞?"
                            data-data="{'content_id':'{{$content->id}}'}">
                      <i class="iconfont icongood fs-22"></i>
                      取消点赞
                    </button>
                  @endif
                @endcan
                {{--点赞结束--}}

                {{--收藏开始--}}
                @can('favorite',App\Models\Content::find($content->id))
                  <button class="float-right zf-post btn btn-outline-warning btn-sm mr-1" style="color: #212529; border-color:#ffffff;"
                          data-url="{{route('web.contents.favorite')}}" data-title="确定收藏"
                          data-data="{'content_id':'{{$content->id}}'}">
                    <i class="iconfont iconcollection fs-22"></i>
                    收藏{{$content->favorite_count}}
                  </button>
                @else
                  @if(Auth::user()->id != $content->user_id)
                    <button class="float-right zf-post btn btn-outline-warning btn-sm mr-1" style="color: #212529; border-color:#ffffff;"
                            data-url="{{route('web.contents.cancel_favorite')}}" data-title="确定取消收藏"
                            data-data="{'content_id':'{{$content->id}}'}">
                      <i class="iconfont iconcollection fs-22"></i>
                      取消收藏
                    </button>
                  @endif
                @endcan
                {{--收藏结束--}}
              @endguest
              {{--操作结束--}}
            </div>

            <div class="author">
              <div class="author-main float-left pr-2">
                <a href="{{ route('web.users.show', $content->user->id) }}" class="author-link" target="_blank">
                  <img src="{{ $content->user->avatar }}" class="rounded-circle" style="width: 54px;height: 54px;" alt="">
                </a>
              </div>

              <div class="author-detail float-left">
                <p class="tag-1 ">
                  <a class="text-black" href="https://haokan.baidu.com/author/1660307426051428" target="_blank">{{ $content->user->name }}</a>
                </p>
                <p class="tag-2">
                  <span class="pr-2">{{$content->user->introduction}}</span>
                  <span>5.2万粉丝</span>
                </p>
              </div>

              <div class="author-follow float-right">
                <div class="follow-container ">
                  {{--关注开始--}}
                  @auth
                    @can('attention',App\Models\User::find($content->user_id))
                      <button class="btn btn-danger zf-btn-danger zf-post"
                              data-url="{{route('web.users.attention')}}" data-title="确定要关注?"
                              data-data="{'user_id':'{{$content->user_id}}'} ">+关注
                      </button>
                    @else
                      @if(Auth::user()->id != $content->user_id)
                        <button class="btn btn-danger zf-btn-danger zf-post"
                                data-url="{{route('web.users.cancel_attention')}}" data-title="确定要取消关注?"
                                data-data="{'user_id':'{{$content->user_id}}'} ">-取消关注
                        </button>
                      @endif
                    @endcan
                  @endauth
                  {{--关注结束--}}
                </div>
              </div>

            </div>
          </div>
          {{--视频信息结束--}}

          {{--评论列表开始--}}
          @include(env('VIEWLAYER').'.comments._list'   , ['model' =>$content])
          {{--评论列表结束--}}

          {{--评论创建表单开始--}}
          @include(env('VIEWLAYER').'.comments._create' , ['model' =>$content])
          {{--评论创建表单结束--}}
        </div>
      </div>
      {{--左侧内容结束--}}

      {{--右侧内容开始--}}
      <div class="col-percent-20" style="height: 300px;">
        <div>

          <h3 class="next-title list-group ">
            接下来播放
          </h3>

          <ul class="next-list">
            @php
              $config['search']         = $content->title;
              $config['paginate']       =  20;
              $config['order']          = ['release_at' ,'desc'];
            @endphp
            @content($config)
            @foreach( $contents as $key => $value )
              <li title="老梁观世界：马航MH17究竟是被谁击落的三方都有嫌疑！" style="margin-bottom: 16px;">
                <a href="{{$value->link()}}}" class="text-black text-decoration-none">
                  <div class="media">
                    <img src="{{imgRe($value->img ,146 ,83)}}"
                         class="rounded-lg mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 ">{{$value->title}}</h5>
                      <p class="next-list-info">
                        <span class="float-left">
                          <i class="iconfont iconplay"></i>
                          {{$value->watch_count}}
                        </span>
                        <span class="float-left pl-2">
                          <i class="iconfont iconcomments"></i>
                          {{$value->comment_count}}
                        </span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
            @endcontent
          </ul>
        </div>
      </div>
      {{--右侧内容结束--}}
    </div>
  </div>

@endsection
{{--中间内容结束--}}


{{--后置js开始--}}
@section('after_js')
  <script src="http://vjs.zencdn.net/7.3.0/video.min.js"></script>
  <script>
    $(function(){
      var $refreshButton = $('#refresh');
      var $results = $('#css_result');

      function refresh(){
        var css = $('style.cp-pen-styles').text();
        $results.html(css);
      }

      refresh();
      $refreshButton.click(refresh);

      // Select all the contents when clicked
      $results.click(function(){
        $(this).select();
      });
    });

  </script>
@endsection
{{--后置js结束--}}
