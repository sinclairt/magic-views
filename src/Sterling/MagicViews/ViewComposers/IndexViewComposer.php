<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class IndexViewComposer
{
    public function compose(View $view)
    {
        $model = $view->offsetGet('model');

        $columns = property_exists($model, 'indexColumns') ? $model->indexColumns: $model->getFillable();

        $view->with('columns', $columns);
    }
}