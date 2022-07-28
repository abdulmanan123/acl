
@push('styles')
<!--DataTables Sytles-->
<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<!--DataTables Scripts-->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $.fn.dataTable.ext.errMode = 'none';
</script>
@endpush