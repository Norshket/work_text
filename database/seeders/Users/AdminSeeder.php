<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@admin.ru'
            ],
            [
                'name' => 'Aдминистратор',
                'password' => 'password',
            ]
        )->assignRole('admin');

        $user->givePermissionTo(['list_items_open', 'users_open']);
    }
}
