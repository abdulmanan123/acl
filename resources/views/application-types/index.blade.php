<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Application Types') || auth()->user()->can('Delete Application Types'))?true:false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Application Types
                @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Application Types'))
                    <a class="btn btn-primary float-end p-form" href="{{ route('application-types.create') }}">Create Application Type</a>
                @endif
            </h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['Name']" />
                </div>
            </div>
        </div>
    </section>

    @include('modals.form')

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('application-types.ajax');
            var datatable_columns = [
                {data: 'name'},
                @if($action)
                {data: 'action', width: '10%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url,datatable_columns);
          });
        </script>
    @endpush

</x-app-layout>
