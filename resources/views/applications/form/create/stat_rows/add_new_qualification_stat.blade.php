<div class="list-row d-flex">
    <div class="col-md-3">
        <div class="form-group">
            <input type='hidden' value='' name='application_teacher_id'>
            <label class="form-label">Qualification <span class="required">*</span></label>
            <select class="form-select" name="qualification[qualification_id][]" aria-label="Default select example">
                <option>Select Qualification</option>
                @foreach($qualifications as $row)
                <option value='{{$row->id}}'>{{$row->name}}</option>
                @endforeach
            </select>
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-3 ml-1">
        <div class="form-group">
            <label class="form-label">Total Male Teachers <span class="required">*</span></label>
            <input type="number" name="qualification[male_count][]" value="" class="form-control" placeholder="">
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-3 ml-1">
        <div class="form-group">
            <label class="form-label">Total Female Teachers <span class="required">*</span></label>
            <input type="number" name="qualification[female_count][]" value="" class="form-control" placeholder="">
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-2 ml-1">
        <button type="button" class="btn btn-danger removeRow" style="margin: 30px 0px 0px 10px;">X</button>
    </div>
</div>
</div>