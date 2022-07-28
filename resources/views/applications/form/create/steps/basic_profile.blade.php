<div id="step-1">
    <div class="row">
        <h1>Basic Profile</h1>
        <div class="col-md-4">
            <input type='hidden' name='id' value='' >
            <div class="form-group">
                {!! Form::label('application_type_id', 'Application Type', ['class' => 'form-label required-input']) !!}
                {!! Form::select('application_type_id', ['' => 'Select Application Type'], null, ['class' => 'form-select load_options select2', 'data-url' => route('application_types.getDropDownOptions'), 'data-selectedid' => request('application_type_id')]) !!}
                {!! $errors->first('application_type_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('college_name', 'College Name', ['class' => 'form-label required-input']) !!}
                {!! Form::text('college_name', null, ['class' => 'form-control', 'placeholder' => 'College Name']) !!}
                {!! $errors->first('college_name', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('district_id', 'District', ['class' => 'form-label required-input']) !!}
                {!! Form::select('district_id', ['' => 'Select District'], null, ['class' => 'form-select load_options select2', 'data-url' => route('districts.getDropDownOptions'), 'data-selectedid' => request('district_id')]) !!}
                {!! $errors->first('district_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('tehsil_id', 'Tehsil', ['class' => 'form-label required-input']) !!}
                {!! Form::select('tehsil_id', ['' => 'Select Tehsil'], null, ['class' => 'form-select load_options select2', 'data-url' => route('tehsils.getDropDownOptions'), 'data-selectedid' => request('tehsil_id')]) !!}
                {!! $errors->first('tehsil_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('city_id', 'City', ['class' => 'form-label required-input']) !!}
                {!! Form::select('city_id', ['' => 'Select City'], null, ['class' => 'form-select load_options select2', 'data-url' => route('cities.getDropDownOptions'), 'data-selectedid' => request('city_id')]) !!}
                {!! $errors->first('city_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('uc_no', 'UC No', ['class' => 'form-label']) !!}
                {!! Form::number('uc_no', null, ['class' => 'form-control', 'placeholder' => 'UC No', 'min' => '0', 'step' => '1']) !!}
                {!! $errors->first('uc_no', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('na_no', 'NA No', ['class' => 'form-label']) !!}
                {!! Form::number('na_no', null, ['class' => 'form-control', 'placeholder' => 'NA No', 'min' => '0', 'step' => '1']) !!}
                {!! $errors->first('na_no', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('pp_no', 'PP No', ['class' => 'form-label']) !!}
                {!! Form::number('pp_no', null, ['class' => 'form-control', 'placeholder' => 'PP No', 'min' => '0', 'step' => '1']) !!}
                {!! $errors->first('pp_no', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('education_level_id', 'Institute Level', ['class' => 'form-label required-input']) !!}
                {!! Form::select('education_level_id', ['' => 'Select Institute Level'], null, ['class' => 'form-select load_options select2', 'data-url' => route('education-levels.getDropDownOptions'), 'data-selectedid' => request('education_level_id')]) !!}
                {!! $errors->first('education_level_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('gender_id', 'Gender', ['class' => 'form-label required-input']) !!}
                {!! Form::select('gender_id', ['' => 'Select Gender'], null, ['class' => 'form-select load_options select2', 'data-url' => route('genders.getDropDownOptions'), 'data-selectedid' => request('gender_id')]) !!}
                {!! $errors->first('gender_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('location_id', 'Location Type', ['class' => 'form-label required-input']) !!}
                {!! Form::select('location_id', ['' => 'Select Location Type'], null, ['class' => 'form-select load_options select2', 'data-url' => route('locations.getDropDownOptions'), 'data-selectedid' => request('location_id')]) !!}
                {!! $errors->first('location_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('gender_registered_id', 'Registered Gender', ['class' => 'form-label required-input']) !!}
                {!! Form::select('gender_registered_id', ['' => 'Select Gender'], null, ['class' => 'form-select load_options select2', 'data-url' => route('genders.getDropDownOptions'), 'data-selectedid' => request('gender_registered_id')]) !!}
                {!! $errors->first('gender_registered_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('shift_id', 'Shift', ['class' => 'form-label required-input']) !!}
                {!! Form::select('shift_id', ['' => 'Select Shift'], null, ['class' => 'form-select load_options select2', 'data-url' => route('shifts.getDropDownOptions'), 'data-selectedid' => request('shift_id')]) !!}
                {!! $errors->first('shift_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-8">
            <div class="form-group">
                <label class="form-label required-input">College Address</label>
                <textarea name="college_address" class="form-control">{{request('college_address')}}</textarea>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('select[name=district_id]').change(function () {
            $('select[name=tehsil_id]').attr('data-otheridvalue', $(this).val());
            loadDropdown($('select[name=tehsil_id]'), true);
            $('select[name=city_id]').attr('data-otheridvalue', $(this).val());
            loadDropdown($('select[name=city_id]'), true);
        });
    });
</script>