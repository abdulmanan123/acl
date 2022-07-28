<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'programs.store']) !!}
            @include ('programs.form')
        {!! Form::close() !!}
    </div>
</section>
