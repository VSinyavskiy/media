@extends('app.layout')

@section('content')
  <section class="top-spacer"></section>
  <section class="links-block">
      <ul class="links-block__list">
          <li class="links-block__item links-block__item_active"><a class="links-block__link" href="{{ route('login') }}">Вход</a></li>
          <li class="links-block__item"><a class="links-block__link" href="{{ route('register') }}">Регистрация</a></li>
      </ul>

      @include('auth_app.partials._socials')
      
  </section>
  <section class="login-block form">

    {{ Form::open() }}
      <label class="form__label">Номер телефона</label>
      <div class="form__item {{ $errors->has('phone') ? 'form__item_error' : '' }}">
        {{ Form::text('phone', old('phone'), ['class' => 'form__control mask mask_tel', 'placeholder' => '+7 ______ ___ ___']) }}
        <span class="help-block error">{{ $errors->first('phone') }}</span>
      </div>

      <label class="form__label">Пароль</label>
      <div class="form__item {{ $errors->has('password') ? 'form__item_error' : '' }}">
        {{ Form::password('password', ['class' => 'form__control']) }}
        <span class="help-block error">{{ $errors->first('password') }}</span>
      </div>

      <div class="form__buttons">
        <button class="btn btn_default btn_block" type="submit">Войти</button>
      </div>

      <div class="login-block__footer">
        <a class="login-block__link" href="{{ route('password.request') }}">Забыли пароль?</a>
      </div>
    {{ Form::close() }}

  </section>
@endsection
