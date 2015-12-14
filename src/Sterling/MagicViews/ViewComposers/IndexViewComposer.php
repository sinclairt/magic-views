<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class IndexViewComposer extends ViewComposer
{
    public function compose(View $view)
    {
        $model = $view->offsetGet('model');

        $columns = property_exists($model, 'indexColumns') ? $model->indexColumns: $this->getColumns($model);

        $view->with('columns', $columns);
    }
}