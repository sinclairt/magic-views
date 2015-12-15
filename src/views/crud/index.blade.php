@extends(config('magic-views.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle }}</h3>
        </div>
        <div class="panel-body">
            @if(sizeof($rows) > 0)
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{ trans('magic-views::magic-views.fields.' . $modelName . '.' . $column) }}</th>
                        @endforeach
                        <th>{{ trans('magic-views::magic-views.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            @foreach($columns as $column)
                                <td>@include('magic-views::partials.presentValue')</td>
                            @endforeach
                            <td>
                                @if(isset($customOptions))
                                    @include($customOptions)
                                @else
                                    @include('magic-views::partials.table.options')
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="alert alert-info">There are no {{ str_plural(trans('magic-views::magic-views.' . $modelName)) }}.</p>
            @endif
        </div>
        <div class="panel-footer">
            <div class="pull-left">
                {{ $rows->render() }}
            </div>
            <div class="pull-right">
                <a href="{{ route($modelName . '.create') }}" class="btn btn-primary">{{ trans('magic-views::magic-views.new') }}</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop