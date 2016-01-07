@if(in_array('show', $buttons) || in_array('all', $buttons))
    @if($dropdown)<li>@endif
        <a href="{{ route($modelName . '.show', $row->id) }}" class="@if(! $dropdown) btn btn-primary @endif">{{ get_trans('magic-views::magic-views.buttons.show') }}</a>
    @if($dropdown)</li>@endif
@endif

@if(in_array('edit', $buttons) || in_array('all', $buttons))
    @if($dropdown)<li>@endif
        <a href="{{ route($modelName . '.edit', $row->id) }}" class="@if(! $dropdown) btn btn-success @endif">{{ get_trans('magic-views::magic-views.buttons.edit') }}</a>
    @if($dropdown)</li>@endif
@endif

@if(in_array('destroy', $buttons) || in_array('all', $buttons))
    @if($dropdown)<li>@endif
        <a href="{{ route($modelName . '.destroy', $row->id) }}" class="@if(! $dropdown) btn btn-danger @endif deleteItem" data-item_id="{{ $row->id }}" data-item_type="{{ $modelName }}">{{ get_trans('magic-views::magic-views.buttons.delete') }}</a>
    @if($dropdown)</li>@endif
@endif