<x-app-layout>

    <link href="{{ asset('css/smart_wizard.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/smart_wizard_theme_arrows.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>

    <section class="dashboard">
        <div class="container">



            {!! Form::open(['route' => 'applications.store', 'enctype' => 'multipart/form-data', 'id' => 'applicationForm']) !!}
            <div id="smartwizard">
                <div class="form-steps">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @include('applications.form')
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

    <script type="text/javascript" src="{{ asset('js/jquery.smartWizard.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>

    <script type='text/javascript'>


function loadNewStatRow($url, $section) {
    loadingOverlay($('.' + $section + ' .load_row'));
    $.ajax({
        type: "GET",
        url: $url,
        data: {},
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            $('.' + $section + ' .list').append(data.stat_row);
            stopOverlay($('.' + $section + ' .load_row'));
        }
    });
}

function loadDropdown(el, show = false) {
    $url = el.attr('data-url');
    $ddName = el.attr('name');
    $selected = el.attr('data-selectedid');
    $otherIdName = (el.attr('data-otheridname')) ? el.attr('data-otheridname') : '';
    $otherIdValue = (el.attr('data-otheridvalue')) ? el.attr('data-otheridvalue') : '';

    $id = $selected;
    $ddName = $ddName;

    let _self = $('#select2-' + $ddName + '-container');
    loadingOverlay(_self, show);
    $.ajax({
        type: "POST",
        url: $url,
        data: {
            'id': $id,
            'ddName': $ddName,
            'district_id': $otherIdValue
        },
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            stopOverlay(_self, show);
            $('select[name=' + data.request.ddName + ']').html(data.options);
        },
        error: function (data, textStatus, jqXHR) {
            stopOverlay(_self, show);
            //process error msg
        },
    });
}

$(document).ready(function () {

    $('#applicationForm').on('submit', function (e) {
        e.preventDefault();
        let _form = $(this);
        let formData = _form.serializeFiles();
        loadingOverlay(_form);
        $('.form-group .text-danger').text('');
        $('.form-control').removeClass('is-invalid');
        $.ajax({
            type: _form.attr('method'),
            url: _form.attr('action'),
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            success:function (res) {
                successMessage(res.message);
                stopOverlay(_form);
                setTimeout(function(){
                    window.location = route('applications.index');
               }, 3000);
            },
            error: function (request, status, error) {
                stopOverlay(_form);
                showAjaxErrorMessage(request, true);
            }
        });
    });

    $(".select2").select2({
        allowClear: true
    });

    $('a.load_row').click(function () {
        loadNewStatRow($(this).attr('data-url'), $(this).attr('data-section'));
    });

    $(document).on('click', '.removeRow', function() {
        $(this).parents('.list-row').remove();
    });

    $('#principal_cnic').mask('00000-0000000-0');

    /*$('#smartwizard').smartWizard({
        selected: 0,
        theme: 'arrows',
        autoAdjustHeight: true,
        transitionEffect: 'fade',
        showStepURLhash: false,

    });*/

    $('select.load_options').each(function (i) {
        loadDropdown($(this));
    });
});
    </script>
</x-app-layout>
