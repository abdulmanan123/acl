<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'nature-of-ownerships.store']) !!}
            @include ('nature-of-ownerships.form')
        {!! Form::close() !!}
    </div>
</section>
