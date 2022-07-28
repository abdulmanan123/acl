<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'area-types.store']) !!}
            @include ('area-types.form')
        {!! Form::close() !!}
    </div>
</section>
