<section class="dashboard">
    <div class="container">
        {!! Form::model($shift, [
            'method' => 'PATCH',
            'route' => ['shifts.update', $shift->uuid],
            ]) !!}

            @include ('shifts.form')

        {!! Form::close() !!}
    </div>
</section>
