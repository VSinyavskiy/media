@extends('app.layout')

@section('content')
	
    @include('app.users._winners_search')

    <section class="doners-block">

        @if ($presents->count() && $presents->count() > 2)
            <div class="doners-block__bg scene">
                <div class="scene__layer" data-depth="0.6">
                    <div class="doners-block__bg-piece doners-block__bg-piece_1 bg-piece bg-piece_potato-chip"></div>
                </div>
                <div class="scene__layer" data-depth="0.1">
                    <div class="doners-block__bg-piece doners-block__bg-piece_2 bg-piece bg-piece_onion-rings"></div>
                </div>
                <div class="scene__layer" data-depth="0.6">
                    <div class="doners-block__bg-piece doners-block__bg-piece_3 bg-piece bg-piece_tomato"></div>
                </div>
                <div class="scene__layer" data-depth="0.8">
                    <div class="doners-block__bg-piece doners-block__bg-piece_4 bg-piece bg-piece_paprica"></div>
                </div>
                <div class="scene__layer" data-depth="0.7">
                    <div class="doners-block__bg-piece doners-block__bg-piece_5 bg-piece bg-piece_garlic"></div>
                </div>
                <div class="scene__layer" data-depth="0.9">
                    <div class="doners-block__bg-piece doners-block__bg-piece_6 bg-piece bg-piece_potato-chip"></div>
                </div>
            </div>
        @endif

        <ul class="doners-block__list">

            @if ($presents->count())
                @include('app.users._winners_paginate')
            @else
                <p class="not-found-winners">{{ __('app.pages.winners.not_found') }}</p>
            @endif

        </ul>

        @if ($lastPage != $currentPage && $lastPage != 0)
            <a class="doners-block__btn btn btn_default ajax-more" href="{{ route('winners', ['page' =>  $currentPage + 1]) }}" data-last-page="{{ $lastPage }}">
                {{ __('app.pages.winners.more') }}
            </a>
        @endif

    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection

@section ('custom-css')
    @if (LaravelLocalization::getCurrentLocale() == 'kz')
        <style type="text/css">
            .winners-top-block {
                background-image: url({{ asset('assets/img/winners-tab-kz.png') }});
            }

            @media (min-width: 800px) {
                .winners-top-block {
                    background-image: url({{ asset('assets/img/winners-desktop-kz.png') }});
                }
            }
        </style>
    @endif
@endsection
