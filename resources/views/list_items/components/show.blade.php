<form id="create" class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
    </div>

    <div class="modal-body">

        <div class="row">
            <div class="col-6">
                <div class="form-group ">
                    <label for="name">{{ __('list_items.edit.name') }}</label>

                    <p>{{ $model->name }}</p>
                </div>

                <div class="form-group">
                    <label for="hashtags">{{ __('list_items.edit.hashtags') }}</label>

                    @if ($model->hashtags->isNotEmpty())
                        @foreach ($model->hashtags as $hashtags)
                            <p>{{ $hashtags->name }}</p>
                        @endforeach
                    @endif
                </div>

                <div class="form-group">
                    <label for="users">{{ __('list_items.edit.users') }}</label>
                    @foreach ($model->users as $user)
                        <p>{{ $user->name }}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                <label for="image">{{ __('list_items.edit.image') }}</label>
                <div style="position:relative">
                    <img id="mage-previewer" style="width: 150px" class="image-previewer"
                        src="{{ $model->getMedia('images')->isNotEmpty() ? $model->getMedia('images')[0]->getUrl() : '' }}" />
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p>
                    {{ $model->text }}
                </p>
            </div>
        </div>

    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-secondary" onclick="Main.hideModal($('.modal-form'))">
            {{ __('actions.back') }}
        </button>
    </div>
</form>
