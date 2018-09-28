<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu tree" data-widget="tree">

      <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
      	<a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ __('admin_layout.global.dashboard_title') }}</span></a>
      </li>
      <li class="header">{{ __('admin.sidebar.resources_header') }}</li>

      <li class="{{ Request::is('*users*') && ! Request::has('winners') ? 'active' : '' }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> {{ __('admin.sidebar.users') }}</a>
      </li>

      @if (\App\Models\Present::issetWinners()) 
        <li class="{{ Request::is('*users*') && Request::has('winners') ? 'active' : '' }}">
          <a href="{{ route('admin.users.index', ['winners' => true]) }}"><i class="fa fa-trophy"></i> {{ __('admin.sidebar.winners') }}</a>
        </li>
      @endif

    </ul>
  </section>
</aside>
