<section class="dashboard">
    <div class="container">
        {!! Form::model($lab, [
            'method' => 'PATCH',
            'route' => ['labs.update', $lab->uuid],
            ]) !!}

            @include ('labs.form')

        {!! Form::close() !!}
    </div>
</section>
