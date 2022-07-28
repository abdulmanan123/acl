<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'roles.store']) !!}
            @include ('roles.form')
        {!! Form::close() !!}
    </div>
</section>
