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
          <h3 class="box-title">{{ __('admin.users.list_title') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="crud-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%">{{ __('admin.users.fields.id') }}</th>
                <th>{{ __('admin.users.fields.avatar') }}</th>
                <th>{{ __('admin.users.fields.first_name') }}</th>
                <th>{{ __('admin.users.fields.last_name') }}</th>
                <th>{{ __('admin.users.fields.phone') }}</th>
                <th>{{ __('admin.users.fields.city') }}</th>
                <th>{{ __('admin.users.fields.email') }}</th>
                <th>{{ __('admin.users.fields.is_mail_confirmed') }}</th>
                <th>{{ __('admin.users.fields.total_points') }}</th>
                <th>{{ __('admin.users.fields.10th_friend_invited_at') }}</th>
                <th>{{ __('admin.users.fields.created_at') }}</th>
                <th>{{ __('admin.actions') }}</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th class="searchable">{{ __('admin.users.fields.id') }}</th>
                <th>{{ __('admin.users.fields.avatar') }}</th>
                <th class="searchable">{{ __('admin.users.fields.first_name') }}</th>                
                <th class="searchable">{{ __('admin.users.fields.last_name') }}</th>                
                <th class="searchable">{{ __('admin.users.fields.phone') }}</th>                
                <th class="searchable">{{ __('admin.users.fields.city') }}</th>                
                <th class="searchable">{{ __('admin.users.fields.email') }}</th>                
                <th class="searchable" data-select='{!! getBooleanSearchJson() !!}'>{{ __('admin.users.fields.is_mail_confirmed') }}</th>                
                <th class="searchable">{{ __('admin.users.fields.total_points') }}</th>               
                <th>{{ __('admin.users.fields.10th_friend_invited_at') }}</th>
                <th>{{ __('admin.users.fields.created_at') }}</th>
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
      namespace('datatable-helper').initTable('#crud-table', '{!! route('admin.users.data', ['winners' => $request->winners]) !!}', [
          { data: 'id', name: 'id' },
          { data: 'avatar', name: 'avatar', searchable: false, orderable: false },
          { data: 'first_name', name: 'first_name' },
          { data: 'last_name', name: 'last_name' },
          { data: 'phone', name: 'phone' },
          { data: 'city', name: 'city' },
          { data: 'email', name: 'email' },
          { data: 'is_mail_confirmed', name: 'is_mail_confirmed' },
          { data: 'total_points', name: 'total_points' },
          { data: '10th_friend_invited_at', name: '10th_friend_invited_at', searchable: false },
          { data: 'created_at', name: 'created_at', searchable: false },
          { data: 'actions', searchable: false, orderable: false, width: '8%' }
      ], [
          { name: 'id', condition_value: 'span.winners', class: 'winners-border' },
      ]);
    });
  </script>
@endsection
