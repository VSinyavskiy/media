@extends('admin.layout')

@section('breadcrumb')
  @include('admin.partials._breadcrumb', ['links' => [
    [
      'url'     => route('admin.dashboard'),
      'label'   => __('admin_layout.global.dashboard_title'),
      'fa-icon' => 'dashboard',
    ], [
      'url'   => route('admin.admins.index'),
      'label' => __('admin.admins.title'),
    ], [
      'label' => __('admin.admins.create_title'),
    ],
  ]])
@endsection

@section('content')
{{ Form::open([
  'route' => 'admin.admins.store',
  'class' => 'form-horizontal',
  'files' => true,
]) }}
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('admin.admins.create_list_title') }}</h3>
        </div>
        <div class="box-body">

          @include('admin.admins._form')

        </div>
      </div>
    </div>
  </div>
{{ Form::close() }}

@endsection
