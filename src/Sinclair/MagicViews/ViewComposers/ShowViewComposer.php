<?php

namespace Sinclair\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class ShowViewComposer extends ViewComposer
{
    public function compose(View $view)
    {
        $model = $view->offsetGet('model');

        $view->with('columns', $this->getOffset($view, 'columns', $this->getColumns($model)));
    }


}