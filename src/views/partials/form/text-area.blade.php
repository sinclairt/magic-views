<div class="form-group @if($errors->has($field)) has-error @endif">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}</label>
    <div class="col-sm-6">
        <textarea class="form-control" rows="3" id="{{ $field }}" name="{{ $field }}" >{{ old($field, isset($model) ? $model->$field : null) }}</textarea>
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>