@extends('app.layout')

@section('content')
	<section class="user-top-block">
        <div class="user-top-block__bg scene">
            <div class="scene__layer" data-depth="0.6">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_1 bg-piece bg-piece_potato-chip"></div>
            </div>
            <div class="scene__layer" data-depth="0.1">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_2 bg-piece bg-piece_garlic"></div>
            </div>
            <div class="scene__layer" data-depth="0.7">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_3 bg-piece bg-piece_paprica"></div>
            </div>
            <div class="scene__layer" data-depth="0.7">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_4 bg-piece bg-piece_paprica"></div>
            </div>
            <div class="scene__layer" data-depth="0.9">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_5 bg-piece bg-piece_onion-rings"></div>
            </div>
            <div class="scene__layer" data-depth="0.8">
                <div class="user-top-block__bg-piece user-top-block__bg-piece_6 bg-piece bg-piece_potato-chip"></div>
            </div>
        </div><img class="user-top-block__title" src="{{ asset('assets/img/text-personal-donery.png') }}" alt="personal donery">
        <div class="user-top-block__doner doner">
            <div class="doner__name">{{ $user->first_name }} {{ $user->last_name }}</div>
            <div class="doner__info">
                <div class="doner__avatar"><img class="doner__img" src="{{ $user->avatar->getUrl() }}">
                    <a class="doner__logout" href="{{ route('logout') }}">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-logout"></use>
                        </svg>
                    </a>
                </div>
                <div class="doner__score">{{ $user->total_points }}</div>
            </div>
            <div class="doner__desc"><b>Размер твоего донера</b><a class="doner__link" href="{{ route('history') }}">История получения баллов</a></div>
        </div>
        <div class="user-top-block__counter">Ты позвал {{ $user->invited_count }} {{ pluralize($user->invited_count, 'друга', 'друзей', 'друзей') }}</div>
        <a class="user-top-block__btn btn btn_default prevent-default" href="#" data-dialog="#copy-link">ПОЗВАТЬ ЕЩЕ</a>
    </section>
    <section class="share-block">
        <div class="share-block__socials">
            <a class="share-block__social" href="#">
                <svg class="svg">
                    <use xlink:href="#svg-ico-vk"></use>
                </svg>
            </a>
            <a class="share-block__social" href="#">
                <svg class="svg">
                    <use xlink:href="#svg-ico-fb"></use>
                </svg>
            </a>
        </div>
    </section>
    <section class="doners-block">
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
        <div class="doners-block__title">САМЫЕ ДЛИННЫЕ<strong>ДОООООНЕРЫ</strong></div>
        <ul class="doners-block__list">

            @foreach ($topDonerUsers as $key => $topDonerUser)
                <li class="doners-block__item {{ isset($topDonerUser->position) ? 'doners-block__item_highlighted' : '' }}">
                    <div class="doner-dude">
                        <div class="doner-dude__avatar"><img class="doner-dude__img" src="{{ $topDonerUser->avatar->getUrl() }}">
                            <div class="doner-dude__place">{{ $topDonerUser->position ?? $key + 1 }}</div>
                        </div>
                        <div class="doner-dude__name">{{ $topDonerUser->first_name }} {{ $topDonerUser->last_name }}<span class="doner-dude__note">Донер как солнце</span></div>
                        <div class="doner-dude__score">{{ $topDonerUser->total_points }}</div>
                    </div>
                </li>
            @endforeach

        </ul>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection

@section('modals')
    @include('app.modals._invite')
    @include('auth_app.modals._registration_confirmed_email')
@endsection
