<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-123215367-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-123215367-1');
      
    </script>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield('share_title')"/>
    <meta property="twitter:title" content="@yield('share_title')"/>
    <meta property="og:description" content="@yield('share_description')"/>
    <meta property="twitter:description" content="@yield('share_description')"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="" />
    <meta property="twitter:image" content=""/>
    <link rel="image_src" href="" />
    <meta name="title" content="@yield('share_title')" />
    <meta name="description" content="@yield('share_description')" />
    <meta name="keywords" content="" /><!--[if IE 6]>
    <script type="text/javascript">location.replace("http://browsehappy.com/");</script><![endif]-->
    <link rel="icon" href="/favicon.png" type="image/png"/>
    <link rel="shortcut icon" href="/favicon.png" type="image/png"/>
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" type="text/css" media="screen"/>

    @yield('custom-css')

    <title>Петровская Слобода</title>
  </head>
  <body>
    <div class="app">
      
      @include('app.partials._header')

      <main>

        @yield('content')

      </main>

      @yield('product-stores')
    </div>
    
    @include('app.partials._layout_stores')
    
    @include('app.modals._news')

    @include('app.partials._footer')

    <script src="{{ mix('assets/js/app.js') }}"></script>
  </body>
</html>