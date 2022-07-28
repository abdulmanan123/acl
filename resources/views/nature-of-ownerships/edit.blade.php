<section class="dashboard">
    <div class="container">
        {!! Form::model($ownership, [
            'method' => 'PATCH',
            'route' => ['nature-of-ownerships.update', $ownership->uuid],
            ]) !!}

            @include ('nature-of-ownerships.form')

        {!! Form::close() !!}
    </div>
</section>
