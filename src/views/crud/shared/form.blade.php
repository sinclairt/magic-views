<form class="form-horizontal" action="{{ route($action) }}">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle or '' }}</h3>
        </div>

        <div class="panel-body">
            {{ csrf_field() }}

            @if($blade == 'edit')
                <input type="hidden" name="_method" value="put">
            @endif

            @foreach($fields as $field => $type)
                @include('magic-views::partials.form.' . $type, compact('field'))
            @endforeach

        </div>

        <div class="panel-footer">
            @include('magic-views::partials.form.submit')
        </div>

    </div>
</form>