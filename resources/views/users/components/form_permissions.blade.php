<form id="create" class="modal-content">   

    @method('PUT')

    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
    </div>

    <div class="modal-body">

        <div class="row">

            @foreach ($pages as $page => $permissions)
                <div class="col-12">
                    <div class="form-group row ">
                        <label class="col-4" for="permission">{{ __("user_permissions.pages.$page") }}</label>
                        <div class="col-4" >
                            <select name="permission" class="form-control" >
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission }}">{{ __("user_permissions.permissions.$permission") }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal-footer">


        <button type="button" class="btn btn-primary"
            onclick="listItem.update('{{ route('user_permissions.update', $model->id) }}')">
            {{ __('actions.save') }}
        </button>


        <button type="button" class="btn btn-secondary" onclick="Main.hideModal($('.modal-form'))">
            {{ __('actions.back') }}
        </button>
    </div>
</form>
