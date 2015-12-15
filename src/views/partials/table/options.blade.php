@if(trait_exists($row, 'SoftDeletes'))
    @if($row->trashed() && (in_array('restore', $buttons) || in_array('all', $buttons)))
        <a href="{{ route($modelName . '.restore', $row->id) }}" class="btn btn-warning">{{ trans('magic-views::magic-views.buttons.restore') }}</a>
    @else
        @include('magic-views::partials.table.shared.crud-options')
    @endif
@else
    @include('magic-views::partials.table.shared.crud-options')
@endif

