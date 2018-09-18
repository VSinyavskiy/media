<header class="header {{ Route::is('login') || Route::is('register') || Route::is('history') ? 'header_dark' : '' }}">
    <a class="header__button header__button_open" href="#" data-title="Меню">
        <svg class="svg">
            <use xlink:href="#svg-ico-menu"></use>
        </svg>
    </a>
    <a class="header__button header__button_close" href="#" data-title="Меню">
        <svg class="svg">
            <use xlink:href="#svg-ico-close"></use>
        </svg>
    </a>
    <div class="header__menu menu">
        <nav class="menu__nav">
            <ul class="menu__list">
                <li class="menu__item {{ Route::is('home') ? 'menu__item_active' : '' }}"><a class="menu__link" href="{{ route('home') }}">Главная</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Игра</a></li>
                <li class="menu__item {{ Route::is('user') ? 'menu__item_active' : '' }}"><a class="menu__link" href="{{ route('user') }}">Личный кабинет</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Победители</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Правила</a></li>
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
    </div><a class="header__logo logo" href="{{ ! Route::is('home') ? route('home') : '' }}"><img class="logo__img" src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
    <a class="header__user user" href="{{ route('user') }}">
        <div class="user__name">Личный кабинет</div>
        <div class="user__avatar">

            @if (isUserAuthorize())
                @if (auth()->guard('web')->user()->avatar)
                    <img src="{{ auth()->guard('web')->user()->avatar->getUrl() }}"/>
                @else
                    <svg class="svg">
                        <use xlink:href="#svg-ico-person"></use>
                    </svg>
                @endif
            @else
                <svg class="svg">
                    <use xlink:href="#svg-ico-person"></use>
                </svg>
            @endif

        </div>
    </a>
</header>