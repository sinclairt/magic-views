<a href="{{ route($model . '.show', $row->id) }}" class="btn btn-primary">{{ trans('magic-views::buttons.show') }}</a>
<a href="{{ route($model . '.edit', $row->id) }}" class="btn btn-success">{{ trans('magic-views::buttons.edit') }}</a>
<a href="{{ route($model . '.delete', $row->id) }}" class="btn btn-danger deleteItem" data-item_id="{{ $row->id }}" data-item_type="{{ $modelName }}">{{ trans('magic-views::buttons.delete') }}</a>