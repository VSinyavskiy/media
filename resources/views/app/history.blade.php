@extends('app.layout')

@section('content')
	<section class="top-spacer"></section>
    <section class="doners-block">
        <div class="doners-block__title"><strong>ИСТОРИЯ ПОЛУЧЕНИЯ БАЛЛОВ</strong></div>
        <ul class="doners-block__list">
            <li class="doners-block__item">
                <div class="doner-dude">
                    <div class="doner-dude__action"><span class="doner-dude__date">26.10.2018</span>Привел друга</div>
                    <div class="doner-dude__score">120</div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude">
                    <div class="doner-dude__action"><span class="doner-dude__date">26.10.2018</span>Топ 1 в игре</div>
                    <div class="doner-dude__score">98</div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude">
                    <div class="doner-dude__action"><span class="doner-dude__date">26.10.2018</span>Привел друга</div>
                    <div class="doner-dude__score">87</div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude">
                    <div class="doner-dude__action"><span class="doner-dude__date">26.10.2018</span>Топ 1 в игре</div>
                    <div class="doner-dude__score">67</div>
                </div>
            </li>
            <li class="doners-block__item">
                <div class="doner-dude">
                    <div class="doner-dude__action"><span class="doner-dude__date">26.10.2018</span>Привел друга</div>
                    <div class="doner-dude__score">45</div>
                </div>
            </li>
        </ul><a class="doners-block__btn btn btn_default" href="#">ПОКАЗАТЬ БОЛЬШЕ</a>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
