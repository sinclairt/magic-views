@if(trait_exists($row, 'SoftDeletes'))
    @if($row->trashed() && (isset($buttons['restore']) || isset($buttons['all'])))
        <a href="{{ route($modelName . '.restore', $row->id) }}" class="btn btn-warning">{{ trans('magic-views::magic-views.buttons.restore') }}</a>
    @else
        @include('magic-views::partials.table.shared.crud-options')
    @endif
@else
    @include('magic-views::partials.table.shared.crud-options')
@endif

