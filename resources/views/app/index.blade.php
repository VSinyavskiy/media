@extends('app.layout')

@section('content')
	<section class="top-block">
        <div class="top-block__bg scene">
            <div class="scene__layer" data-depth="0.6">
                <div class="top-block__bg-piece top-block__bg-piece_1 bg-piece bg-piece_tomato"></div>
            </div>
            <div class="scene__layer" data-depth="0.5">
                <div class="top-block__bg-piece top-block__bg-piece_2 bg-piece bg-piece_onion"></div>
            </div>
            <div class="scene__layer" data-depth="0.1">
                <div class="top-block__bg-piece top-block__bg-piece_3 bg-piece bg-piece_garlic"></div>
            </div>
            <div class="scene__layer" data-depth="0.6">
                <div class="top-block__bg-piece top-block__bg-piece_4 bg-piece bg-piece_potato-chip"></div>
            </div>
            <div class="scene__layer" data-depth="0.8">
                <div class="top-block__bg-piece top-block__bg-piece_5 bg-piece bg-piece_potato-chip"></div>
            </div>
            <div class="scene__layer" data-depth="0.7">
                <div class="top-block__bg-piece top-block__bg-piece_6 bg-piece bg-piece_paprica"></div>
            </div>
            <div class="scene__layer" data-depth="0.9">
                <div class="top-block__bg-piece top-block__bg-piece_7 bg-piece bg-piece_onion-rings"></div>
            </div>
            <div class="scene__layer" data-depth="0.1">
                <div class="top-block__bg-piece top-block__bg-piece_8 bg-piece bg-piece_pepper"></div>
            </div>
        </div><a class="top-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">{{ __('app.pages.home.invite') }}</a>
        <div class="scroll-down top-block__scroll-down">{{ __('app.pages.home.what_will') }}</div>
    </section>
    <section class="steps-block">
        <ul class="steps-block__list">
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_1 bg-piece bg-piece_onion-rings"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-1.png') }}"><img class="step__number" src="{{ asset('assets/img/number-1.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.home.registration') }}</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_2 bg-piece bg-piece_paprica"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-2.png') }}"><img class="step__number step__number_right" src="{{ asset('assets/img/number-2.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.home.make') }}</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_3 bg-piece bg-piece_potato-chip"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-3.png') }}"><img class="step__number" src="{{ asset('assets/img/number-3.png') }}"></div>
                </div>
                <div class="step__desc">{{ __('app.pages.home.long') }}</div>
            </li>
        </ul><a class="steps-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">{{ __('app.pages.home.invite') }}</a></section>
    <section class="prizes-block">

        @if (LaravelLocalization::getCurrentLocale() == 'kz')
            <img class="prizes-block__title" src="{{ asset('assets/img/text-presents-kz.png') }}" alt="prizes">
        @else
            <img class="prizes-block__title" src="{{ asset('assets/img/text-presents.png') }}" alt="prizes">
        @endif

        <div class="prizes-block__slider slider slider_prizes">
            <div class="slider__track" data-glide-el="track">
                <ul class="slider__slides">
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/prize-2000' . (App::getLocale() == 'kz' ? '-kz' : '') .  '.png') }}"></div>
                        <div class="slide__desc">{{ __('app.pages.home.certificate_2000') }}</div>
                    </li>
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/gift-card' . (App::getLocale() == 'kz' ? '-kz' : '') .  '.png') }}"></div>
                        <div class="slide__desc">{{ __('app.pages.home.certificate_10000') }}</div>
                    </li>
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/prize-20000' . (App::getLocale() == 'kz' ? '-kz' : '') .  '.png') }}"></div>
                        <div class="slide__desc">{{ __('app.pages.home.certificate_20000') }}</div>
                    </li>
                </ul>
            </div>
            <div class="slider__arrows" data-glide-el="controls"><button class="slider__arrow slider__arrow_left" data-glide-dir="&lt;"><svg class="svg"><use xlink:href="#svg-ico-chevron-left"></use></svg></button><button class="slider__arrow slider__arrow_right" data-glide-dir="&gt;"><svg class="svg"><use xlink:href="#svg-ico-chevron-right"></use></svg></button></div>
        </div>
    </section>
    <div class="row">
        <div class="row__col">
            <section class="ninja-block row__block">
                <div class="ninja-block__bg">
                    <div class="ninja-block__bg-piece ninja-block__bg-piece_1 bg-piece bg-piece_potato-chip"></div>
                    <div class="ninja-block__bg-piece ninja-block__bg-piece_2 bg-piece bg-piece_garlic"></div>
                    <div class="ninja-block__bg-piece ninja-block__bg-piece_3 bg-piece bg-piece_tomato"></div>
                    <div class="ninja-block__bg-piece ninja-block__bg-piece_4 bg-piece bg-piece_potato-chip"></div>
                </div>
                <div class="ninja-block__desc"><b>{{ __('app.pages.home.game_description') }}</b>{{ __('app.pages.home.result') }}</div>
                <a class="ninja-block__btn btn btn_default event-play-home" href="{{ route('game', $_SERVER['QUERY_STRING']) }}">{{ __('app.pages.home.game') }}</a>
            </section>
        </div>
        <div class="row__col">
            <section class="doners-block row__block">
                <div class="doners-block__title">{!! __('app.pages.home.top_title') !!}</div>
                <ul class="doners-block__list">

                    @foreach ($topDonerUsers as $key => $topDonerUser)
                        <li class="doners-block__item">
                            <div class="doner-dude">
                                <div class="doner-dude__avatar"><img class="doner-dude__img" src="{{ $topDonerUser->avatar->getUrl() }}">
                                    <div class="doner-dude__place">{{ $key + 1 }}</div>
                                </div>
                                <div class="doner-dude__name">{{ $topDonerUser->first_name }} {{ $topDonerUser->last_name }}<span class="doner-dude__note">{{ __('app.pages.home.doner')[$key] }}</span></div>
                                <div class="doner-dude__score">{{ $topDonerUser->total_points }}</div>
                            </div>
                        </li>
                    @endforeach

                    @for ($i = isset($key) ? $key + 1 : 0; $i < \App\Models\User::COUNT_TOP - $topDonerUsers->count() + isset($key) ? 1 : 0; $i++)
                        <li class="doners-block__item">
                            <div class="doner-dude">
                                <div class="doner-dude__avatar"><img class="doner-dude__img" src="{{ asset('assets/img/default_avatar.png') }}">
                                    <div class="doner-dude__place">{{ $i + 1 }}</div>
                                </div>
                                <div class="doner-dude__name">TBD<span class="doner-dude__note">{{ __('app.pages.home.doner')[$i] }}</span></div>
                                <div class="doner-dude__score">-</div>
                            </div>
                        </li>
                    @endfor

                </ul>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="row__col">
            <section class="friends-block row__block row__block_half">
                <div class="friends-block__container">
                    <div class="friends-block__bg">
                        <div class="friends-block__bg-piece friends-block__bg-piece_1 bg-piece bg-piece_garlic"></div>
                        <div class="friends-block__bg-piece friends-block__bg-piece_2 bg-piece bg-piece_potato-chip"></div>
                        <div class="friends-block__bg-piece friends-block__bg-piece_3 bg-piece bg-piece_potato-chip"></div>
                        <div class="friends-block__bg-piece friends-block__bg-piece_4 bg-piece bg-piece_onion-slices"></div>
                    </div>
                    <div class="friends-block__desc">{{ __('app.pages.home.on_top') }}<strong>{{ __('app.pages.home.more_friends') }}</strong></div><a class="friends-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">{{ __('app.pages.home.invite') }}</a></div>
            </section>
            <section class="social-block row__block row__block_half">
                <div class="social-block__desc"><strong>{{ __('app.pages.home.subscribe_title') }}</strong>{{ __('app.pages.home.subscribe_description') }}</div>
                <div class="social-block__socials">
                    <a class="social-block__social event-go-to-vk-home" href="https://vk.com/lays_kz" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-vk"></use>
                        </svg>
                    </a>
                    <a class="social-block__social event-go-to-fb-home" href="https://www.facebook.com/pg/layskazakhstan/posts/?ref=page_internal" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-fb"></use>
                        </svg>
                    </a>
                    <a class="social-block__social event-go-to-ig-home" href="https://www.instagram.com/lays_kazakhstan/" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-instagram"></use>
                        </svg>
                    </a>
                </div>
            </section>
        </div>
        <div class="row__col">
            <section class="squares-block row__block">

                @if (LaravelLocalization::getCurrentLocale() == 'kz')
                    <img class="squares-block__bg" src="{{ asset('assets/img/text-new-lays-doner-whats-it-like-new-kz.png') }}">
                @else
                    <img class="squares-block__bg" src="{{ asset('assets/img/text-new-lays-doner-whats-it-like-new.png') }}">
                @endif

                <div class="squares-block__square squares-block__square_1 square square_yellow">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>{{ __('app.pages.home.taste_first') }}</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_2 square square_red">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>{{ __('app.pages.home.taste_second') }}</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_3 square square_green">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>{{ __('app.pages.home.taste_third') }}</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_4 square square_violet">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>{{ __('app.pages.home.taste_fourth') }}</span></div><a class="square__btn" href="#"></a></div>
            </section>
        </div>
    </div>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection

@section('modals')

    @if (isUserAuthorize())
        @include('app.modals._invite')
    @endif

    @include('auth_app.modals._auth_need_invite')
    @include('auth_app.modals._auth_social_error')
    @include('auth_app.modals._auth_social_error_is_mail_confirmed')
    @include('auth_app.modals._registration_confirm_email')
@endsection

@section ('custom-css')
    @if (LaravelLocalization::getCurrentLocale() == 'kz')
        <style type="text/css">
            .top-block__bg {
                background-image: url({{ asset('assets/img/main-tab-kz.png') }});
            }
            .ninja-block__bg {
                background-image: url({{ asset('assets/img/doner-ninja-kz.png') }});
            }

            @media (min-width: 1200px) {
                .top-block__bg {
                    background-image: url({{ asset('assets/img/main-desktop-kz.png') }});
                }
            }
        </style>
    @endif
@endsection
