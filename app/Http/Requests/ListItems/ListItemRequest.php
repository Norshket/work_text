<?php

namespace App\Http\Requests\ListItems;

use Illuminate\Foundation\Http\FormRequest;

class ListItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'text'          => 'nullable|string|max:65535',
            'hashtags.*'    => 'nullable|string|max:255',

            'image'         => 'nullable|image|mimes:png,jpg,jpeg',
            'image-x'       => 'nullable|numeric',
            'image-y'       => 'nullable|numeric',
            'image-width'   => 'nullable|numeric',
            'image-height'  => 'nullable|numeric',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'          => __('list_items.edit.name'),
            'text'          => __('list_items.edit.text'),
            'hashtags.*'    => __('list_items.edit.hashtags'),
            'image'         => __('list_items.edit.image'),
        ];
    }
}
