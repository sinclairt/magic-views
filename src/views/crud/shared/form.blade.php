<form class="form-horizontal" action="{{ route($action, $model) }}">
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">{{ $panelTitle }}</h3>
        </div>

        <div class="panel-body">
            {{ csrf_field() }}

            @if($blade == 'edit')
                <input type="hidden" name="_method" value="put">
            @endif

            @if(isset($additionalFormContentBefore))
                @include($additionalFormContentBefore)
            @endif

            @foreach($fields as $field => $type)
                @include('magic-views::partials.form.' . $type, compact('field'))
            @endforeach

            @if(isset($additionalFormContentAfter))
                @include($additionalFormContentAfter)
            @endif

        </div>

        <div class="panel-footer">
            @include('magic-views::partials.form.submit')
        </div>

    </div>
</form>