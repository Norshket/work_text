<div class="row">
    @if ($canUpdate)
        <div class="col-4">
            <button class="btn btn-primary" onclick="user.edit('{{ $edit }}')">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    @endif
    @if (!$isAdmin)
        <div class="col-4">
            <button class="btn btn-success" onclick="user.permissions('{{ $permissions }}')">
                <i class="fas fa-lock"></i>
            </button>
        </div>
    @endif

    @if ($canDelete)
        <div class="col-4">
            <button class="btn btn-danger" onclick="Main.showDeleteModal('{{ $delete }}', 'users-table')">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    @endif
</div>
