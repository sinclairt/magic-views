<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class ShowViewComposer
{
    public function compose(View $view)
    {
        $model = $view->offsetGet('model');

        $view->with('columns', $model->getFillable());
    }
}