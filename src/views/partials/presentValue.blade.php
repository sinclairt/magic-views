@if($hasPresenter)

    <?php $presentMethod = $row->present()->{ isset(${'present' . studly_case($column)} ) ? ${'present' . studly_case($column)} : 'present' . studly_case($column)} ?>

    @if(isView($presentMethod))
        {!! $presentMethod->render() !!}
    @else
        {{ $row->$column }}
    @endif

@else
    {{ $row->$column }}
@endif