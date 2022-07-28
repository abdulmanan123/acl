<section class="dashboard">
    <div class="container">
        {!! Form::model($applicationType, [
            'method' => 'PATCH',
            'route' => ['application-types.update', $applicationType->uuid],
            ]) !!}

            @include ('application-types.form')

        {!! Form::close() !!}
    </div>
</section>
