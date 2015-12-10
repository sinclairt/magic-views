<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class LayoutViewComposer
{
    public function compose(View $view)
    {
        $modelName = $view->offsetGet('modelName');

        $blade = $view->offsetGet('blade');

        if (! $view->offsetExists('breadcrumbs'))
            $view->with('breadcrumbs', $this->makeBreadcrumbs($modelName, $blade));

        $view->with('pageTitle', $modelName)
             ->with('pageSubTitle', trans('magic-views::magic-views.' . $blade))
             ->with('panelTitle', $modelName . ' ' . trans('magic-views::magic-views.' . $blade));
    }

    /**
     * @param $modelName
     * @param $blade
     *
     * @return mixed
     */
    private function makeBreadcrumbs($modelName, $blade)
    {
        $breadcrumbs = config('magic-views.breadcrumb-prefix');

        $breadcrumbs[ $modelName ] = $modelName . '.index';

        if ($blade != 'index')
            $breadcrumbs[ $blade ] = $modelName . '.' . $blade;

        return $breadcrumbs;
    }
}