<section class="dashboard">
    <div class="container">
        {!! Form::model($gender, [
            'method' => 'PATCH',
            'route' => ['genders.update', $gender->uuid],
            ]) !!}

            @include ('genders.form')

        {!! Form::close() !!}
    </div>
</section>
