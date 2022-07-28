<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'education-levels.store']) !!}
            @include ('education-levels.form')
        {!! Form::close() !!}
    </div>
</section>
