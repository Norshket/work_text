<div class="row">
    <div class="col-4">
        <button class="btn btn-primary" onclick="user.edit('{{ $edit }}')">
            <i class="fas fa-edit"></i>
        </button>
    </div>

    <div class="col-4">
        {{-- <button class="btn btn-success" onclick="user.edit('{{ $editPermissions }}')"> --}}
        <button class="btn btn-success" onclick="user.permissions('{{ $permissions }}')">
            <i class="fas fa-lock"></i>
        </button>
    </div>

    <div class="col-4">
        <button class="btn btn-danger" onclick="Main.showDeleteModal('{{ $delete }}')">
            <i class="fas fa-trash"></i>
        </button>
    </div>   
</div>
