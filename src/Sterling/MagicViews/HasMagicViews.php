<?php

namespace Sterling\MagicViews;

trait HasMagicViews
{
    public function __call($name, $arguments)
    {
        extract($arguments);

        if (! isset($blade) || ! isset($model))
            throw new \Exception('Magic Views requires at least the blade name and the model object');

        $blade = str_ireplace('view', '', $blade);

        $this->checkViewExists($blade);

        return $this->view($blade, $model, $arguments);
    }

    private function view($blade, $model)
    {
        extract(func_get_arg(2));

        $class = get_class();

        $modelName = $this->getBaseClass();

        $data = array_merge(get_defined_vars(), func_get_args());

        return view('magic-views::crud.' . $blade, $data);
    }

    private function getBaseClass()
    {
        return strtolower(str_ireplace('controller', '', class_basename(get_class())));
    }

    /**
     * @param $blade
     *
     * @throws \Exception
     */
    private function checkViewExists($blade)
    {
        if (! view()->exists('magic-views::crud.' . $blade))
            throw new \Exception('The ' . $blade . ' view does not exist!');
    }


}