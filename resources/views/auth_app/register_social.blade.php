@extends('app.layout')

@section('content')
  <section class="top-spacer"></section>
  <section class="links-block">
      <a class="close-btn links-block__back-btn" href="{{ route('home') }}">
          <div class="close-btn__icon">
              <svg class="svg">
                  <use xlink:href="#svg-ico-close"></use>
              </svg>
          </div>
          <div class="close-btn__text">Закрыть</div>
      </a>
      <ul class="links-block__list">
          <li class="links-block__item"><a class="links-block__link" href="{{ route('login') }}">Вход</a></li>
          <li class="links-block__item links-block__item_active"><a class="links-block__link" href="{{ route('register') }}">Регистрация</a></li>
      </ul>
      
      @include('auth_app.partials._socials')

  </section>
  <section class="register-block form">

    {{ Form::open() }}
      <label class="form__label">Ваше имя</label>
      <div class="form__item form__item_required {{ $errors->has('first_name') ? 'form__item_error' : '' }}">
        {{ Form::text('first_name', $firstName ?? old('first_name'), ['class' => 'form__control', 'placeholder' => 'Введите ваше имя']) }}
        <span class="help-block error">{{ $errors->first('first_name') }}</span>
      </div>

      <label class="form__label">Фамилия</label>
      <div class="form__item form__item_required {{ $errors->has('last_name') ? 'form__item_error' : '' }}">
        {{ Form::text('last_name', $lastName ?? old('last_name'), ['class' => 'form__control', 'placeholder' => 'Введите вашу фамилию']) }}
        <span class="help-block error">{{ $errors->first('last_name') }}</span>
      </div>

      <label class="form__label">Номер телефона</label>
      <div class="form__item form__item_required {{ $errors->has('phone') ? 'form__item_error' : '' }}">
        {{ Form::text('phone', old('phone'), ['class' => 'form__control mask mask_tel', 'placeholder' => '+7 ______ ___ ___']) }}
        <span class="help-block error">{{ $errors->first('phone') }}</span>
      </div>

      <label class="form__label">Повторите номер телефона</label>
      <div class="form__item form__item_required {{ $errors->has('phone_confirmation') ? 'form__item_error' : '' }}">
        {{ Form::text('phone_confirmation', old('phone_confirmation'), ['class' => 'form__control mask mask_tel', 'placeholder' => '+7 ______ ___ ___']) }}
        <span class="help-block error">{{ $errors->first('phone_confirmation') }}</span>
      </div>

      <label class="form__label">Город</label>
      <div class="form__item form__item_required {{ $errors->has('city') ? 'form__item_error' : '' }}">
        {{ Form::text('city', old('city'), ['class' => 'form__control', 'placeholder' => 'Введите ваш город']) }}
        <span class="help-block error">{{ $errors->first('city') }}</span>
      </div>

      <label class="form__label">Email</label>
      <div class="form__item form__item_required {{ $errors->has('email') ? 'form__item_error' : '' }}">
        {{ Form::email('email', $email ?? old('email'), ['class' => 'form__control', 'placeholder' => 'Введите ваш email']) }}
        <span class="help-block error">{{ $errors->first('email') }}</span>
      </div>

      <div class="form__buttons">
        <button class="btn btn_default btn_block" type="submit">Регистрация</button>
      </div>
    {{ Form::close() }}

  </section>
@endsection
