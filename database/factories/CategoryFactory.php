<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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

        $blogs = Blog::where('user_id', $user_ids[$random_user_index])->get();
        $random_blog_index = rand(0, count($blogs) - 1);

        return [
            'name' => ucfirst($this->faker->word),
            'user_id' => $user_ids[$random_user_index],
            'blog_id' => $blogs[$random_blog_index]->id
        ];
    }
}
