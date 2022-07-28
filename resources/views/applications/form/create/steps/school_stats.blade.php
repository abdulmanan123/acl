<div id="step-6" class="">
    <div class="row mt-5">
        <h1>School Stats</h1>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Is Affiliated? </label>
                <select class="form-select" name='affiliation' aria-label="Default select example">
                    <option value="">Select Is Affiliated?</option>
                    <option value="yes" {{(request('affiliation') == 'yes') ? 'selected' : ''}}>Yes</option>
                    <option value="no" {{(request('affiliation') == 'no') ? 'selected' : ''}}>No</option>
                </select>
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3 affiliated">
            <div class="form-group">
                <label class="form-label required-input">Affiliated University Name </label>
                <input type="text" name="affiliated_university_name" value="{{request('affiliated_university_name')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Total Male Teachers </label>
                <input type="number" name="total_male_teachers" value="{{request('total_male_teachers')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Total Female Teachers </label>
                <input type="number" name="total_female_teachers" value="{{request('total_female_teachers')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Total Classrooms </label>
                <input type="number" name="total_classrooms" value="{{request('total_classrooms')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Total Rooms (other than classrooms) </label>
                <input type="number" name="total_rooms_other_than_classrooms" value="{{request('total_rooms_other_than_classrooms')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Building Area Type </label>
                <select class="form-select load_options select2" data-url="{{route('area-types.getDropDownOptions')}}" data-selectedid="{{request('area_type_id')}}" name="area_type_id" aria-label="Default select example">
                    <option value="">Select Building Area Type</option>
                </select>
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Total Area </label>
                <input type="number" name="area_value" value="{{request('area_value')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Has Library? </label>
                <select class="form-select" name='has_library' aria-label="Default select example">
                    <option value="">Select Has Library?</option>
                    <option value="yes" {{(request('has_library') == 'yes') ? 'selected' : ''}}>Yes</option>
                    <option value="no" {{(request('has_library') == 'no') ? 'selected' : ''}}>No</option>
                </select>
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3 has_library">
            <div class="form-group">
                <label class="form-label required-input">Total Books </label>
                <input type="number" name="total_books" value="{{request('total_books')}}" class="form-control" min="0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="clearfix"><hr /></div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('lab_id', 'Labs', ['class' => 'form-label required-input']) !!}
                {!! Form::select('lab_id[]', $labs, null, ['class' => 'form-select select2', 'multiple', 'data-url' => route('districts.getDropDownOptions'), 'data-selectedid' => request('district_id')]) !!}
                {!! $errors->first('lab_id', '<p class="text-danger">:message</p>') !!}
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class='col-md-12'>
            <button type='submit' class="btn btn-success float-end">Submit</button>
        </div>
    </div>
</div>