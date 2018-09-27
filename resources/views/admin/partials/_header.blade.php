<header class="main-header">
  <a href="{{ route('home') }}" class="logo" target="_blank">
    <span class="logo-mini">{{ __('admin_layout.global.project_name_short') }}</span>
    <span class="logo-lg">{{ __('admin_layout.global.project_name') }}</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        {{--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><i class="fa fa-language" aria-hidden="true"></i>&nbsp;&nbsp;{{ __('admin.language') }}</span>
            </a>
            <ul class="dropdown-menu">

              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <li>
                      <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                          {{ $properties['native'] }}
                      </a>
                  </li>
              @endforeach

            </ul>
        </li>--}}

          <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ Auth::guard('admin')->user()->avatar->getUrl() }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ Auth::guard('admin')->user()->avatar->getUrl() }}" class="img-circle" alt="{{ Auth::guard('admin')->user()->name }}">
              <p>
                {{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->last_name }}
                <small>{{ Auth::guard('admin')->user()->email }}</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-right">
                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">{{ __('admin_layout.global.logout') }}</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>