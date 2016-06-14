<div class="form-group @if($errors->has($field)) has-error @endif">
    <div class="col-sm-offset-3 col-sm-6">
        @foreach(${$field . 'Options'} as $option)
            <div class="radio">
                <label>
                    <input type="radio" name="{{ $field }}" value="{{ $option }}" @if(old($field, isset($model) ? $model->$field : null) == $option) checked @endif> {{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $option) }}
                </label>
            </div>
        @endforeach
    </div>
    @if($errors->has($field))
        <div class="col-sm-3">
            <p class="alert alert-danger">{{ $errors->first($field) }}</p>
        </div>
    @endif
</div>