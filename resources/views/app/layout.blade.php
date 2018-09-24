<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ __('app.shares.title') }}"/>
    <meta property="twitter:title" content="{{ __('app.shares.title') }}"/>
    <meta property="og:description" content="{{ __('app.shares.description') }}"/>
    <meta property="twitter:description" content="{{ __('app.shares.description') }}"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="{{ asset('assets/img/share.png') }}" />
    <meta property="twitter:image" content="{{ asset('assets/img/share.png') }}"/>
    <link rel="image_src" href="{{ asset('assets/img/share.png') }}" />
    <meta name="title" content="{{ __('app.shares.title') }}" />
    <meta name="description" content="{{ __('app.shares.description') }}" />
    <!--[if IE 6]>
    <script type="text/javascript">location.replace("http://browsehappy.com/");</script><![endif]-->
    <link rel="icon" href="favicon.png" type="image/png"/>
    <link rel="shortcut icon" href="favicon.png" type="image/png"/>
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" type="text/css" media="screen"/>

    @yield('custom-css')

    <title>{{ __('app.shares.title') }}</title>
</head>

<body>
    
    @include('app.partials._svg')

    <div class="app">
        
        @if (Route::is('age'))
          @include('app.partials._header_age_gate')
        @else
          @include('app.partials._header')
        @endif

        <main class="main">
            
          @yield('content')

        </main>
        
        @if (! Route::is('age'))
          @include('app.partials._footer')
        @endif

    </div>

    @yield('modals')

    <script src="{{ mix('assets/js/app.js') }}"></script>

    @yield('custom-js')

</body>

</html>
