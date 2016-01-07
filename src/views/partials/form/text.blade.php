<div class="form-group @if($errors->has($field)) has-error @endif">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="{{ $field }}" placeholder="{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' .  $field . '_placeholder') }}" name="{{ $field }}" value="{{ old($field, isset($model) ? $model->$field : null) }}">
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>