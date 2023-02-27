<?php

namespace App\Http\Requests\Users;

use App\Rules\Permissions\ExistPermissions;
use Illuminate\Foundation\Http\FormRequest;

class UserPermissionRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'users'         => ['required', 'string', new ExistPermissions],
            'list_items'    => ['required', 'string', new ExistPermissions]
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'users'         => __('user_permissions.pages.users'),
            'list_items'    => __('user_permissions.pages.list_items'),
        ];
    }
}
