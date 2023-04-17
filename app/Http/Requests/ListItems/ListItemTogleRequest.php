<?php

namespace App\Http\Requests\ListItems;

use Illuminate\Foundation\Http\FormRequest;

class ListItemTogleRequest extends FormRequest
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
            'is_done' => 'required|boolean',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'is_done' => __('list_items.edit.is_done'),
        ];
    }
}
