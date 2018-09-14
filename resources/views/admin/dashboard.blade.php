@extends('admin.layout')

@section('breadcrumb')
  @include('admin.partials._breadcrumb', ['links' => [
	[
	  'label'   => __('admin_layout.global.dashboard_title'),
	  'fa-icon' => 'dashboard',
	],
  ]])
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
    </div>
  </div>
@endsection
