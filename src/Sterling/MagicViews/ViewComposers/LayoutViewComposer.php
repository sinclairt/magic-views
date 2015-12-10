<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class LayoutViewComposer
{
    public function compose(View $view)
    {
        $modelName = $view->offsetGet('modelName');

        $blade = $view->offsetGet('blade');

        $view->with('pageTitle', ucwords(trans('magic-views::magic-views.' . $modelName)))
             ->with('pageSubTitle', ucwords(trans('magic-views::magic-views.' . $blade)))
             ->with('panelTitle', ucwords(trans('magic-views::magic-views.' . $modelName)) . ' ' . ucwords(trans('magic-views::magic-views.' . $blade)));
    }
}