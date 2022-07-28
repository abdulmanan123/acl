<section class="dashboard">
    <div class="container">
        {!! Form::model($district, [
            'method' => 'PATCH',
            'route' => ['districts.update', $district->uuid],
            ]) !!}

            @include ('districts.form')

        {!! Form::close() !!}
    </div>
</section>
