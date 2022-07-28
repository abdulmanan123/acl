<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Districts') || auth()->user()->can('Delete Districts'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Districts
                @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Districts'))
                    <a class="btn btn-primary float-end p-form" href="{{ route('districts.create') }}">Create District</a>
                @endif
            </h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['Name', 'CRM ID', 'Latitude', 'Longitude']" />
                </div>
            </div>
        </div>
    </section>

    @include('modals.form')

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('districts.ajax');
            var datatable_columns = [
                {data: 'name'},
                {data: 'crm_id'},
                {data: 'center_lat'},
                {data: 'center_lng'},
                @if($action)
                {data: 'action', width: '10%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url,datatable_columns);
          });
        </script>
    @endpush

</x-app-layout>
