@extends('app.layout')

@section('content')
	<section class="age-gate">
        <div class="age-gate__question">{{ __('app.pages.age.question') }}</div>
        <div class="age-gate__response hidden">{{ __('app.pages.age.no_description') }}</div>
        <div class="age-gate__btns">
            <a class="age-gate__btn btn btn_default" href="{{ route('home', $_SERVER['QUERY_STRING'] . '&age_verified') }}">{{ __('app.pages.age.yes') }}</a>
            <a class="age-gate__btn btn btn_default show-no-text" href="#">{{ __('app.pages.age.no') }}</a>
        </div>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
