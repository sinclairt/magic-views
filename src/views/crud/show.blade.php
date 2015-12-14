@extends(config('magic-views.master'))

@section('content')
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle }}</h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped table-condensed">
                <tbody>
                @foreach($columns as $column)
                    <tr>
                        <td><strong>{{ trans('magic-views::magic-views.fields.' . $modelName . '.' . $column) }}</strong></td>
                        <td>
                            @if(method_exists($model, 'present' . studly_case($column)))
                                {{ $model->{'present' . studly_case($column)} }}
                            @else
                                {{ $model->$column }}
                            @endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop