@extends(config('magic-views.master'))

@section('content')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle }}</h3>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <tbody>
                    @foreach($columns as $column)
                        <tr>
                            <td>
                                <strong>{{ get_trans('magic-views::magic-views.fields.' . $modelName . '.' . $column) }}</strong>
                            </td>
                            <td>@include('magic-views::partials.presentValue', ['row' => $model])</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@stop