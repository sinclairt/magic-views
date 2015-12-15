@if($hasPresenter)
    {{ $row->present()->{ isset(${'present' . studly_case($column)} ) ? ${'present' . studly_case($column)} : camelCase($column)} }}
@else
    {{ $row->$column }}
@endif