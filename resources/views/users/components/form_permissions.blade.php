<form id="create" class="modal-content">

    @method('PUT')

    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
    </div>

    <div class="modal-body">



        {{-- @foreach ($pages as $page => $permissions)

                    @foreach ($permissions as $permission)
                      
                      @dump($model->hasPermissionTo($page . '_' . $permission) )                      
                
                    
                    @endforeach

        @endforeach --}}


        @foreach ($pages as $page => $permissions)
            <div class="form-group row ">
                <label class="col-4" for="permission">
                    {{ __("user_permissions.pages.$page") }}
                </label>
                <div class="col-4">
                    <select
                        name="{{ $page }}"
                        class="form-control"
                    >
                        @foreach ($permissions as $permission)
                            <option 
                                value="{{ $permission }}" 
                                @if ($model->hasPermissionTo($page . '_' . $permission)) 
                                    selected 
                                @endif
                            >
                                {{ __("user_permissions.permissions.$permission") }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach

    </div>

    <div class="modal-footer">


        <button type="button" class="btn btn-primary"
            onclick="user.update('{{ route('user_permissions.update', $model->id) }}')">
            {{ __('actions.save') }}
        </button>


        <button type="button" class="btn btn-secondary" onclick="Main.hideModal($('.modal-form'))">
            {{ __('actions.back') }}
        </button>
    </div>
</form>
