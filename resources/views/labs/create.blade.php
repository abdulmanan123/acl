<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'labs.store']) !!}
            @include ('labs.form')
        {!! Form::close() !!}
    </div>
</section>
