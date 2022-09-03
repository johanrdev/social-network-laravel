<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $random_index = rand(0, count($user_ids) - 1);

        return [
            'name' => ucwords($this->faker->words(2, true)) . ' Blog',
            'description' => $this->faker->text(300),
            'user_id' => $user_ids[$random_index]
        ];
    }
}
