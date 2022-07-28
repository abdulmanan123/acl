<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'form-label required-input']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            <div class="text-danger with-errors"></div>

        </div>
    </div>
</div>