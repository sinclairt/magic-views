@if(usesSoftDeletes($row) && head($columnsCopy = $columns) == $column)
    @if($row->trashed())
        <span class="badge badge-danger">Deleted</span>
    @endif
@endif