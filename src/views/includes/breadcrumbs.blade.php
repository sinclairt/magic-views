<ol class="breadcrumb">
    <?php $i = 1; ?>
    @foreach($breadcrumbs as $display => $routeName)
        @if($i == count($breadcrumbs))
            <li class="active">{{ trans($display) }}</li>
        @else
            <li><a href="{{ route($routeName) }}">{{ trans($display) }}</a></li>
        @endif
        <?php $i++ ?>
    @endforeach
</ol>