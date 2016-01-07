
<?php $dropdown = isset($dropdown) ? $dropdown : false; ?>

@if(! $dropdown)
    <div class="row form-group">
        <div class="col-lg-12">
            @endif

            @if(usesSoftDeletes($row))

                @if(can(strtolower($modelName) . '.restore') && ($row->trashed() && (in_array('restore', $buttons) || in_array('all', $buttons))))

                    @if($dropdown)<li>@endif
                        @include('magic-views::partials.table.shared.crud-options', ['buttons' => ['show']])
                    @if($dropdown)</li>@endif

                    @if($dropdown)<li>@endif
                        <a href="{{ route($modelName . '.restore', $row->id) }}" class="@if(! $dropdown) btn btn-warning @endif">{{ get_trans('magic-views::magic-views.buttons.restore') }}</a>
                    @if($dropdown)</li>@endif

                @else
                    @include('magic-views::partials.table.shared.crud-options')
                @endif

            @else

                @include('magic-views::partials.table.shared.crud-options')

            @endif

            @if(! $dropdown)
        </div>
    </div>
@endif
