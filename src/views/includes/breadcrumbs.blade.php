<ol class="breadcrumb">
    <?php $i = 1; ?>
    @foreach($breadcrumbs as $display => $routeName)
        @if($i == count($breadcrumbs))
            <li class="active">{{ trans('magic-views::magic-views.' . $display) }}</li>
        @else
            <li><a href="{{ route($routeName) }}">{{ trans('magic-views::magic-views.' . $display) }}</a></li>
        @endif
        <?php $i++ ?>
    @endforeach
</ol>