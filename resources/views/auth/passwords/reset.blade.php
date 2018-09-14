@extends('auth.layout')

@section('content')

  <div class="login-box">
    <div class="login-logo">
      <a href="#">{{ __('admin_layout.global.project_name') }}</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">{{ __('admin_layout.reset_password.title_reset_text') }}</p>

      {{ Form::open([
        'route' => 'password.resetPost',
      ]) }}

        {{ Form::hidden('token', $token) }}
        {{ Form::hidden('email', $email) }}

        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
          {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('admin_layout.login.fields.password'), 'autocomplete' => 'off']) }}
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block">{{ $errors->first('password') }}</span>
        </div>
        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
          {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('admin_layout.login.fields.password_confirmation'), 'autocomplete' => 'off']) }}
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
        </div>

        <div class="row">
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('admin_layout.reset_password.restore') }}</button>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@endsection
