
_$.ready(function () {
    console.log('Form is running...');
    
    /**
    * Show create/edit form 
    */
    _$.on('click', '.p-form', function (e) {
        e.preventDefault();
        let _self = $(this);
        let _url = _self.attr('href');
        let _editMode = _self.attr('data-edit');
        let _modal = $('.p-modal');
        let _submitBtn = _modal.find(".modal-btn");
        resetModal(_modal);    
        _submitBtn.text('Create');
        if (_editMode === 'true') {
            _submitBtn.text('Update');
        }
        
        $.ajax({
            type: "get",
            url: _url,
            success:function (res) {
                _modal.modal('show');
                _modal.find(".modal-title").html(res.title);
                _modal.find(".modal-body").html(res.html);                
            },
            error: function (request, status, error) {
                showAjaxErrorMessage(request);                   
            } 
        }); 
    });
    
    /**
    * Submit modal form
    */
    _$.on('click', '.p-modal .modal-btn', function (e) {
        e.preventDefault();
        let _self = $(this);
        let _modal = $('.p-modal');
        let _form = _modal.find('form');
        let formData = _form.serializeFiles();
        blockUI();
        
        $.ajax({
            type: _form.attr('method'),
            url: _form.attr('action'),
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            success:function (res) {
                successMessage(res.message);
                resetModal(_modal);
                _modal.modal('hide');
                reloadDatatable();       
            },
            error: function (request, status, error) {
                showAjaxErrorMessage(request);                   
            },
            complete:function (res) {
                unblockUI();
            }
        }); 
    });
    
    /**
    * Disable form submit on enter key
    */
    _$.on('keypress', '.p-modal form', function (e) {        
        if (e.which == 13) {
            $(".p-modal").find(".modal-btn").click();
        }       
    });
});

/**
 * Refresh Modal
 * @param _modal
 */
function resetModal (_modal) {
    _modal.find(".modal-title").html('');
    _modal.find(".modal-body").html('...');  
    _modal.find(".modal-btn").text('');
    let _form = _modal.find("form");
    if (_form[0] != undefined) {
        _form[0].reset();
    }    
}

/**
 * Block Modal UI
 */
function blockUI () {
    let _modal = $('.p-modal');
    let _submitBtn = _modal.find(".modal-btn");
    _modal.find(".btn-close").prop('disabled', true);
    _modal.find(".btn-secondary").prop('disabled', true);
    loadingOverlay(_submitBtn);
}

/**
 * Unblock Modal UI
 */
function unblockUI () {
    let _modal = $('.p-modal');
    let _submitBtn = _modal.find(".modal-btn");
    _modal.find(".btn-close").prop('disabled', false);
    _modal.find(".btn-secondary").prop('disabled', false);
    stopOverlay(_submitBtn);
}