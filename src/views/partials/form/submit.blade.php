<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <button type="submit" class="btn btn-primary">{{ get_trans('magic-views::magic-views.buttons.submit') }}</button>
        <a href="{{ route( Route::has($modelName . '.index') ? $modelName . '.index' : 'home' ) }}" class="btn btn-default">{{ get_trans('magic-views::magic-views.buttons.cancel') }}</a>
    </div>
</div>