<ol class="breadcrumb">
  @foreach($links as $i => $params)
    @if (isset($params['url']))
      <li>
        <a href="{!! $params['url'] !!}">
          {!! isset($params['fa-icon']) ? ('<i class="fa fa-' . $params['fa-icon'] . '"></i>') : '' !!}
          {!! $params['label'] !!}
        </a>
      </li>
    @else
      <li class="active">
        {!! isset($params['fa-icon']) ? ('<i class="fa fa-' . $params['fa-icon'] . '"></i>') : '' !!}
        {!! $params['label'] !!}
      </li>
    @endif
  @endforeach
</ol>
