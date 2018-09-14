<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  {{ Form::label('name', __('admin.admins.fields.name'), ['class' => 'col-sm-2 control-label']) }}

  <div class="col-sm-10">
    {{ Form::text('name', null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('name') }}</span>
  </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
  {{ Form::label('email', __('admin.admins.fields.email'), ['class' => 'col-sm-2 control-label']) }}

  <div class="col-sm-10">
    {{ Form::email('email', null, ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('email') }}</span>
  </div>
</div>

<div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
  {{ Form::label('avatar', __('admin.admins.fields.avatar'), ['class' => 'col-sm-2 control-label']) }}

  <div class="col-sm-10">
    {{ Form::file('avatar', ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('avatar') }}</span>

    @if (Route::is('admin.admins.edit') && $admin->avatar)
      <img src="{{ $admin->avatar->getUrl() }}" alt=""><br>
      {{ Form::label('_delete_avatar', __('admin.admins.delete_avatar')) }}
      {{ Form::checkbox('_delete_avatar') }}
    @endif
  </div>
</div>

<hr>

<div class="form-group">
  <label class="col-sm-2 control-label"></label>
  <div class="col-sm-10">
    <button id="password-generate" type="button" class="btn btn-warning col-sm-2" data-route="{{ route('admin.admins.generate_password') }}">{{ __('admin.password_generate') }}</button>
    <p id="generated-password"></p>
  </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
  {{ Form::label('password', __('admin.admins.fields.password'), ['class' => 'col-sm-2 control-label']) }}

  <div class="col-sm-10">
    {{ Form::password('password', ['id' => 'password', 'class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('password') }}</span>
  </div>
</div>

<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
  {{ Form::label('password_confirmation', __('admin.admins.fields.password_confirmation'), ['class' => 'col-sm-2 control-label']) }}

  <div class="col-sm-10">
    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
  </div>
</div>

<div class="box-footer">
  <button type="submit" class="btn btn-primary col-sm-offset-2">{{ __('admin.save') }}</button>
</div>
<!-- /.box-footer -->
