@extends('adminlte::page')


@section('content')
    <div class="h2">
        title
    </div>
    <div class="card">

        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@push('js')
    {{ $dataTable->scripts() }}
@endpush
