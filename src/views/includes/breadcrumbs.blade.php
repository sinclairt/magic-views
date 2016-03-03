<ol class="breadcrumb">
    <?php $i = 1; ?>
    @foreach($breadcrumbs as $display => $routeName)
        @if($i == count($breadcrumbs))
            <li class="active">{{ get_trans('magic-views::magic-views.' . $display) }}</li>
        @else
            @if(is_array($routeName))
                <li>
                    <a href="{{ route($routeName[0], $routeName[1]) }}">{{ get_trans('magic-views::magic-views.' . $display) }}</a>
                </li>
            @else
                <li><a href="{{ route($routeName) }}">{{ get_trans('magic-views::magic-views.' . $display) }}</a></li>
            @endif
        @endif
        <?php $i++ ?>
    @endforeach
</ol>