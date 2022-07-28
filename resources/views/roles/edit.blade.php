<section class="dashboard">
    <div class="container">
        {!! Form::model($role, [
            'method' => 'PATCH',
            'route' => ['roles.update', $role->uuid],
            ]) !!}

            @include ('roles.form')

        {!! Form::close() !!}
    </div>
</section>
