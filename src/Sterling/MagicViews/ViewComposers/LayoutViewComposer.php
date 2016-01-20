<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class LayoutViewComposer extends ViewComposer
{
    public function compose(View $view)
    {
        $hasPresenter = usesPresenter($view->offsetGet('model'));

        $modelName = $view->offsetGet('modelName');

        $blade = $view->offsetGet('blade');

        $buttons = $this->getOffset($view, 'buttons', [ 'all' ]);

        $pageTitle = $this->getOffset($view, 'pageTitle', ucwords(trans('magic-views::magic-views.' . $modelName)));

        $pageSubTitle = $this->getOffset($view, 'pageSubTitle', ucwords(trans('magic-views::magic-views.' . last(explode('.', $blade)))));

        $panelTitle = $this->getOffset($view, 'panelTitle', $pageTitle . ' ' . $pageSubTitle);

        $view->with('pageTitle', $pageTitle)
             ->with('pageSubTitle', $pageSubTitle)
             ->with('panelTitle', $panelTitle)
             ->with('hasPresenter', $hasPresenter)
             ->with('buttons', $buttons);
    }
}