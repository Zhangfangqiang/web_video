@extends('web.layouts.app')

{{--后置css样式开始--}}
@section('after_css')

@endsection
{{--后置css样式结束--}}


{{--中间内容开始--}}
@section('content')
  <div class="row">

    {{--左侧内容开始--}}
    @include('web.users._left_nav')
    {{--左侧内容结束--}}

    {{--右侧内容开始--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4>
            <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
          </h4>
        </div>

        <div class="card-body">

          {{--表单错误提示开始--}}
          @include('web.shared._error')
          {{--表单错误提示结束--}}

          <form action="{{ route('web.users.update', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="form-group">
              <label for="avatar-field">头像</label>
              <input class="form-control" type="file" name="avatar" id="avatar-field"  />
            </div>
            <div class="form-group">
              <label for="name-field">用户名</label>
              <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
            </div>
            <div class="form-group">
              <label for="email-field">邮 箱</label>
              <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" />
            </div>
            <div class="form-group">
              <label for="introduction-field">个人简介</label>
              <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
            </div>

            @csrf
            @method('PUT')

            <div class="well well-sm">
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
          </form>
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
