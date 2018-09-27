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

    @if (LaravelLocalization::getCurrentLocale() == 'kz')
        <meta property="og:image" content="{{ asset('assets/img/default_share-kz.png') }}" />
        <meta property="twitter:image" content="{{ asset('assets/img/default_share-kz.png') }}"/>
        <link rel="image_src" href="{{ asset('assets/img/default_share-kz.png') }}" />
    @else
        <meta property="og:image" content="{{ asset('assets/img/default_share.png') }}" />
        <meta property="twitter:image" content="{{ asset('assets/img/default_share.png') }}"/>
        <link rel="image_src" href="{{ asset('assets/img/default_share.png') }}" />
    @endif


    <meta name="title" content="{{ __('app.shares.title') }}" />
    <meta name="description" content="{{ __('app.shares.description') }}" />
    <!--[if IE 6]>
    <script type="text/javascript">location.replace("http://browsehappy.com/");</script><![endif]-->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png"/>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png"/>
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" type="text/css" media="screen"/>

    @yield('custom-css')

    <title>{{ __('app.shares.title') }}</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125405817-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-125405817-1');
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter50253663 = new Ya.Metrika2({
                        id:50253663,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
</head>

<body>
    <noscript><div><img src="https://mc.yandex.ru/watch/50253663" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    
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
