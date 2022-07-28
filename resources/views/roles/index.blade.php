<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Roles') || auth()->user()->can('Delete Roles'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Roles
                @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Roles'))
                    <a class="btn btn-primary float-end p-form" href="{{ route('roles.create') }}">Create Role</a>
                @endif
            </h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['Role Name']" />
                </div>
            </div>
        </div>
    </section>


    @include('modals.form')

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('roles.ajax');
            var datatable_columns = [
                {data: 'name'},
                @if($action)
                {data: 'action', width: '15%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url, datatable_columns);
          });
        </script>
    @endpush
</x-app-layout>
