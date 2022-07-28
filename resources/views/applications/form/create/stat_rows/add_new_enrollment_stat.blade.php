<div class="list-row d-flex">
    <div class="col-md-3">
        <div class="form-group">
            <input type='hidden' value='' name='application_enrollment_id'>
            <label class="form-label">Program <span class="required">*</span></label>
            <select class="form-select" name="enrollment[program_id][]" aria-label="Default select example">
                <option>Select Program</option>
                @foreach($programs as $row)
                <option value='{{$row->id}}'>{{$row->name}}</option>
                @endforeach
            </select>
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-3 ml-1">
        <div class="form-group">
            <label class="form-label">Total Male Students <span class="required">*</span></label>
            <input type="number" name="enrollment[male_students][]" value="" class="form-control" placeholder="">
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-3 ml-1">
        <div class="form-group">
            <label class="form-label">Total Female Students <span class="required">*</span></label>
            <input type="number" name="enrollment[female_students][]" value="" class="form-control" placeholder="">
            <div class="text-danger with-errors"></div>
        </div>
    </div>
    <div class="col-md-2 ml-1">
        <button type="button" class="btn btn-danger removeRow" style="margin: 30px 0px 0px 10px;">X</button>
    </div>
</div>