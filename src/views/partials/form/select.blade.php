<div class="form-group @if($errors->has($field)) has-error @endif">
    <label for="{{ $field }}" class="col-sm-3 control-label">{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $field) }}</label>
    <div class="col-sm-6">
        <select class="form-control" id="{{ $field }}" name="{{ $field }}">
            <option>Please Select</option>
            @foreach(${$field . 'Options'} as $key => $value)
                <option value="{{ $key }}" @if(old($field, isset($model) ? $model->$field : null) == $key || request()->input($field) == $key) selected @endif>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>