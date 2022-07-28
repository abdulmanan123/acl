<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Tehsils') || auth()->user()->can('Delete Tehsils'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Tehsils
                @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Tehsils'))
                    <a class="btn btn-primary float-end p-form" href="{{ route('tehsils.create') }}">Create Tehsil</a>
                @endif
            </h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['Name', 'District Name', 'CRM ID']" />
                </div>
            </div>
        </div>
    </section>

    @include('modals.form')

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('tehsils.ajax');
            var datatable_columns = [
                {data: 'name'},
                {data: 'district.name'},
                {data: 'crm_id'},
                @if($action)
                {data: 'action', width: '10%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url,datatable_columns);
          });
        </script>
    @endpush

</x-app-layout>
