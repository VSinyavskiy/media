@extends('auth.layout')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="#">{{ __('admin_layout.global.project_name') }}</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{ __('admin_layout.reset_password.title_email_text') }}</p>

      {{ Form::open([
        'route' => 'password.email',
      ]) }}
        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
          {{ Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => __('admin_layout.login.fields.email')]) }}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <span class="help-block">{{ $errors->first('email') }}</span>
        </div>

        <div class="row">
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('admin_layout.reset_password.restore') }}</button>
          </div>
        </div>
      {{ Form::close() }}

      @if (session('status')) 
        <div style="color: green">
          <p>{{ __('admin_layout.reset_password.success') }}</p>
        </div>
      @endif

    </div>
  </div>
@endsection
