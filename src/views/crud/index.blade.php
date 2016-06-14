@extends(config('magic-views.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle }}</h3>
        </div>
        <div class="panel-body">
            @if(sizeof($rows) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            @foreach($columns as $column)
                                <th>{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $column) }}</th>
                            @endforeach
                            @if(isset($customOptions) || $buttons != [])
                                <th>{{ get_trans('magic-views::magic-views.options') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                @foreach($columns as $column)
                                    <td>
                                        @include('magic-views::partials.presentValue')
                                        @include('magic-views::partials.deleted_badge')
                                    </td>
                                @endforeach
                                @if(isset($customOptions) || $buttons != [])
                                    <td>
                                        @if(isset($customOptions))
                                            @include($customOptions)
                                        @else
                                            @include('magic-views::partials.table.options')
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info">There are no {{ str_plural(get_trans('magic-views::magic-views.' . $modelName)) }}.</p>
            @endif
        </div>
        <div class="panel-footer">
            <div class="pull-left">
                {!! $rows->render() !!}
            </div>
            <div class="pull-right">
                @if(isset($new))
                    @if($new)
                        <a href="{{ route($modelName . '.create', $newParams) }}" class="btn btn-primary">{{ get_trans('magic-views::magic-views.new') }}</a>
                    @endif
                @else
                    <a href="{{ route($modelName . '.create', $newParams) }}" class="btn btn-primary">{{ get_trans('magic-views::magic-views.new') }}</a>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop