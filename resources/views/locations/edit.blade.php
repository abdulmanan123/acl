<section class="dashboard">
    <div class="container">
        {!! Form::model($location, [
            'method' => 'PATCH',
            'route' => ['locations.update', $location->uuid],
            ]) !!}

            @include ('locations.form')

        {!! Form::close() !!}
    </div>
</section>
