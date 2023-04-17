<div>
    <input type="checkbox" onchange="listItem.togle('{{ route('list_items.togle', $model) }}', $(this))"
        @if ($model->is_done) checked @endif name="is_done">
</div>
