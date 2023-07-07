<div class="modal fade" id="modal-delete" class="jq-modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('messages.delete_modal_title') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('common.button_cancel') }}</button>
          <button type="button" class="btn btn-danger jq-delete-submit">{{ __('common.button_delete') }}</button>
        </div>
      </div>
    </div>
</div>