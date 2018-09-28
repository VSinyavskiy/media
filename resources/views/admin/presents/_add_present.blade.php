{{ Form::open([
	'route' => 'admin.presents',
	'class' => 'ajax-form',
]) }}
	<div class="box">
		<div class="box-header with-border">
			<div class="form-group">
			  {{ Form::label('prize_type', Lang::get('admin.users.fields.presents.prize_name'), ['class' => 'col-sm-2 control-label']) }}

			  <div class="col-sm-9">
			    {{ Form::hidden('user_id', $userId) }}
		  		{{ Form::select('prize_type', $present->getPrizeTypesList(), null, ['class' => 'form-control select2']) }}
			  </div>
			  <div class="pull-right">
			  	<button class="btn btn-success btn-xs" type="submit"><i class="fa fa-check"></i></button>
				<button class="btn btn-danger btn-xs block-dynamic-remove" type="button"><i class="fa fa-trash"></i></button>
			  </div>
			</div>     
		</div>     
	</div>
{{ Form::close() }}
