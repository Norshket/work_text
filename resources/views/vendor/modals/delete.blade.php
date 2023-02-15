<div class="delete-modal modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
            
               {{ __('actions.delete_questions') }}
            </div>
            <div class="modal-footer">
                <button 
                    id="delete_action"
                    data-url=""
                    data-table_id=""
                    type="button" 
                    class="btn btn-danger" 
                    onclick="Main.delete()"
                >
                    {{ __('actions.delete') }}
                </button>

                <button
                    type="button" 
                    class="btn btn-primary"
                    onclick="Main.hideDeleteModal()"
                >
                    {{ __('actions.back') }}
                </button>
            </div>
        </div>
    </div>

</div>
