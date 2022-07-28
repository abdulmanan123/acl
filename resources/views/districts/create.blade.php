<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'districts.store']) !!}
            @include ('districts.form')
        {!! Form::close() !!}
    </div>
</section>
