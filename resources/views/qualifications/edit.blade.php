<section class="dashboard">
    <div class="container">
        {!! Form::model($qualification, [
            'method' => 'PATCH',
            'route' => ['qualifications.update', $qualification->uuid],
            ]) !!}

            @include ('qualifications.form')

        {!! Form::close() !!}
    </div>
</section>
