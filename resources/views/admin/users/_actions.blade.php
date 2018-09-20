<div class="action-buttons">
  <a class="btn btn-default btn-xs" href="{{ route('admin.users.show', $user) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.show') }}"><i class="fa fa-eye"></i></a>
  <a class="btn {{ $user->is_mail_confirmed ? 'btn-success' : 'btn-danger' }} btn-xs" href="{{ route('admin.users.update', [$user, 'is_mail_confirmed' => ! $user->is_mail_confirmed]) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.confirmed') }}" data-onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-method="put" data-ajax="true">

  	@if ($user->is_mail_confirmed)
  		<i class="fa fa-check"></i>
  	@else
  		<i class="fa fa-ban"></i>
  	@endif
  	
  </a>
</div>
