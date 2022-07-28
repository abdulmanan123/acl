<section class="dashboard">
    <div class="container">
        {!! Form::model($permission, [
            'method' => 'PATCH',
            'route' => ['permissions.update', $permission->uuid],
            ]) !!}

            @include ('permissions.form')

        {!! Form::close() !!}
    </div>
</section>
