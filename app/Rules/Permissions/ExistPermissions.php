<?php

namespace App\Rules\Permissions;

use Illuminate\Contracts\Validation\Rule;

class ExistPermissions implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value):bool
    {
        $permissions = config('roles.permissions')[$attribute];
        return in_array($value,  $permissions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.exist_permissions');
    }
}
