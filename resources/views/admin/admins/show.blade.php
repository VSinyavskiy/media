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
      'label' => $pageTitle,
    ],
  ]])
@endsection


@section('content')
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">

          @if ($admin->avatar)
            <img class="profile-user-img img-responsive img-circle" src="{{ $admin->avatar->getUrl() }}" alt="admin profile picture">
          @endif

          <h3 class="profile-adminname text-center">{{ $admin->name }}</h3>

          <p class="text-muted text-center">{{ $admin->email }}</p>

          <a class="btn btn-info btn-block" href="{{ route('admin.admins.edit', $admin) }}"><b>{{ __('admin_layout.global.edit') }}</b></a>

          @if (!$admin->isMe())
            <a class="btn btn-info btn-block" href="{{ route('admin.admins.login_as', $admin) }}" onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-method="get" data-ajax="true"><b>{{ __('admin.admins.login_as') }}</b></a>
          @endif

          @if ($admin->is_removable && !$admin->isMe())
            <a class="btn btn-danger btn-block" href="{{ route('admin.admins.destroy', $admin) }}" onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-method="delete" data-ajax="true"><b>{{ __('admin_layout.global.delete') }}</b></a>
          @endif

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#fields" data-toggle="tab">{{ __('admin.admins.fields_tab') }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="fields">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th width="20%">{{ __('admin.admins.fields.id') }}</th>
                  <td>{{ $admin->id }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.admins.fields.name') }}</th>
                  <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.admins.fields.email') }}</th>
                  <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.admins.fields.created_at') }}</th>
                  <td>{{ $admin->created_at->format('d.m.Y H:i:s') }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.admins.fields.updated_at') }}</th>
                  <td>{{ $admin->updated_at->format('d.m.Y H:i:s') }}</td>
                </tr>
              </tbody>
              <tfoot>
            </table>
          </div>

        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.row -->
@endsection
