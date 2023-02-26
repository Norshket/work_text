<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email',
            'password'  => 'required|string|min:4',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => __('users.edit.name'),
            'email'     => __('users.edit.email'),
            'password'  => __('users.edit.password'),
        ];
    }
}
