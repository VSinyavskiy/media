@extends('app.layout')

@section('content')
	<section class="top-spacer"></section>
    <section class="doners-block">
        <a class="close-btn doners-block__back-btn" href="{{ route('user', $_SERVER['QUERY_STRING']) }}">
            <div class="close-btn__icon">
                <svg class="svg">
                    <use xlink:href="#svg-ico-close"></use>
                </svg>
            </div>
            <div class="close-btn__text">{{ __('app.layout.partials.header.close') }}</div>
        </a>
        <div class="doners-block__title"><strong>{{ __('app.pages.history.title') }}</strong></div>
        <ul class="doners-block__list">

            @include('app.users._history_paginate')

        </ul>

        @if ($lastPage != $currentPage && $lastPage != 0)
            <a class="doners-block__btn btn btn_default ajax-more" href="{{ route('history', ['page' =>  $currentPage + 1]) }}" data-last-page="{{ $lastPage }}">
                {{ __('app.pages.history.more') }}
            </a>
        @endif

    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
