<div class="action-buttons">
  <a class="btn btn-default btn-xs" href="{{ route('admin.admins.show', $admin) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.show') }}"><i class="fa fa-eye"></i></a>
  <a class="btn btn-default btn-xs" href="{{ route('admin.admins.edit', $admin) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.edit') }}"><i class="fa fa-pencil"></i></a>

  @if (!$admin->isMe())
    <a class="btn btn-default btn-xs" href="{{ route('admin.admins.login_as', $admin) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin.admins.login_as') }}" data-onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-method="get" data-ajax="true"><i class="fa fa-user-secret"></i></a>
  @endif

  @if ($admin->is_removable && !$admin->isMe())
    <a class="btn btn-default btn-xs" href="{{ route('admin.admins.destroy', $admin) }}" data-toggle="tooltip" data-placement="top" title="{{ __('admin_layout.global.delete') }}" data-onclick="if(!confirm('{{ __('admin_layout.global.are_you_sure') }}')) return false;" data-method="delete" data-ajax="true"><i class="fa fa-trash"></i></a>
  @endif

</div>
