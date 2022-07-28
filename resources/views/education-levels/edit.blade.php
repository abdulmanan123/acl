<section class="dashboard">
    <div class="container">
        {!! Form::model($educationLevel, [
            'method' => 'PATCH',
            'route' => ['education-levels.update', $educationLevel->uuid],
            ]) !!}

            @include ('education-levels.form')

        {!! Form::close() !!}
    </div>
</section>
