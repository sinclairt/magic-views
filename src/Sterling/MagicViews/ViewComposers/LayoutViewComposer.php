<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class LayoutViewComposer extends ViewComposer
{
    public function compose(View $view)
    {
        $modelName = $view->offsetGet('modelName');

        $blade = $view->offsetGet('blade');

        $buttons = $this->getOffset($view, 'buttons', [ ]);

        $pageTitle = $this->getOffset($view, 'pageTitle', ucwords(trans('magic-views::magic-views.' . $modelName)));

        $pageSubTitle = $this->getOffset($view, 'pageSubTitle', ucwords(trans('magic-views::magic-views.' . $blade)));

        $panelTitle = $this->getOffset($view, 'panelTitle', $pageTitle . ' ' . $pageSubTitle);

        $view->with('pageTitle', $pageTitle)
             ->with('pageSubTitle', $pageSubTitle)
             ->with('panelTitle', $panelTitle)
             ->with('buttons', $buttons);
    }
}