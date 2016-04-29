<?php

namespace Sinclair\MagicViews\ViewComposers;

use Illuminate\Contracts\View\View;
use Route;
use Illuminate\Support\Facades\Input;

class BreadcrumbViewComposer extends ViewComposer
{
    public function compose( View $view )
    {
        // set default home route if it exists
        $breadcrumbs = Route::has('home') ? [ 'home' => 'home' ] : [ ];

        // first we need to set the model, we may need to get the first row
        if ( $model = $this->getModelFromView($view) )
            $this->addBreadcrumbs($model, $breadcrumbs);

        $route = explode('.', Route::currentRouteName());

        if ( Route::currentRouteName() != 'home' )
            $breadcrumbs[ trans('magic-views::magic-views.' . last($route)) ] = last($route);

        $view->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    protected function getModelFromView( View $view )
    {
        if ( $view->offsetExists('model') )
            return $view->offsetGet('model');

        if ( $view->offsetExists('rows') )
            return $view->offsetGet('rows')
                        ->first();

        return false;
    }

    /**
     * @param $model
     * @param $breadcrumbs
     */
    protected function addBreadcrumbs( $model, &$breadcrumbs = [ ] )
    {
        // if the parent has a parent we need to go up the chain or we can try and guess the parent
        // but only if there is one foreign key in the fillable array otherwise its too much guessing
        $this->handleParent($model, $breadcrumbs);

        // if we have a specified method to add the objects breadcrumbs perfect we'll use that!
        if ( method_exists($model, 'addBreadcrumbs') )
            $breadcrumbs = array_merge($breadcrumbs, $model->addBreadcrumbs());
        else
        {
            // else we will try and guess them
            // first we will need to snake case the model base name as that's the naming convention we're assuming
            $snake_case_model = $this->snakeCaseModel($model);

            // next we need to set the index route
            $indexRoute = $this->setIndexRoute($model, $breadcrumbs, $snake_case_model);

            // and then the edit route
            $this->setEditRoute($model, $breadcrumbs, $snake_case_model, $indexRoute);
        }
    }

    /**
     * @param $snake_case_model
     *
     * @return string
     */
    protected function properCase( $snake_case_model )
    {
        return ucwords(str_replace('_', ' ', $snake_case_model));
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    protected function getModelDescriber( $model )
    {
        if ( property_exists($model, 'describer') )
            return $model->describer;

        if ( $model->name != null || $model->name != '' )
            return $model->name;

        if ( $model->text != null || $model->text != '' )
            return $model->text;

        return $this->properCase($this->snakeCaseModel($model));
    }

    /**
     * @param $model
     *
     * @return string
     */
    protected function snakeCaseModel( $model )
    {
        return snake_case(class_basename(get_class($model)));
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    protected function guessParentRelationship( $model )
    {
        $foreignKeys = $this->filterPotentialForeignKeys($model);

        if ( sizeof($foreignKeys) == 1 )
            return $this->getRelationshipFromKey(head($foreignKeys));

        return false;
    }

    /**
     * @param $model
     *
     * @return array
     */
    protected function filterPotentialForeignKeys( $model )
    {
        return array_filter($model->getFillable(), function ( $value )
        {
            return str_contains($value, '_id');
        });
    }

    /**
     * @param $foreignKey
     *
     * @return mixed
     */
    protected function getRelationshipFromKey( $foreignKey )
    {
        return str_replace('_id', '', $foreignKey);
    }

    /**
     * @param $snake_case_model
     *
     * @param $indexRoute
     *
     * @param $editRoute
     *
     * @return string
     */
    protected function getDefaultRestRoutes( $snake_case_model, $indexRoute, $editRoute )
    {
        $routes = [
            $snake_case_model . '.create',
            $snake_case_model . '.show'
        ];

        $defaultIndex = $snake_case_model . '.index';

        $defaultEdit = $snake_case_model . '.edit';

        if ( $indexRoute == $defaultIndex )
            $routes[] = $indexRoute;

        if ( is_array($indexRoute) )
            $routes[] = head($indexRoute);

        if ( $editRoute == $defaultEdit )
            $routes[] = $editRoute;

        if ( is_array($editRoute) )
            $routes[] = head($editRoute);

        return $routes;
    }

    /**
     * @param $model
     * @param $breadcrumbs
     *
     */
    protected function handleParent( $model, &$breadcrumbs )
    {
        // if the model doesn't exist the parent may have been passed through as a query string
        if ( !$model->exists )
        {
            // to be sure lets see if any of the input array matched the foreign keys
            $possibleInputParents = $this->getPossibleInputValuesAsParents($model);

            if ( sizeof($possibleInputParents) == 1 )
                $this->addBreadcrumbs($this->establishParentFromInput($possibleInputParents), $breadcrumbs);
        }
        elseif ( method_exists($model, 'parentRelationship') )
        {
            $this->addBreadcrumbs($model->parentRelationship(), $breadcrumbs);
        }
        elseif ( $relationship = $this->guessParentRelationship($model, $breadcrumbs) )
        {
            $this->addBreadcrumbs($model->$relationship, $breadcrumbs);
        }
    }

    /**
     * @param $snake_case_model
     *
     * @param $model
     *
     * @return string
     */
    protected function getDefaultEditRoute( $snake_case_model, $model )
    {
        return property_exists($model, 'breadcrumbEdit') ? $model->breadcrumbEdit : $snake_case_model . '.edit';
    }

    /**
     * @param $model
     * @param $snake_case_model
     *
     * @return string
     */
    protected function getDefaultIndexRoute( $model, $snake_case_model )
    {
        return property_exists($model, 'breadcrumbIndex') ? $model->breadcrumbIndex : $snake_case_model . '.index';
    }

    /**
     * @param $model
     * @param $breadcrumbs
     * @param $snake_case_model
     *
     * @return array
     */
    protected function setIndexRoute( $model, &$breadcrumbs, $snake_case_model )
    {
        // we might need the parent model for the route so lets try and get that
        $relationship = $this->guessParentRelationship($model);

        // check whether we have a predefined index route otherwise we'll guess it
        $indexRoute = $this->getDefaultIndexRoute($model, $snake_case_model);

        // if the guessed route exists we need to add it the breadcrumbs.
        // We'll try and add the parent model for good measure just in case it needs it, it won't hurt if not.
        if ( Route::has($indexRoute) )
            $breadcrumbs[ str_plural($this->properCase($snake_case_model)) ] = $this->addModelToRoute($model, $relationship, $indexRoute);

        // We'll need to return the route for the edit comparisons later
        return $indexRoute;
    }

    /**
     * @param $model
     * @param $breadcrumbs
     * @param $snake_case_model
     * @param $indexRoute
     *
     * @return mixed
     */
    protected function setEditRoute( $model, &$breadcrumbs, $snake_case_model, $indexRoute )
    {
        // lets try and guess the edit route
        $editRoute = $this->getDefaultEditRoute($snake_case_model, $model);

        // if the route is the models index we don't want to offer the edit route we will need a descriptive breadcrumbs such as all.
        // Also if the model doesn't exist we wont be able to get the id for the route anyway
        if ( !in_array(Route::currentRouteName(), $this->getDefaultRestRoutes($snake_case_model, $indexRoute, $editRoute)) && Route::has($editRoute) && $model->exists )
            $breadcrumbs[ str_plural($this->getModelDescriber($model)) ] = [ $editRoute, $model ];
    }

    /**
     * @param $model
     * @param $relationship
     * @param $indexRoute
     *
     * @return array
     */
    protected function addModelToRoute( $model, $relationship, $indexRoute )
    {
        if ( $relationship && $model->exists )
        {
            $parent = $model->$relationship;
        }
        elseif ( $model && sizeof(Input::all()) > 0 )
        {
            $parent = $this->establishParentFromInput($this->getPossibleInputValuesAsParents($model));
        }
        else
        {
            $parent = null;
        }

        return [
            $indexRoute,
            $parent
        ];
    }

    /**
     * @param $model
     *
     * @return array
     */
    protected function getPossibleInputValuesAsParents( $model )
    {
        return array_filter(Input::all(), function ( $value, $key ) use ( $model )
        {
            $foreignKeys = $this->filterPotentialForeignKeys($model);

            array_walk($foreignKeys, function ( &$value )
            {
                $value = str_replace('_id', '', $value);
            });

            return in_array($key, $foreignKeys) || in_array(str_singular($key), $foreignKeys);

        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param $possibleInputParents
     *
     * @return mixed
     */
    protected function establishParentFromInput( $possibleInputParents )
    {
        if ( sizeof($possibleInputParents) == 1 )
        {
            $key = str_singular(head(array_keys($possibleInputParents)));

            return app(studly_case($key))->find(Input::get($key));
        }

        return null;
    }
}