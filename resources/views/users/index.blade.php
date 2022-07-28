<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Users') || auth()->user()->can('Delete Users'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Users</h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['Name', 'Email', 'Role']" />
                </div>
            </div>
        </div>
    </section>

    @include('modals.form')

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('users.ajax');
            var datatable_columns = [
                {data: 'name'},
                {data: 'email'},
                {data: 'role'},
                @if($action)
                {data: 'action', width: '10%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url,datatable_columns);
          });
        </script>
    @endpush
</x-app-layout>
