<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'tehsils.store']) !!}
            @include ('tehsils.form')
        {!! Form::close() !!}
    </div>
</section>
