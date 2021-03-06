@extends('app.layout')

@section('content')
    <section class="ninja-top-block">
        <div class="ninja-top-block__game" id="main">
            <a class="close-btn ninja-top-block__game-stop page-refresh" href="#">
                <div class="close-btn__icon">
                    <svg class="svg">
                        <use xlink:href="#svg-ico-close"></use>
                    </svg>
                </div>
                <div class="close-btn__text"></div>
            </a><iframe width="1440" height="1760" data-src="{{ route('game.iframe') }}" {{ isUserAuthorize() ? "data-share-url=" . route('invite', auth()->guard('web')->user()) : '' }}></iframe></div>
        <div class="ninja-top-block__bg">
            <div class="scene__layer" data-depth="0.6">
                <div class="ninja-top-block__bg-piece ninja-top-block__bg-piece_1 bg-piece bg-piece_potato-chip"></div>
            </div>
            <div class="scene__layer" data-depth="0.8">
                <div class="ninja-top-block__bg-piece ninja-top-block__bg-piece_2 bg-piece bg-piece_potato-chip"></div>
            </div>
        </div>
        {{--<p class="ninja-top-block__desc">Игра весит 3.2Mb</p>--}}
        <a class="ninja-top-block__btn {{ isUserAuthorize() ? 'ninja-top-block__game-start'  : 'prevent-default' }} btn btn_default event-first-play-game" href="#" {{ isUserAuthorize() ? '' : 'data-dialog=#auth-need-game' }}>{{ __('app.pages.home.game') }}</a>
        <div class="scroll-down ninja-top-block__scroll-down">{{ __('app.pages.home.what_will') }}</div>
    </section>
    <section class="steps-block steps-block_w-bg">
        <div class="steps-block__bg">
            <div class="steps-block__bg-piece steps-block__bg-piece_1 bg-piece bg-piece_doner"></div>
            <div class="steps-block__bg-piece steps-block__bg-piece_2 bg-piece bg-piece_doner"></div>
            <div class="steps-block__bg-piece steps-block__bg-piece_3 bg-piece bg-piece_garlic"></div>
            <div class="steps-block__bg-piece steps-block__bg-piece_4 bg-piece bg-piece_tomato"></div>
        </div>
        <ul class="steps-block__list">
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__img step__img_number"><img class="step__number" src="{{ asset('assets/img/number-1.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.game.first_description') }}</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__img step__img_number"><img class="step__number step__number_right" src="{{ asset('assets/img/number-2.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.game.second_description') }}</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__img step__img_number"><img class="step__number" src="{{ asset('assets/img/number-3.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.game.third_description') }}</div>
            </li>
        </ul>
    </section>
    <section class="results-block">
        <div class="results-block__bg">
            <div class="results-block__bg-piece results-block__bg-piece_1 bg-piece bg-piece_pepper-v2"></div>
            <div class="results-block__bg-piece results-block__bg-piece_2 bg-piece bg-piece_onion-rings"></div>
            <div class="results-block__bg-piece results-block__bg-piece_3 bg-piece bg-piece_potato-chip"></div>
            <div class="results-block__bg-piece results-block__bg-piece_4 bg-piece bg-piece_paprica"></div>
        </div>
        <div class="results-block__title">{{ __('app.pages.game.results') }}</div>

        @if(count($results) > 0)
            <ul class="results-block__list">

                @foreach($results as $result)
                    <li class="results-block__item result {{ \Auth::id() == $result->getPlayerId() ? 'result_looser' : '' }}">
                        <div class="result__place"><span>{{ $result->getPlayerRank() }}</span></div>
                        <div class="result__name">{{ $result->getPlayerName() }}</div>
                        <div class="result__score">{{ $result->getPlayerScore() }}</div>
                    </li>
                @endforeach

            </ul>
        @else
            <p>{{ __('app.pages.game.empty') }}</p>
        @endif

        <p class="results-block__desc">{{ __('app.pages.game.question') }}</p>
        <a class="results-block__btn btn btn_default {{ isUserAuthorize() ? 'ninja-top-block__game-start'  : 'prevent-default' }} event-second-play-game" href="#" {{ isUserAuthorize() ? '' : 'data-dialog=#auth-need-game' }}>{{ __('app.pages.home.game') }}</a></section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection

@section('modals')
    @include('auth_app.modals._auth_need_game')
    @include('app.modals._invite_success')
@endsection

@section ('custom-css')
    @if (LaravelLocalization::getCurrentLocale() == 'kz')
        <style type="text/css">
            .ninja-top-block {
                background-image: url({{ asset('assets/img/doner-ninja-tab-kz.png') }});
            }

            @media (min-width: 800px) {
                .ninja-top-block {
                    background-image: url({{ asset('assets/img/doner-ninja-desktop-kz.png') }});
                }
            }
        </style>
    @endif
@endsection
