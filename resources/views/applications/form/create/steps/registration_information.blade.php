<div id="step-3">
    <div class="row mt-5">
        <h1>Registration Information</h1>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Establishment Year</label>
                <input type="number" name="establishment_year" value="{{request('establishment_year')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Registration Status</label>
                <select class="form-select" name='registration_status' aria-label="Default select example">
                    <option value="">Select Registration Status</option>
                    <option value="registered" {{(request('registration_status') == 'registered') ? 'selected' : ''}}>Registered</option>
                    <option value="not-registered" {{(request('registration_status') == 'not-registered') ? 'selected' : ''}}>Not Registered</option>
                </select>
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Registration Date</label>
                <input type="date" name="registration_date" value="{{request('registration_date')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Last Renewal Date</label>
                <input type="date" name="last_renewal_date" value="{{request('last_renewal_date')}}" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label required-input">Last fee Receipt</label>
                <input type="file" name="last_fee_receipt" class="form-control" placeholder="">
                <div class="text-danger with-errors"></div>
            </div>
        </div>
    </div>
</div>