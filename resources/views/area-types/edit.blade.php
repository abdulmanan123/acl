<section class="dashboard">
    <div class="container">
        {!! Form::model($areaType, [
            'method' => 'PATCH',
            'route' => ['area-types.update', $areaType->uuid],
            ]) !!}

            @include ('area-types.form')

        {!! Form::close() !!}
    </div>
</section>
