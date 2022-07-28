<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'form-label required-input']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Permission Name']) !!}
            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'form-label required-input']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'readonly']) !!}
            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>
        </div>
        <div class="form-group">
            {!! Form::label('role', 'Role', ['class' => 'form-label required-input']) !!}
            {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>
        </div>
    </div>
</div>