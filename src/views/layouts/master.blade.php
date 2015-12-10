<!DOCTYPE html>
<html lang="en">
<head>
    @include(config('magic-views.head'))

    @yield('head')
</head>
<body>
@include(config('magic-views.nav'))
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @include(config('magic-views.breadcrumbs'))
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @include(config('magic-views.page-title'))
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include(config('magic-views.foot'))
@yield('foot')
</body>
</html>