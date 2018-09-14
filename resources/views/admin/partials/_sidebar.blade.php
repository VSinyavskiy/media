<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu tree" data-widget="tree">

      <li class="{{ Route::is('admin.dashboard') || \Request::is('*languages*') || \Request::is('*countries*') ? 'active' : '' }}">
      	<a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ __('admin_layout.global.dashboard_title') }}</span></a>
      </li>
      <li class="header">{{ __('admin.sidebar.resources_header') }}</li>

    </ul>
  </section>
</aside>
