<header class="header">
	<a class="header__logo logo" href="{{ ! Route::is('home') ? route('home', $_SERVER['QUERY_STRING']) : '' }}">
		<img class="logo__img" src="{{ asset('assets/img/logo.png') }}" alt="logo">
	</a>
</header>