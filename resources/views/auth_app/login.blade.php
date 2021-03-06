@extends('app.layout')

@section('content')
  <section class="top-spacer"></section>
  <section class="links-block">
      <a class="close-btn links-block__back-btn" href="{{ route('home', $_SERVER['QUERY_STRING']) }}">
          <div class="close-btn__icon">
              <svg class="svg">
                  <use xlink:href="#svg-ico-close"></use>
              </svg>
          </div>
          <div class="close-btn__text">{{ __('app.layout.partials.header.close') }}</div>
      </a>
      <ul class="links-block__list">
          <li class="links-block__item links-block__item_active"><a class="links-block__link" href="{{ route('login', $_SERVER['QUERY_STRING']) }}">{{ __('app.pages.auth.title') }}</a></li>
          <li class="links-block__item"><a class="links-block__link" href="{{ route('register', $_SERVER['QUERY_STRING']) }}">{{ __('app.pages.registration.title') }}</a></li>
      </ul>

      @include('auth_app.partials._socials')
      
  </section>
  <section class="login-block form">

    {{ Form::open() }}
      <label class="form__label">{{ __('app.pages.auth.fields.phone') }}</label>
      <div class="form__item {{ $errors->has('phone') ? 'form__item_error' : '' }}">
        {{ Form::text('phone', old('phone'), ['class' => 'form__control mask mask_tel', 'placeholder' => '+7 ____ __ __ __']) }}
        <span class="help-block error">{{ $errors->first('phone') }}</span>
      </div>

      <label class="form__label">{{ __('app.pages.auth.fields.password') }}</label>
      <div class="form__item {{ $errors->has('password') ? 'form__item_error' : '' }}">
        {{ Form::password('password', ['class' => 'form__control']) }}
        <span class="help-block error">{{ $errors->first('password') }}</span>
      </div>

      <div class="form__buttons">
        <button class="btn btn_default btn_block" type="submit">{{ __('app.pages.auth.button') }}</button>
      </div>

      <div class="login-block__footer">
        <a class="login-block__link prevent-default" href="#" data-dialog="#reset-password">{{ __('app.pages.auth.reset_password') }}</a>
      </div>
    {{ Form::close() }}

  </section>
@endsection

@section('modals')
  @include('auth_app.modals._reset_password')
  @include('auth_app.modals._reset_password_success')
  @include('auth_app.modals._reset_password_second_step')
  @include('auth_app.modals._reset_password_second_step_success')
@endsection
