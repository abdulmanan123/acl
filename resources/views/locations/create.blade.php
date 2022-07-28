<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'locations.store']) !!}
            @include ('locations.form')
        {!! Form::close() !!}
    </div>
</section>
