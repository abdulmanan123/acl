<x-app-layout>
    @php
        $action = (auth()->user()->hasrole('Super Admin') || auth()->user()->can('Edit Applications') || auth()->user()->can('Delete Area Types'))?true:false;
        $action = false;
    @endphp
    <section class="listing mt-5">
        <div class="container">
            <h1>Applications
            @if(auth()->user()->hasrole('Super Admin') || auth()->user()->can('Create Applications'))
                <a class="btn btn-primary float-end" href="{{ route('applications.create') }}">Create Application</a>
            @endif
            </h1>
            <div class="card">
                <div class="card-body">
                    <x-table action="{{ $action }}" :keys="['College Name', 'Email', 'Phone', 'City']" />
                </div>
            </div>
        </div>
    </section>

    @include('layouts.dataTablesFiles')

    @push('scripts')
        <script type="text/javascript">
        $("document").ready(function () {
            var datatable_url = route('applications.ajax');
            var datatable_columns = [
                {data: 'college_name'},
                {data: 'college_email'},
                {data: 'college_phone_no'},
                {data: 'city.name'},
                @if($action)
                {data: 'action', width: '10%', orderable: false, searchable: false}
                @endif
                ];

                create_datatables(datatable_url,datatable_columns);
          });
        </script>
    @endpush
</x-app-layout>
