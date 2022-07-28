
<div id="step-2">
    <div class="row mt-5">
        <h1>Contact Information</h1>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">College Email</label>
                <input type="email" name="college_email" value="{{request('college_email')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">College Phone</label>
                <input type="text" name="college_phone_no" value="{{request('college_phone_no')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Owner Name</label>
                <input type="text" name="owner_name" value="{{request('owner_name')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Owner/Principal/Manager Phone</label>
                <input type="text" name="owner_principal_manager_phone_no" value="{{request('owner_principal_manager_phone_no')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Principal CNIC</label>
                <input type="text" name="principal_cnic" id="principal_cnic" value="{{request('principal_cnic')}}" class="form-control" placeholder="00000-0000000-0">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Nature of Ownership <span class="required">*</span></label>
                <select class="form-select load_options select2" data-url="{{route('nature-of-ownerships.getDropDownOptions')}}" data-selectedid="{{request('nature_of_ownership_id')}}" name="nature_of_ownership_id" aria-label="Default select example">
                    <option>Select Nature of Ownership</option>
                </select>
                <div class="text-danger with-errors"></div>
            </div>
        </div>
    </div>
</div>