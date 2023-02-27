<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = config('roles');

        foreach ($config['permissions'] as $page => $permissions) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate(['name' => ($page . '_' .$permission)]);
            }
        }

        
        foreach ($config['role_permissions'] as $key => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $key
            ], [
                'display_name' => $config['roles'][$key]
            ]);
            $role->givePermissionTo($permissions);
        }
        
    }
}
