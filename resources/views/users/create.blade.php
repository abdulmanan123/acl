<x-app-layout>

    <section class="dashboard">
        <div class="container">
            {!! Form::open(['route' => 'permissions.store']) !!}
                @include ('permissions.form')
            {!! Form::close() !!}
        </div>
    </section>
</x-app-layout>
