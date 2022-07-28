<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'cities.store']) !!}
            @include ('cities.form')
        {!! Form::close() !!}
    </div>
</section>
