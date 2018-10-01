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
          <h3 class="box-title">{{ str_replace('%s', \App\Models\UserPointsLog::COUNT_FRIEND_INVITES_FOR_DATE, __('admin.exports.invited')) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          {{ Form::open([
            'route' => 'admin.exports.invited',
            'method' => 'post',
          ]) }}
            <div class="row">
              <div class="col-xs-6 col-md-4 col-lg-4 form-group">
                <button type="submit" class="btn btn-primary" >{{ __('admin.exports.download') }}</button>
              </div>
            </div>
          {{ Form::close() }}

        </div>
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ str_replace('%s', \App\Models\User::REPORTS_TOP_COUNT, __('admin.exports.top')) }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          {{ Form::open([
            'route' => 'admin.exports.top',
            'method' => 'post',
          ]) }}
            <div class="row">
              <div class="col-xs-6 col-md-4 col-lg-4 form-group {{ $errors->has('end_top') ? 'has-error' : '' }}">
                <label>{{ __('admin.exports.fields.end_top') }}</label><br>
                {{ Form::text('end_top', date('d/m/Y'), ['class' => 'form-control mask', 'id' => 'end_top', 'data-inputmask' => "'alias': 'dd/mm/yyyy'"]) }}
                <span class="help-block error">{{ $errors->first('end_top') }}</span>
              </div>
              <div class="col-xs-6 col-md-4 col-lg-4 form-group">
                <label>&nbsp;</label><br>
                <button type="submit" class="btn btn-primary" >{{ __('admin.exports.download') }}</button>
              </div>
            </div>
          {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>
@endsection
