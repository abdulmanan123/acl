<section class="dashboard">
    <div class="container">
        {!! Form::model($tehsil, [
            'method' => 'PATCH',
            'route' => ['tehsils.update', $tehsil->uuid],
            ]) !!}

            @include ('tehsils.form')

        {!! Form::close() !!}
    </div>
</section>
