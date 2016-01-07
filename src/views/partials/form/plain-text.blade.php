<div class="form-group">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}</label>
    <div class="col-sm-6">
        {{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' .  $field . '_placeholder') }}
    </div>
</div>