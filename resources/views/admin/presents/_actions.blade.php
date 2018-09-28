<a class="btn btn-danger btn-xs delete-present" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.delete') }}" onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-ajax="true"><i class="fa fa-trash"></i>
	{{ Form::open([
		'route' => ['admin.presents.delete', $present],
		'class' => 'ajax-form hidden',
	]) }}
		{{ Form::hidden('_method', 'delete') }}
	{{ Form::close() }}
</a>

