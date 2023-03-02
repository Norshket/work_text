<?php

namespace Database\Factories\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserFactory extends Factory
{
    protected $model = User::class;



    /**
     * configure
     * Создаём связи
     * @return void
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('user');
            $user->givePermissionTo(['list_items_open', 'users_close']);
        });
    }



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }
}
