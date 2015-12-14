@if(isset($buttons['show']) || isset($buttons['all']))
    <a href="{{ route($modelName . '.show', $row->id) }}" class="btn btn-primary">{{ trans('magic-views::magic-views.buttons.show') }}</a>
@endif

@if(isset($buttons['edit']) || isset($buttons['all']))
    <a href="{{ route($modelName . '.edit', $row->id) }}" class="btn btn-success">{{ trans('magic-views::magic-views.buttons.edit') }}</a>
@endif

@if(isset($buttons['destroy']) || isset($buttons['all']))
    <a href="{{ route($modelName . '.destroy', $row->id) }}" class="btn btn-danger deleteItem" data-item_id="{{ $row->id }}" data-item_type="{{ $modelName }}">{{ trans('magic-views::magic-views.buttons.delete') }}</a>
@endif