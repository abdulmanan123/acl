<div>
    <table id="datatable" class="datatable table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                @foreach($keys as $key => $value)
                <th>{{ $value }}</th>
                @endforeach
                @if($action)
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="{{ ($action)?(count($keys)+1):count($keys) }}" align="center">No matching records found</td></tr>
        </tbody>
        <tfoot>
            <tr>
                @foreach($keys as $key => $value)
                <th>{{ $value }}</th>
                @endforeach
                @if($action)
                <th>Action</th>
                @endif
            </tr>
        </tfoot>
    </table>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>