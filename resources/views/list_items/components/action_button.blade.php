<div class="row">
    <div class="col-6">
        <button class="btn btn-primary" onclick="listItem.edit('{{ $edit }}')">
            <i class="fas fa-edit"></i>
        </button>
    </div>
    <div class="col-6">
        <button class="btn btn-danger" onclick="Main.showDeleteModal('{{ $delete }}')">
            <i class="fas fa-trash"></i>
        </button>
    </div>   
</div>
