<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'shifts.store']) !!}
            @include ('shifts.form')
        {!! Form::close() !!}
    </div>
</section>
