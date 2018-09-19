@extends('app.layout')

@section('content')
	<section class="ninja-top-block">
        <div class="ninja-top-block__bg">
            <div class="scene__layer" data-depth="0.6">
                <div class="ninja-top-block__bg-piece ninja-top-block__bg-piece_1 bg-piece bg-piece_potato-chip"></div>
            </div>
            <div class="scene__layer" data-depth="0.8">
                <div class="ninja-top-block__bg-piece ninja-top-block__bg-piece_2 bg-piece bg-piece_potato-chip"></div>
            </div>
        </div>
        <p class="ninja-top-block__desc">Игра весит 40mb</p><a class="ninja-top-block__btn btn btn_default" href="#">ИГРАТЬ</a>
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
                    <div class="step__img step__img_number"><img class="step__number" src="assets/img/number-1.png"></div>
                </div>
                <div class="step__desc">Играй в игру, зарабатывай баллы и попадай в топ 3 игрового рейтинга</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__img step__img_number"><img class="step__number step__number_right" src="assets/img/number-2.png"></div>
                </div>
                <div class="step__desc">Держись в рейтенге лучших до конца дня и получай баллы к твоему доннеру</div>
            </li>
            <li class="steps-block__item step">
                <div class="step__bg">
                    <div class="step__img step__img_number"><img class="step__number" src="assets/img/number-3.png"></div>
                </div>
                <div class="step__desc">Чем больше донер – тем больше призов. Дерзай</div>
            </li>
        </ul>
    </section>
    <section class="results-block">
        <div class="results-block__bg">
            <div class="results-block__bg-piece results-block__bg-piece_1 bg-piece bg-piece_pepper"></div>
            <div class="results-block__bg-piece results-block__bg-piece_2 bg-piece bg-piece_onion-rings"></div>
            <div class="results-block__bg-piece results-block__bg-piece_3 bg-piece bg-piece_potato-chip"></div>
            <div class="results-block__bg-piece results-block__bg-piece_4 bg-piece bg-piece_paprica"></div>
        </div>
        <div class="results-block__title">Лучшие результаты за день</div>
        <ul class="results-block__list">
            <li class="results-block__item result">
                <div class="result__place"><span>1</span></div>
                <div class="result__name">Name Surname</div>
                <div class="result__score">220</div>
            </li>
            <li class="results-block__item result">
                <div class="result__place"><span>2</span></div>
                <div class="result__name">Name Surname</div>
                <div class="result__score">210</div>
            </li>
            <li class="results-block__item result">
                <div class="result__place"><span>3</span></div>
                <div class="result__name">Name Surname</div>
                <div class="result__score">208</div>
            </li>
            <li class="results-block__item result result_looser">
                <div class="result__place"><span>3</span></div>
                <div class="result__name">Name Surname</div>
                <div class="result__score">208</div>
            </li>
        </ul>
        <p class="results-block__desc">Чего же ждешь, бей рекорд и зарабатывай баллы к твоему донеру</p>
        <a class="results-block__btn btn btn_default" href="#">ИГРАТЬ</a>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection

@section('modals')
    @include('app.modals._invite_success')
@endsection
