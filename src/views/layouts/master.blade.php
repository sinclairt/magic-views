<!DOCTYPE html>
<html lang="en">
<head>
    @include('magic-views::includes.head')
    @if(config('magic-views::magic-views.head') != null)
        @include(config('magic-views::magic-views.head'))
    @endif
    @yield('head')
</head>
<body>
@include('magic-views::includes.nav')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @include('magic-views::includes.breadcrumbs')
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @include('magic-views::includes.page-title')
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
@include('magic-views::includes.foot')
@if(config('magic-views::magic-views.foot') != null)
    @include(config('magic-views::magic-views.foot'))
@endif
@yield('foot')
</body>
</html>