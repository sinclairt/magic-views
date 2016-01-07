<?php

function get_trans($value)
{
    $trans = trans($value);

    if (config('magic-views.use-trans-fallback', true))
    {
        return $trans == $value ? last(explode('.', $value)) : $trans;
    }

    return $trans;
}

function usesSoftDeletes($model)
{
    return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));
}