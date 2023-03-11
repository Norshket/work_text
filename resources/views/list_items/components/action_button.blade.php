<div class="row">
    @if (auth()->user()->hasRole('admin') || $model->author_id == auth()->id())
        <div class="col-6">
            <button class="btn btn-primary" onclick="listItem.edit('{{ route('list_items.edit', $model) }}')">
                <i class="fas fa-edit"></i>
            </button>
        </div>

        <div class="col-6">
            <button class="btn btn-danger" onclick="Main.showDeleteModal('{{ route('list_items.destroy', $model) }}')">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    @else
        <div class="col-12">
            <button class="btn btn-success" onclick="listItem.edit('{{ route('list_items.show', $model) }}')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    @endif
</div>
