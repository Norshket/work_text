<?php

namespace  App\Services\Users;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class UserPermissionService
{
    protected $translation = 'user_permissions.';

    /**
     * @param User $user
     * 
     * @return array
     */
    public function edit(User $user): array
    {
        $data = [
            'pages' => config('roles.permissions'),
            'model' => $user->load('permissions'),
            'title' => __($this->translation . "titles.edit"),
        ];

        return [
            'action'    => 'success',
            'html'      => view('users.components.form_permissions')->with($data)->render()
        ];
    }

    /**
     * @param User $user
     * @param array $request
     * 
     * @return bool
     */
    public function update(User $user, array $request): bool
    {
        $user->syncPermissions([]);
        foreach ($request as $page => $permission) {
            $user->givePermissionTo($page . '_' . $permission);
        }
        return true;
    }
}
