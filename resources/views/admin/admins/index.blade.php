@extends('admin.layout')

@section('breadcrumb')
  @include('admin.partials._breadcrumb', ['links' => [
    [
      'url'     => route('admin.dashboard'),
      'label'   => __('admin_layout.global.dashboard_title'),
      'fa-icon' => 'dashboard',
    ], [
      'label' => $pageTitle,
    ],
  ]])
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('admin.admins.list_title') }}</h3>
          <div class="pull-right">
            <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">{{ __('admin.admins.create_btn') }}</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="crud-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">{{ __('admin.admins.fields.id') }}</th>
                <th>{{ __('admin.admins.fields.avatar') }}</th>
                <th>{{ __('admin.admins.fields.name') }}</th>
                <th>{{ __('admin.admins.fields.email') }}</th>
                <th>{{ __('admin.admins.fields.created_at') }}</th>
                <th>{{ __('admin.actions') }}</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th class="searchable">{{ __('admin.admins.fields.id') }}</th>
                <th>{{ __('admin.admins.fields.avatar') }}</th>
                <th class="searchable">{{ __('admin.admins.fields.name') }}</th>                
                <th class="searchable">{{ __('admin.admins.fields.email') }}</th>               
                <th>{{ __('admin.admins.fields.created_at') }}</th>
                <th>{{ __('admin.actions') }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('custom-script')
  <script type="text/javascript">
    $(function() {
      namespace('datatable-helper').initTable('#crud-table', '{!! route('admin.admins.data') !!}', [
          { data: 'id', name: 'id' },
          { data: 'avatar', name: 'avatar', searchable: false, orderable: false },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'created_at', name: 'created_at', searchable: false, orderable: false },
          { data: 'actions', searchable: false, orderable: false, width: '8%' }
      ]);
    });
  </script>
@endsection
