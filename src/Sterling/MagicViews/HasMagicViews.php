<?php

namespace Sterling\MagicViews;

trait HasMagicViews
{
    public function __call($name, $arguments)
    {
        if (sizeof($arguments) > 0)
            extract($arguments[ 0 ]);

        $model = ! isset($model) ? app(ucwords($this->getBaseClass())) : $model;

        if (! is_object($model))
            throw new \Exception('Magic Views requires the model object');

        $blade = isset($blade) ? $blade : str_ireplace('view', '', $name);

        $blade = $this->checkViewExists($blade);

        return $this->view($blade, $model, $arguments);
    }

    private function view($blade, $model, $args)
    {
        if (sizeof($args) > 0)
            extract($args[ 0 ]);

        $class = get_class();

        $modelName = $this->getBaseClass();

        $data = array_merge(get_defined_vars(), func_get_args());

        $data['blade'] = str_replace('magic-views::crud.', '', $blade);

        return view($blade, $data);
    }

    private function getBaseClass()
    {
        return strtolower(str_ireplace('controller', '', class_basename(get_class())));
    }

    /**
     * @param $blade
     *
     * @return string
     * @throws \Exception
     */
    private function checkViewExists($blade)
    {
        if (! view()->exists('magic-views::crud.' . $blade) && ! view()->exists($blade))
            throw new \Exception('The ' . $blade . ' view does not exist!');

        if(view()->exists($blade))
            return $blade;

        return 'magic-views::crud.' . $blade;
    }


}