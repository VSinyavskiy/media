<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ __('app.shares.title') }}</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="/favicon.png" type="image/png">
  <link rel="shortcut icon" href="/favicon.png" type="image/png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="{{ mix('assets/css/admin.css') }}">

  @yield('custom-css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('admin.partials._header')

  @include('admin.partials._sidebar')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{ $pageTitle or __('admin_layout.global.page_title') }}
        <small>{{ $pageDescription or __('admin_layout.global.page_description') }}</small>
      </h1>

      @yield('breadcrumb')

    </section>

    <section class="content">
      
      @yield('content')

    </section>
  </div>

  @include('admin.partials._footer')

</div>

@yield('modals')

<script src="{{ mix('assets/js/vendor.js') }}"></script>
<script src="{{ mix('assets/js/admin.js') }}"></script>

@yield('custom-script')

</body>
</html>
