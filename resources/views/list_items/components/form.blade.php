<form id="create" class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
    </div>

    <div class="modal-body">

        @if ($method == 'edit')          
            @method('PUT')
        @endif

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

                <div class="form-group">
                    <label for="users">{{ __('list_items.edit.users') }}</label>
                    <select 
                        id="users"
                        name="users[]"
                        data-name="users" 
                        class="form-control ajax-select2"
                        multiple="multiple"
                        data-tags="true"
                    >
                        @foreach ($users as $key => $user)
                            <option 
                                value="{{ $key }}"                                 
                                @if( isset($model) && $model->users->contains('id',  $key )) selected  @endif                             
                            >
                                {{ $user }}
                            </option>
                        @endforeach                      
                    </select>
                </div>
            </div>

            <div class="col-6"> 

                <div class="row align-items-center">  
                    
                    <div class="col-10">
                        <label for="image">{{ __('list_items.edit.image') }}</label>
                        <input id="image" type="file" class="mb-3" name="image" data-url="">
                    </div>

                    <div class="col-2">
                        <button class="btn btn-danger" type="button" onclick="listItem.deleteImage()">
                            <i class="fas fa-trash"></i>
                        </button>

                        <input id="delete-image" name="delete-image" hidden type="checkbox">
                    </div>
              
                  
                    <div  class="col-12" style="position:relative">                    
                        <input type="text" id="image-x" name="image-x" hidden value="">
                        <input type="text" id="image-y" name="image-y" hidden value="">
                        <input type="text" id="image-width" name="image-width" hidden value="150">
                        <input type="text" id="image-height" name="image-height" hidden value="150">
                        <img 
                            id="image-previewer" 
                            style="width: 150px"
                            class="image-previewer"        
                            src="{{ isset($model) && $model->getMedia('images')->isNotEmpty() ? $model->getMedia('images')[0]->getUrl() : '' }}"        
                            data-cropzee="image"
                         />                        
                    </div>

                </div>

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
                onclick="listItem.update('{{ route('list_items.update' , $model->id) }}')"
            >
                {{ __('actions.save') }}
            </button>
        @else
            <button 
                type="button"
                class="btn btn-primary" 
                onclick="listItem.store('{{ route('list_items.store') }}')"
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
