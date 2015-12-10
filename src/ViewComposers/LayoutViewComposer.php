<?php

namespace Sterling\MagicView\ViewComposers;

use Illuminate\Contracts\View\View;

class LayoutViewComposer
{
    public function compose(View $view)
    {
        $modelName = $view->offsetGet('modelName');

        $blade = $view->offsetGet('blade');

        if(! $view->offsetExists('breadcrumbs'))
            $breadcrumbs = $this->makeBreadcrumbs($modelName, $blade);

        $view->with('pageTitle', $modelName)
             ->with('pageSubtitle', trans($view))
             ->with('breadcrumbs', $breadcrumbs);
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
            $breadcrumbs[ trans('magic-views::' . $blade) ] = $modelName . '.' . $blade;

        return $breadcrumbs;
    }
}