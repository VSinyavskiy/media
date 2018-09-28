<header class="header {{ Route::is('login') || Route::is('register') || Route::is('history') ? 'header_dark' : '' }}">
    <a class="header__button header__button_open" href="#" data-title="{{ __('app.layout.partials.header.menu_item') }}">
        <svg class="svg">
            <use xlink:href="#svg-ico-menu"></use>
        </svg>
    </a>
    <a class="header__button header__button_close" href="#" data-title="{{ __('app.layout.partials.header.menu_item') }}">
        <svg class="svg">
            <use xlink:href="#svg-ico-close"></use>
        </svg>
    </a>
    <div class="header__menu menu">
        <nav class="menu__nav">
            <ul class="menu__list">
                <li class="menu__item {{ Route::is('home') ? 'menu__item_active' : '' }}">
                    <a class="menu__link" href="{{ route('home', $_SERVER['QUERY_STRING']) }}">{{ __('app.layout.partials.header.menu.home') }}</a>
                </li>
                <li class="menu__item {{ Route::is('game') ? 'menu__item_active' : '' }}">
                    <a class="menu__link" href="{{ route('game', $_SERVER['QUERY_STRING']) }}">{{ __('app.layout.partials.header.menu.game') }}</a>
                </li>
                <li class="menu__item {{ Route::is('user') || Route::is('history') ? 'menu__item_active' : '' }}">
                    <a class="menu__link" href="{{ route('user', $_SERVER['QUERY_STRING']) }}">{{ __('app.layout.partials.header.user') }}</a>
                </li>

                @if (\App\Models\Present::issetWinners())
                    <li class="menu__item {{ Route::is('winners') ? 'menu__item_active' : '' }}">
                        <a class="menu__link" href="{{ route('winners', $_SERVER['QUERY_STRING']) }}">{{ __('app.layout.partials.header.menu.winners') }}</a>
                    </li>
                @endif

                <li class="menu__item">
                    <a class="menu__link" href="{{ asset('assets/files/rules.ru.pdf') }}" target="_blank">
                        {{ __('app.layout.partials.header.menu.rules') }}
                    </a>
                </li>
            </ul>
            <ul class="menu__lang lang">

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <li class="lang__item {{ App::getLocale() == $localeCode ? 'lang__item_active' : '' }}">
                      <a class="lang__link" rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                          {{ $properties['short_native'] }}
                      </a>
                  </li>
                @endforeach

            </ul>
        </nav>
    </div><a class="header__logo logo" href="{{ ! Route::is('home') ? route('home', $_SERVER['QUERY_STRING']) : '' }}"><img class="logo__img" src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
    <a class="header__user user" href="{{ route('user', $_SERVER['QUERY_STRING']) }}">

        @if (isUserAuthorize())
            <div class="user__name">{{ auth()->guard('web')->user()->first_name }} {{ auth()->guard('web')->user()->last_name }}</div>
            <div class="user__avatar">
                <img src="{{ auth()->guard('web')->user()->avatar->getUrl() }}" width="70px" />
            </div>
        @else
            <div class="user__name">{{ __('app.layout.partials.header.user') }}</div>
            <div class="user__avatar">
                <img src="{{ asset('assets/img/default_avatar.png') }}" width="70px" />
            </div>
        @endif

    </a>
</header>