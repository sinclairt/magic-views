<?php

namespace Sterling\MagicViews\ViewComposers;

abstract class ViewComposer
{
    protected function getOffset($view, $var, $default = null)
    {
        return $view->offsetExists($var) ? $view->offsetGet($var) : $default;
    }
}