@extends('app.layout')

@section('content')
	<section class="age-gate">
        <div class="age-gate__question">Тебе исполнилось 14 лет?</div>
        <div class="age-gate__response hidden">Политика компании позволяет открывать сайт только пользователям старше 14 лет. К сожалению, остальные страницы сайта останутся закрытыми</div>
        <div class="age-gate__btns">
            <a class="age-gate__btn btn btn_default" href="{{ route('home', 'age_verified') }}">ДА</a>
            <a class="age-gate__btn btn btn_default show-no-text" href="#">НЕТ</a>
        </div>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
