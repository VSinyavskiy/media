@extends('admin.layout')

@section('breadcrumb')
  @include('admin.partials._breadcrumb', ['links' => [
    [
      'url'     => route('admin.dashboard'),
      'label'   => __('admin_layout.global.dashboard_title'),
      'fa-icon' => 'dashboard',
    ], [
      'url'   => route('admin.users.index'),
      'label' => __('admin.users.title'),
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

          @if ($user->avatar)
            <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar->getUrl() }}" alt="user profile picture">
          @endif

          <h3 class="profile-adminname text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>

          <div class="text-center">
            <p class="text-muted">{{ $user->phone }}</p>
            <p class="text-muted">{{ $user->email }}</p>
            <a class="btn btn-block btn-success add-block" href="#" data-append-block-id="winners_block" data-route="" data-num-block="1">{{ __('admin.users.add_winner') }}</a>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#fields" data-toggle="tab">{{ __('admin.users.fields_tab') }}</a></li>
          <li><a href="#socials" data-toggle="tab">{{ __('admin.users.socials_tab') }}</a></li>
          <li><a href="#points" data-toggle="tab">{{ __('admin.users.points_tab') }}</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="fields">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th width="20%">{{ __('admin.users.fields.id') }}</th>
                  <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.city') }}</th>
                  <td>{{ $user->city }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.is_mail_confirmed') }}</th>
                  <td>{{ getBooleanText($user->is_mail_confirmed) }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.total_points') }}</th>
                  <td>{{ $user->total_points }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.10th_friend_invited_at') }}</th>
                  <td>{{ isset($user->{'10th_friend_invited_at'}) ? $user->{'10th_friend_invited_at'}->format('d.m.Y H:i:s') : '-' }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.friend_invited_count') }}</th>
                  <td>{{ $user->invited_count }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.created_at') }}</th>
                  <td>{{ $user->created_at->format('d.m.Y H:i:s') }}</td>
                </tr>
                <tr>
                  <th>{{ __('admin.users.fields.updated_at') }}</th>
                  <td>{{ $user->updated_at->format('d.m.Y H:i:s') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="socials">

            @if ($user->socials->count())
              <table class="table table-striped">
                <tbody>

                  @foreach ($user->socials as $social)
                    <tr>
                      <th width="20%">{{ $social->social_type }}</th>
                      <td><a href="{{ $social->social_profile }}" target="_blank">{{ $social->social_profile }}</a></td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            @else
              <p class="text-center">{{ __('admin.users.no_socials') }}</p>
            @endif

          </div>
          <div class="tab-pane" id="points">
            @if ($user->points->count())
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                      <th width="20%">{{ __('admin.users.fields.points.event_type') }}</th>
                      <th>{{ __('admin.users.fields.points.points') }}</th>
                      <th>{{ __('admin.users.fields.points.rank') }}</th>
                      <th>{{ __('admin.users.fields.points.scoring_at') }}</th>
                    </tr>
                </thead>
                <tbody>

                  @foreach ($user->sorted_points_desc as $points)
                    <tr>
                      <th width="20%">{{ $points->event_name }}</th>
                      <td>{{ $points->points }}</td>
                      <td>{{ $points->rank ?? '-' }}</td>
                      <td>{{ $points->scoring_at->format('d.m.Y H:i:s') }}</td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            @else
              <p class="text-center">{{ __('admin.users.no_points') }}</p>
            @endif
          </div>

        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.row -->
@endsection
