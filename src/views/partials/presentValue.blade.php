@if($hasPresenter)
    {{ $presentMethod = $row->present()->{ isset(${'present' . studly_case($column)} ) ? ${'present' . studly_case($column)} : camel_case($column)} }}
    @if($presentMethod == '' || $presentMethod == null)
        {{ $row->column }}
    @endif
@else
    {{ $row->$column }}
@endif