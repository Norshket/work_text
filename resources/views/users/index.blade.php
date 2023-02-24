@extends('adminlte::page')


@section('content')
    <div class="h2">
        title
    </div>
    <div class="card">
        <div class="card-body">
            <div class="raw">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" onclick="listItem.create('{{ route('users.create') }}')">
                        Добавить
                    </button>
                </div>
            </div>
            <div class="raw">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @include('vendor.modals.modal_lg')
    @include('vendor.modals.delete')
@endsection


@push('js')
    {{ $dataTable->scripts() }}
    <script src="{{ asset('js/users.js') }}"></script>
@endpush
