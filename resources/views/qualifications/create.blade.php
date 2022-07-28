<section class="dashboard">
    <div class="container">
        {!! Form::open(['route' => 'qualifications.store']) !!}
            @include ('qualifications.form')
        {!! Form::close() !!}
    </div>
</section>
