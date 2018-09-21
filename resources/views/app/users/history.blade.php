@extends('app.layout')

@section('content')
	<section class="top-spacer"></section>
    <section class="doners-block">
        <div class="doners-block__title"><strong>ИСТОРИЯ ПОЛУЧЕНИЯ БАЛЛОВ</strong></div>
        <ul class="doners-block__list">

            @include('app.users._history_paginate')

        </ul>

        @if ($lastPage != $currentPage && $lastPage != 0)
            <a class="doners-block__btn btn btn_default ajax-more" href="{{ route('history', ['page' =>  $currentPage + 1, 'points' => $totalPointsWithoutShowed]) }}" data-last-page="{{ $lastPage }}">
                ПОКАЗАТЬ БОЛЬШЕ
            </a>
        @endif

    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
