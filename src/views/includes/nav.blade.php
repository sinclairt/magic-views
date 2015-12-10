<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ config('magic-views.project.image') }}">{{ config('magic-views.project.name')}}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
            <ul class="nav navbar-nav navbar-right">
                @foreach(config('magic-views.nav-links') as $display => $routeName)
                    <li><a href="{{ route($routeName) }}">{{ trans('magic-views::magic-views.' . $display) }}</a> </li>
                @endforeach
                @if(Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                @endif
            </ul>
        </div>
    </div>
</nav>