<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $random_user_index = rand(0, count($user_ids) - 1);

        $categories = Category::where('user_id', $user_ids[$random_user_index])->get();
        $random_category_index = rand(0, count($categories) - 1);

        return [
            'title' => ucwords($this->faker->words(5, true)),
            'content' => $this->faker->text(250),
            'user_id' => $categories[$random_category_index]->user_id,
            'blog_id' => $categories[$random_category_index]->blog_id,
            'category_id' => $categories[$random_category_index]->id
        ];
    }
}
