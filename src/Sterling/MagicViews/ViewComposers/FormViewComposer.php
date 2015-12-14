<?php

namespace Sterling\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;

class FormViewComposer extends ViewComposer
{
    protected $view;

    public function compose(View $view)
    {
        $this->view = $view;

        $model = $view->offsetGet('model');

        $blade = $view->offsetGet('blade');

        $fields = property_exists($model, 'fields') ? $model->fields : $this->formatFillableForForms($model->getFillable());

        $action = $this->getOffset($view, 'action', $this->getFormAction($blade, $view->offsetGet('class')));

        $view->with('fields', $fields)
             ->with('action', $action);
    }

    private function getFormAction($blade, $class)
    {
        // if the action is set on the class then return that
        if (property_exists($class, $blade . 'FormAction'))
            return $this->{$blade . 'FormAction'};

        $configFormAction = config('magic-views.form-actions.' . $blade, false);

        // if the action is set in the config then set that
        if ($configFormAction != false || $configFormAction != '')
            return $this->view->offsetGet('modelName') . '.' . $configFormAction;

        // otherwise we will use a default
        return $this->returnDefaultAction($blade, $this->view->offsetGet('modelName'));
    }

    /**
     * @param $blade
     * @param $modelName
     *
     * @return bool|string
     */
    private function returnDefaultAction($blade, $modelName)
    {
        switch ($blade)
        {
            case 'create':
                return $modelName . '.' . 'store';
            case 'edit':
                return $modelName . '.' . 'update';
            default:
                return false;
        }
    }

    private function formatFillableForForms($fillable)
    {
        $fields = [];

        foreach($fillable as $field)
            $fields[$field] = 'text';

        return $fields;
    }
}