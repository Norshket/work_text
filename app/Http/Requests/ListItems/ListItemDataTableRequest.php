<?php

namespace App\Http\Requests\ListItems;

use Illuminate\Foundation\Http\FormRequest;

class ListItemDataTableRequest extends FormRequest
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
    public function rules()
    {
        return [
            'draw'          => 'nullable|numeric',
            'columns'       => 'nullable|array',
            "order"         => 'nullable|array',
            'start'         => 'nullable|numeric',
            'length'        => 'nullable|numeric',
            
            'search'        => 'nullable|string|max:255',
            'hashtag_id'    => 'nullable|array',
            'hashtag_id.*'  => 'nullable|numeric|exists:hashtags,id',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'search.value' => __('list_items.datatable.search')
        ];
    }
}
