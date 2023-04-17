@extends('adminlte::page')


@section('content')
    <div class="h2">
        {{ __('list_items.titles.index') }}
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary"
                        onclick="listItem.create('{{ route('list_items.create') }}')">
                        Добавить
                    </button>
                </div>
            </div>
            <form class="row my-2" id="dt_filters">

                <div class="col-auto form-group">
                    <input 
                        type="text"
                        class="form-control"
                        placeholder="{{ __('list_items.datatable.search') }}"
                        onchange="Main.searchDataTable(this, 'list_items-table')"
                        name="search">
                </div>

                <select 
                    class="col-auto" 
                    name="hashtag_id[]" 
                    multiple
                    onchange="Main.updateDataTable(event, 'list_items-table')"
                    data-placeholder="{{ __('list_items.datatable.hashtags') }}"
                    class="ajax-select2"
                >
                    @foreach ($hashtags as $hashtag)
                        <option value="{{ $hashtag->id }}">{{ $hashtag->name }}</option>
                    @endforeach
                </select>



            </form>
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
    <script src="{{ asset('vendor/cropzee/cropzee.js') }}" defer></script>
    <script src="{{ asset('js/list_items.js') }}"></script>
@endpush
