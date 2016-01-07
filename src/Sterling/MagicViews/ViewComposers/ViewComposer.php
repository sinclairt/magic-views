<?php

namespace Sterling\MagicViews\ViewComposers;

abstract class ViewComposer
{
    protected function getOffset($view, $var, $default = null)
    {
        return $view->offsetExists($var) ? $view->offsetGet($var) : $default;
    }

    /**
     * @param $model
     *
     * @return array
     */
    protected function getColumns($model)
    {
        if (property_exists($model, 'showColumns'))
            return $model->showColumns;

        return array_diff($model->getFillable(), $model->getHidden());
    }
}