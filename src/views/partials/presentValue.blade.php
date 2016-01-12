@if($hasPresenter)

    <?php

    /**
     * there are 3 options to show a value from an object
     * - standard column ie: $row->name
     * - presenter method ie: $row->present->presentName (we don't use $row->present()->name because it gets tangled with the original value!?!??)
     * - a presenter method with a user defined name ie: $row->present()->showFullName (simply define $presenterMethods['name'] = 'showFullName' in your controller)
     */

    $presentMethodName = isset($presenterMethods[$column]) ? $presenterMethods[$column] : 'present' . studly_case($column);
    $presentMethod = method_exists($row->present(),$presentMethodName) ? $presentMethodName : $column;

    $presentResult = $row->present()->$presentMethod;
    ?>

	@if(isView($presentResult))
		{!! $presentResult->render() !!}
	@else
		{{ $presentResult }}
	@endif

@else
    {{ $row->$column }}
@endif