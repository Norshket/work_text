@extends('adminlte::page')


@section('content')
    <div class="h2">
        title
    </div>
    <div class="card">
        <div class="card-body">
            <div class="raw">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" onclick="listItem.create('{{ route('list-items.create') }}')">
                        Добавить
                    </button>
                </div>
            </div>
            <div class="raw">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @include('vendor.modals.default_modal')
    @include('vendor.modals.delete')
@endsection


@push('js')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/list_items.js') }}"></script>
@endpush
