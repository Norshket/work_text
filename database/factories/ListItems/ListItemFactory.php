<?php

namespace Database\Factories\ListItems;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListItems\ListItem>
 */
class ListItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => fake()->company(),
            'text'      => fake()->text(400),
            'author_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
