<div class="form-group @if($errors->has($field)) has-error @endif">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="{{ $field }}" value="{{ old($field, isset($model) ? $model->$field : null) }}"> {{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}
            </label>
        </div>
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>