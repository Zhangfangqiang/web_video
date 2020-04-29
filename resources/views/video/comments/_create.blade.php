<div class="card mt-3">
  <div class="card-header">
    <h5 class="card-title mb-0">留下评论</h5>
  </div>
  <div class="card-body">
    {{--表单错误提示开始--}}
    @include(env('VIEWLAYER').'.shared._error')
    {{--表单错误提示结束--}}

    <form action="{{route('web.comments.store')}}" method="post" id="zf-comment-form">
      <div class="row no-gutters">
        @guest
          <div class="pt-2 pr-2 col-6">
            <input type="text" class="form-control" name="email"    value="{{old('email')}}"    required placeholder="请输入登录邮箱">
          </div>
          <div class="pt-2 col-6">
            <input type="text" class="form-control" name="password" value="{{old('password')}}" required placeholder="请输入密码">
          </div>
        @endguest

        <div class="pt-2 col-12">
          <textarea name="content" class="form-control" id="" cols="30" rows="10" required>{{old('content') ?? "写的不错我会关注你的!!!"}}</textarea>
        </div>

        <div class="pt-2 pr-2 col-6">
          <input type="text" class="form-control" name="captcha" value="{{old('captcha')}}" required placeholder="请输入验证码">
        </div>

        <div class="pt-2 pr-2 col-2">
          <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>

        <div class="pt-2 col-2">
          @csrf
          <input type="text"   hidden name="commentable_type" required  value="{{get_class($model)}}">
          <input type="number" hidden name="commentable_id"   required  value="{{$model->id}}">
          <input type="text"   hidden name="parent_id"            value="{{old('parent_id')}}" >
          <button type="submit" class="btn btn-outline-dark">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
