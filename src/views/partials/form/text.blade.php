<div class="form-group @if($errors->has($field)) has-error @endif">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ trans('magic-views::magic-views.' . $field, $field) }}</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="{{ $field }}" placeholder="{{ trans('magic-views::magic-views.' . $field, $field) }}" name="{{ $field }}" value="{{ old($field, isset($model) ? $model->$field : null) }}">
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>