<form id="create" class="modal-content">

    @if ($method == 'edit')       
      @method('PUT')
    @endif


    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
    </div>

    <div class="modal-body">

        <div class="row">      
            <div class="col-6">           
                <div class="form-group ">
                    <label for="name">{{ __('users.edit.name') }}</label>
                    <input 
                        type="text"
                        class="form-control"
                        name="name" 
                        id="name"
                        value="{{ isset($model) ? $model->name : '' }}"
                    >
                </div>

                <div class="form-group ">
                    <label for="email">{{ __('users.edit.email') }}</label>
                    <input 
                        type="email"
                        class="form-control"
                        name="email" 
                        id="email"
                        value="{{ isset($model) ? $model->email : '' }}"
                    >
                </div>

                <div class="form-group ">
                    <label for="password">{{ __('users.edit.password') }}</label>
                    <input 
                        type="password"
                        class="form-control"
                        name="password" 
                        id="password"
                    >
                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer">        
    
        @if ($method == 'edit')           
            <button 
                type="button"
                class="btn btn-primary" 
                onclick="user.update('{{ route('users.update' , $model->id) }}')"
            >
                {{ __('actions.save') }}
            </button>
        @else
            <button 
                type="button"
                class="btn btn-primary" 
                onclick="user.store('{{ route('users.store') }}')"
            >
                {{ __('actions.save') }}
            </button>            
        @endif   
        
        
        <button 
            type="button"
            class="btn btn-secondary"
            onclick="Main.hideModal($('.modal-form'))"
        >
           {{ __('actions.back') }}
        </button>
    </div>
</form>
