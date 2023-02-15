<form id="create" class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label for="name">{{ __('list_items.edit.name') }}</label>
            <input 
                type="text"
                class="form-control"
                name="name" 
                id="name">
          </div>
    </div>

    <div class="modal-footer">
        
        <button 
            type="button"
            class="btn btn-secondary"
            onclick="Main.hideModal($('.default-modal'))"
        >
           {{ __('actions.back') }}
        </button>

        <button 
            type="button"
            class="btn btn-primary" 
            onclick="listItem.store('{{ route('list-items.store') }}')"
        >
        {{ __('actions.save') }}
        </button>
    </div>
</form>
