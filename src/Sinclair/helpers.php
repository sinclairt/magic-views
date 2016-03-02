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
    return usesTrait($model, 'Illuminate\Database\Eloquent\SoftDeletes');
}

function usesPresenter($model)
{
    return usesTrait($model, 'Laracasts\Presenter\PresentableTrait');
}

function isView($object)
{
    return $object instanceof Illuminate\View\View;
}

function usesTrait($model, $trait)
{
    $currentModelUsesPresenter = in_array($trait, class_uses($model));

    $parentModelUsesPresenter = false;

    foreach (class_parents($model) as $parent)
        if (in_array($trait, class_uses($parent)))
            $parentModelUsesPresenter = true;

    return $currentModelUsesPresenter == true || $parentModelUsesPresenter == true;
}