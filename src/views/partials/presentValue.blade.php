@if($hasPresenter)
    {{ $presentMethod = $row->present()->{ isset(${'present' . studly_case($column)} ) ? ${'present' . studly_case($column)} : camel_case($column)} }}
    @if($presentMethod == '' || $presentMethod == null)
        @if(isView($presentMethod))
            {!! $presentMethod->render() !!}
        @else
            {{ $row->column }}
        @endif
    @endif
@else
    {{ $row->$column }}
@endif