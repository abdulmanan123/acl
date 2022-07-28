<section class="dashboard">
    <div class="container">
        {!! Form::model($user, [
            'method' => 'PATCH',
            'route' => ['users.update', $user->uuid],
            ]) !!}

            @include ('users.form')

        {!! Form::close() !!}
    </div>
</section>
