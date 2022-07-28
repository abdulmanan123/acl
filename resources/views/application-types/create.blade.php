<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'application-types.store']) !!}
            @include ('application-types.form')
        {!! Form::close() !!}
    </div>
</section>
