<section class="dashboard">
    <div class="container">
        {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.permissions',  $role->uuid]]) !!}
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-sm-6">
                        <div class="form-check form-switch">
                            {!! Form::checkbox("permissions[]", $permission->name, $role->hasPermissionTo($permission->name), ["class" => "form-check-input", "id" => "cb-".$permission->id]) !!}
                            <label class="form-check-label" for="cb-{{ $permission->id }}">{{ ucwords($permission->name) }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        {!! Form::close() !!}
    </div>
</section>
