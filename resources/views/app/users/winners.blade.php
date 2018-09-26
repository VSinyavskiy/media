@extends('app.layout')

@section('content')
	<form class="winners-top-block form" action="#">
        <div class="winners-top-block__label">{{ __('app.pages.winners.search') }}</div>
        <input class="form__control winners-top-block__control mask mask_tel" type="tel" name="telephone" placeholder="+7 ______ ___ ___">
        <button class="winners-top-block__btn btn btn_default" type="submit">{{ __('app.pages.winners.button') }}</button>
    </form>
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
        <ul class="doners-block__list">
            <li class="doners-block__item">
                <div class="doner-dude doner-dude_w-prize">
                    <div class="doner-dude__avatar">
                        <div class="doner-dude__place">1</div>
                    </div>
                    <div class="doner-dude__name">Name Surname<span class="doner-dude__note">your moto here</span></div>
                    <div class="doner-dude__prize"><img src="assets/img/gift-card.png"></div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude doner-dude_w-prize">
                    <div class="doner-dude__avatar">
                        <div class="doner-dude__place">2</div>
                    </div>
                    <div class="doner-dude__name">Name Surname<span class="doner-dude__note">your moto here</span></div>
                    <div class="doner-dude__prize"><img src="assets/img/gift-card.png"></div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude doner-dude_w-prize">
                    <div class="doner-dude__avatar">
                        <div class="doner-dude__place">3</div>
                    </div>
                    <div class="doner-dude__name">Name Surname<span class="doner-dude__note">your moto here</span></div>
                    <div class="doner-dude__prize"><img src="assets/img/gift-card.png"></div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude doner-dude_w-prize">
                    <div class="doner-dude__avatar">
                        <div class="doner-dude__place">4</div>
                    </div>
                    <div class="doner-dude__name">Name Surname<span class="doner-dude__note">your moto here</span></div>
                    <div class="doner-dude__prize"><img src="assets/img/gift-card.png"></div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude doner-dude_w-prize">
                    <div class="doner-dude__avatar">
                        <div class="doner-dude__place">5</div>
                    </div>
                    <div class="doner-dude__name">Name Surname<span class="doner-dude__note">your moto here</span></div>
                    <div class="doner-dude__prize"><img src="assets/img/gift-card.png"></div>
                </div>
            </li>
        </ul>
        <a class="doners-block__btn btn btn_default" href="#">{{ __('app.pages.winners.more') }}</a>
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
