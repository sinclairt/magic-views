@if(trait_exists($row, 'SoftDeletes'))
    @if($row->trashed())
        <a href="{{ route($model . '.restore', $row->id) }}" class="btn btn-warning">{{ trans('magic-views::buttons.restore') }}</a>
    @else
        @include('magic-views::partials.table.shared.options')
    @endif
@else
    @include('magic-views::partials.table.shared.options')
@endif

