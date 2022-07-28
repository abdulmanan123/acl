<div class="modal fade p-modal" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary modal-btn">Save</button>
        </div>
      </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/form.js?v='.config('app.app_version')) }}"></script>
@endpush