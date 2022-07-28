<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'genders.store']) !!}
            @include ('genders.form')
        {!! Form::close() !!}
    </div>
</section>
