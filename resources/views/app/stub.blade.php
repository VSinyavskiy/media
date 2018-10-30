@extends('app.layout')

@section('content')
    <section class="age-gate age-gate_stub">
    	<img class="age-gate__title" src="{{ asset('assets/img/over.png') }}" alt="{{ __('app.pages.stub.alt') }}">
        <p class="age-gate__desc">{{ __('app.pages.stub.text') }}</p>
        <p class="age-gate__desc">{{ __('app.pages.stub.link_first') }} <a href="{{ route('winners') }}">{{ __('app.pages.stub.link_second') }}</a>{{ __('app.pages.stub.link_third') }}</p>
    </section>
@endsection

@section('share_title')@endsection

@section('share_description')@endsection
