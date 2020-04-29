@extends(env('VIEWLAYER').'.layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Verify Your Email Address') }}</div>

          <div class="card-body">
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                      {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                  @endif
                  {{ __('Before proceeding, please check your email for a verification link.') }}
                  {{ __('If you did not receive the email') }},
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>
                <div class="col-md-6">
                  <input id="captcha" class="form-control @error('captcha') is-invalid @enderror" name="captcha" required>

                  <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

                  @error('captcha')
                  <span class="invalid-feedback" role="alert" style=" clear: both;">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              @csrf

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
