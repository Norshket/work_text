<form id="create" class="modal-content">
    {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
    </div> --}}

    <div class="modal-body">

        <div class="row">      
            <div class="col-6">           
                <div class="form-group ">
                    <label for="name">{{ __('list_items.edit.name') }}</label>
                    <input 
                        type="text"
                        class="form-control"
                        name="name" 
                        id="name"
                        value="{{ isset($model) ? $model->name : '' }}"
                    >
                </div>

                <div class="form-group">
                    <label for="hashtags">{{ __('list_items.edit.hashtags') }}</label>
                    <select 
                        id="hashtags"
                        name="hashtags[]"
                        data-name="hashtags" 
                        class="form-control ajax-select2"
                        multiple="multiple"
                        data-tags="true"
                    >
                        @if (isset($model) && $model->hashtags->isNotEmpty())
                            @foreach ($model->hashtags as $hashtags)
                                <option value="{{ $hashtags->name }}" selected>{{ $hashtags->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-6"> 

            </div>
        </div>

        <div class="row">                
                <div class="form-group col-12">
                    <label for="text">{{ __('list_items.edit.text') }}</label>
                    <textarea 
                        class="form-control"
                        name="text" 
                        id="text" 
                        cols="30"
                        rows="10"
                    >{{ isset($model) ? $model->text : '' }}</textarea>
                
                </div>
        </div>

    </div>

    <div class="modal-footer">        
    
        @if ($method == 'edit')           
            <button 
                type="button"
                class="btn btn-primary" 
                onclick="listItem.update('{{ route('list-items.update' , $model->id) }}')"
            >
                {{ __('actions.save') }}
            </button>
        @else
            <button 
                type="button"
                class="btn btn-primary" 
                onclick="listItem.store('{{ route('list-items.store') }}')"
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
