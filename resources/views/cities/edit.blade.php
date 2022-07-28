<section class="dashboard">
    <div class="container">
        {!! Form::model($city, [
            'method' => 'PATCH',
            'route' => ['cities.update', $city->uuid],
            ]) !!}

            @include ('cities.form')

        {!! Form::close() !!}
    </div>
</section>
