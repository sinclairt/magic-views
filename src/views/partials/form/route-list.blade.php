<?php

$field = !isset($field) ? 'route_name' : $field;
$before = !isset($before) ? [] : $before;
$options = [];

foreach(Route::getRoutes() as $route)
	if($route->getName())
		$options[] = $route->getName();


${$field.'Options'} = $before + $options;

?>

@include('magic-views::partials.form.select',['useKeys'=>false])
