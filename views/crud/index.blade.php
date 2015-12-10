@extends('magic-views::layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle or '' }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    @foreach($columns as $column)
                        <th>{{ trans('magic-views::' . $column) }}</th>
                    @endforeach
                    <th>{{ trans('magic-views::options') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($columns as $column)
                            <td>{{ $row->$column }}</td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td>
                        @include($customOptions or 'magic-views::partials.table.options')
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="pull-left">
                {{ $rows->render() }}
            </div>
            <div class="pull-right">
                <a href="{{ route($class . '.create') }}" class="btn btn-primary">{{ trans('magic-views::new') }}</a>
            </div>
        </div>
    </div>
@stop