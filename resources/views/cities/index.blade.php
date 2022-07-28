<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Cities') || auth()->user()->can('Delete Cities'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Cities
                @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Cities'))
                    <a class="btn btn-primary float-end p-form" href="{{ route('cities.create') }}">Create City</a>
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
            var datatable_url = route('cities.ajax');
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
