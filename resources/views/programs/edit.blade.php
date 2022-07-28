<section class="dashboard">
    <div class="container">
        {!! Form::model($program, [
            'method' => 'PATCH',
            'route' => ['programs.update', $program->uuid],
            ]) !!}

            @include ('programs.form')

        {!! Form::close() !!}
    </div>
</section>
