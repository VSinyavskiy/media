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
        </div><a class="top-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">ПОЗВАТЬ ДРУЗЕЙ</a>
        <div class="scroll-down top-block__scroll-down">Что нужно делать?</div>
    </section>
    <section class="steps-block">
        <ul class="steps-block__list">
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_1 bg-piece bg-piece_onion-rings"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-1.png') }}"><img class="step__number" src="{{ asset('assets/img/number-1.png') }}"></div>
                </div>
                <div class="step__desc">Регистрируйся, делись в соцсетях и зови друзей на помощь!</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_2 bg-piece bg-piece_paprica"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-2.png') }}"><img class="step__number step__number_right" src="{{ asset('assets/img/number-2.png') }}"></div>
                </div>
                <div class="step__desc">Сделай самый вкусный дооонер!</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__bg-piece step__bg-piece_3 bg-piece bg-piece_potato-chip"></div>
                    <div class="step__img"><img class="step__visual img" src="{{ asset('assets/img/step-3.png') }}"><img class="step__number" src="{{ asset('assets/img/number-3.png') }}"></div>
                </div>
                <div class="step__desc">Лидируй в рейтинге донеров и получай призы!</div>
            </li>
        </ul><a class="steps-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">ПОЗВАТЬ ДРУЗЕЙ</a></section>
    <section class="prizes-block"><img class="prizes-block__title" src="{{ asset('assets/img/text-presents.png') }}" alt="prizes">
        <div class="prizes-block__slider slider slider_prizes">
            <div class="slider__track" data-glide-el="track">
                <ul class="slider__slides">
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/prize-2000.png') }}"></div>
                        <div class="slide__desc">{{ __('app.pages.home.certificate_2000') }}</div>
                    </li>
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/gift-card.png') }}"></div>
                        <div class="slide__desc">{{ __('app.pages.home.certificate_10000') }}</div>
                    </li>
                    <li class="slider__slide slide slide_prize">
                        <div class="slide__img"><img src="{{ asset('assets/img/prize-20000.png') }}"></div>
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
                <div class="ninja-block__desc"><b>Играй и попадай в топ лучших</b>чем больше результат, тем длинее твой донер</div><a class="ninja-block__btn btn btn_default" href="{{ route('game') }}">ИГРАТЬ</a></section>
        </div>
        <div class="row__col">
            <section class="doners-block row__block">
                <div class="doners-block__title">САМЫЕ ДЛИННЫЕ<strong>ДОООООНЕРЫ</strong></div>
                <ul class="doners-block__list">

                    @foreach ($topDonerUsers as $key => $topDonerUser)
                        <li class="doners-block__item">
                            <div class="doner-dude">
                                <div class="doner-dude__avatar"><img class="doner-dude__img" src="{{ $topDonerUser->avatar->getUrl() }}">
                                    <div class="doner-dude__place">{{ $key + 1 }}</div>
                                </div>
                                <div class="doner-dude__name">{{ $topDonerUser->first_name }} {{ $topDonerUser->last_name }}<span class="doner-dude__note">Донер как солнце</span></div>
                                <div class="doner-dude__score">{{ $topDonerUser->total_points }}</div>
                            </div>
                        </li>
                    @endforeach

                    @for ($i = $topDonerUsers->count(); $i <= \App\Models\User::COUNT_TOP - $topDonerUsers->count(); $i++)
                        <li class="doners-block__item">
                            <div class="doner-dude">
                                <div class="doner-dude__avatar"><img class="doner-dude__img" src="{{ asset('assets/img/default_avatar.png') }}">
                                    <div class="doner-dude__place">{{ $i + 1 }}</div>
                                </div>
                                <div class="doner-dude__name">TBD<span class="doner-dude__note">Донер как солнце</span></div>
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
                    <div class="friends-block__desc">Окажись в числе самых длинных!<strong>Больше друзей – длиннее дооооонер!</strong></div><a class="friends-block__btn btn btn_default prevent-default" href="#" data-dialog="#{{ isUserAuthorize() ? 'copy-link'  : 'auth-need-invite' }}">ПОЗВАТЬ ДРУЗЕЙ</a></div>
            </section>
            <section class="social-block row__block row__block_half">
                <div class="social-block__desc"><strong>Подпишись на нас в соцсетях</strong>и участвуй в розыгрышах дополнительных подарков!</div>
                <div class="social-block__socials">
                    <a class="social-block__social" href="https://vk.com/lays_kz" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-vk"></use>
                        </svg>
                    </a>
                    <a class="social-block__social" href="https://www.facebook.com/pg/layskazakhstan/posts/?ref=page_internal" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-fb"></use>
                        </svg>
                    </a>
                    <a class="social-block__social" href="https://www.instagram.com/lays_kazakhstan/" target="_blank">
                        <svg class="svg">
                            <use xlink:href="#svg-ico-instagram"></use>
                        </svg>
                    </a>
                </div>
            </section>
        </div>
        <div class="row__col">
            <section class="squares-block row__block"><img class="squares-block__bg" src="{{ asset('assets/img/text-new-lays-doner-whats-it-like-new.png') }}">
                <div class="squares-block__square squares-block__square_1 square square_yellow">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>Такой же насыщенный вкус</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_2 square square_red">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>С привкусом нежного соуса и специй</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_3 square square_green">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>С оттенком свежих овощей</span></div><a class="square__btn" href="#"></a></div>
                <div class="squares-block__square squares-block__square_4 square square_violet">
                    <div class="square__bg"></div>
                    <div class="square__text"><span>Такой, как твой любимый донер</span></div><a class="square__btn" href="#"></a></div>
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
