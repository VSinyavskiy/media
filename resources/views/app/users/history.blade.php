@extends('app.layout')

@section('content')
	<section class="top-spacer"></section>
    <section class="doners-block">
        <a class="close-btn doners-block__back-btn" href="{{ route('user') }}">
            <div class="close-btn__icon">
                <svg class="svg">
                    <use xlink:href="#svg-ico-close"></use>
                </svg>
            </div>
            <div class="close-btn__text">Закрыть</div>
        </a>
        <div class="doners-block__title"><strong>ИСТОРИЯ ПОЛУЧЕНИЯ БАЛЛОВ</strong></div>
        <ul class="doners-block__list">

            @include('app.users._history_paginate')

        </ul>

        @if ($lastPage != $currentPage && $lastPage != 0)
            <a class="doners-block__btn btn btn_default ajax-more" href="{{ route('history', ['page' =>  $currentPage + 1]) }}" data-last-page="{{ $lastPage }}">
                ПОКАЗАТЬ БОЛЬШЕ
            </a>
        @endif

    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
