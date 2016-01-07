<div class="form-group">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}</label>
    <div class="col-sm-6">
        <input disabled="disabled" type="text" class="form-control" id="{{ $field }}" placeholder="{{ trans('magic-views::magic-views.fields.' . $modelName . '.' .  $field . '_placeholder') }}" name="{{ $field }}" value="{{ old($field, isset($model) ? $model->$field : null) }}">
    </div>
</div>