<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('name', 'Role Name', ['class' => 'form-label required-input']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>
        </div>
        <div class="form-group">
            {!! Form::label('route', 'Route Name', ['class' => 'form-label required-input']) !!}
            {!! Form::text('route', null, ['class' => 'form-control', 'placeholder' => 'Route Name']) !!}
            {!! $errors->first('route', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>
        </div>
    </div>
</div>