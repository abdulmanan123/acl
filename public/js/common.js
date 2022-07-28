let _$ = $(document);

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});  

_$.ajaxError(function (event, jqxhr, settings, thrownError) {
   if (jqxhr.status === 401) {
      document.location.href = route('login');
   }
});

_$.ready(function(){ 
    $('[data-toggle="tooltip"]').tooltip();
//    $(".select2").select2({
//        placeholder: "Select Option",
//        allowClear: true
//    });    
    
    $('#datatable').on('click', '.btn-delete', function (e) 
    { 
        e.preventDefault();  
        $datatable = $(this).parents('.datatable');        
        var url= $(this).attr('href');

        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure! You want remove this record',
            type: 'red',
            typeAnimated: true,
            closeIcon: true,
            buttons: {
                confirm: function () {
                    $datatable.find("tbody").LoadingOverlay("show");
                    $.ajax({
                        type: "delete",
                        url: url,
                        dataType: "json",
                        complete:function (res) {
                            $datatable.find("tbody").LoadingOverlay("hide");
                            var result = JSON.parse(res.responseText);
                            //var result = j.result;
                            if(res.status == 200){
                                reloadDatatable($datatable);
                                successMessage(result.message);
                            }else{
                                errorMessage(result.message);
                            }
                        },
                          error: function (request, status, error) {
                              $datatable.find("tbody").LoadingOverlay("hide");                     
                              var result = request.responseJSON.result;
                              var err = JSON.parse(request.responseText);
                              if(status == 401){
                                errorMessage(result.message);                  
                            }else{
                                errorMessage(err.message);
                            }                    
                          } 
                    });                                                                         
                },
                cancel: function () { },
            }
        });

        return false;
    });    
    
});

/**
 * Create Ajax Datatables
 * @param url
 * @param columns
 * @param index_field
 * @param ordering
 * @param pageLength
 * @param permitOrder
 */
function create_datatables (url, columns, index_field = true, ordering = [], pageLength=10, permitOrder = true)
{
    let datatable_id = 'datatable';
    if (index_field) {
        $('#'+datatable_id+' thead tr').prepend("<th>#</th>");
        $('#'+datatable_id+' tfoot tr').prepend("<th>#</th>");

        columns.unshift({name:'index', data: 'index', width: '2%', className: 'text-center', orderable: false, searchable: false});
    }

    var t = $('#'+datatable_id).DataTable({
        oLanguage: { sProcessing: '<img src="'+ Ziggy.url +'/images/bx_loader.gif">' },
        processing: true,
        serverSide: true,
        ordering: permitOrder,
        responsive: true,
        pageLength: pageLength,
        ajax: {
            url: url,
            type:'POST',
        },
        columns: columns,
        order: ordering,
        drawCallback: function ( settings ) {
            var api = this.api();

            if (index_field) {
                api.column(0).nodes().each(function (cell, i) {
                    var index = (i+1) + (t.page.info().page * t.page.info().length);
                    cell.innerHTML = index;
                });
            }
        }
    });

}

/**
 * Show Ajax Error Message
 * @param response
 */
function showAjaxErrorMessage(response, form = false)
{
    let responseJson = JSON.parse(response.responseText);
    let errors = responseJson.errors;
    
    if (form) {
        if (errors !== undefined) {
            Object.keys(errors).forEach(function (item) {
                for (let value of errors[item]) {                    
                    $('[name=' + item + ']').parent('.form-group').find(".text-danger").text(value);
                    $('[name=' + item + ']').addClass('is-invalid');
                }
            });
        }
    } 
    if (errors !== undefined) {
        Object.keys(errors).forEach(function (item) {
            for (let value of errors[item]) {
                errorMessage(value);
            }
        });
    } else if (responseJson.message !== undefined) {
        errorMessage(responseJson.message);
    }
    
}

/**
 * Loading overlay js
 * @param _ele
 */
let loadingOverlay = (_ele, show = true) => {
    if (show) {
        _ele.LoadingOverlay('show');
    }    
}

/**
 * Stopping overlay js
 * @param _ele
 */
let stopOverlay = (_ele, hide = true) => {
    if (hide) {
        _ele.LoadingOverlay('hide');
    }
}

$.fn.serializeFiles = function () {
    let form = $(this),
        formData = new FormData(),
        formParams = form.serializeArray();

    $.each(form.find('input[type="file"]'), function (i, tag) {
        $.each($(tag)[0].files, function (i, file) {
            formData.append(tag.name, file);
        });
    });

    $.each(formParams, function (i, val) {
        formData.append(val.name, val.value);
    });

    return formData;
};

/**
 * Reload Datatable
 * @param _ele
 */
function reloadDatatable (tableId = '#datatable') {
    let _datatable = $(tableId);
    let reloadDatatable = _datatable.dataTable({ bRetrieve : true });
    if(reloadDatatable != ""){
        reloadDatatable.fnDraw(); 
    }
}

/**
 * Generate Random Number
 * @param length
 */
function generateRandomNumber (length) {
    if(!length) { length = 16; }
    //var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var chars = "1234567890";
    var result="";

    for (var i = length; i > 0; --i)
        result += chars[Math.round(Math.random() * (chars.length - 1))]
    return result
}

_$.ready(function(){               
    $('.tooltips').tooltip();
    $('[data-toggle="tooltip"]').tooltip();
});

 
function getExportButtons(title="")
{
 return  [{
        text: '<span data-toggle="tooltip" title="Export CSV"><i class="fa fa-lg fa-file-text-o"></i> CSV</span>',
        extend: 'csv',
        className: 'btn btn-sm btn-round btn-success',
        title: title,
        extension: '.csv'
    },{
        text: '<span data-toggle="tooltip" title="Export PDF"><i class="fa fa-lg fa-file-pdf-o"></i> PDF</span>',
        extend: 'pdf',
        className: 'btn btn-sm btn-round btn-danger',
        title: title,
        extension: '.pdf',
        orientation: 'landscape'
    },{
        text: '<span data-toggle="tooltip" title="Print"><i class="fa fa-lg fa-print"></i> Print</span>',
        extend: 'print',
        className: 'btn btn-sm btn-round btn-info',
    }];
} 

/**
 * Show Success Message
 * @param message
 * @param title
 */
function successMessage(message, title)
{
    if (!title) title = "Success!";
    toastr.remove();
    toastr.success(message, title, {
        closeButton: true,
        timeOut: 4000,
        progressBar: true,
        newestOnTop: true
    }); 
}

/**
 * Show Error Message
 * @param message
 * @param title
 */
function errorMessage(message, title)
{
    if (!title) title = "Error!";
    toastr.remove();
    toastr.error(message, title, {
        closeButton: true,
        timeOut: 4000,
        progressBar: true,
        newestOnTop: true
    }); 
}




