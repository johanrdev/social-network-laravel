<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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

        $posts = Post::where('user_id', $user_ids[$random_user_index])->get();
        $random_post_index = rand(0, count($posts) - 1);

        return [
            'content' => $this->faker->text(100),
            'user_id' => $user_ids[$random_user_index],
            'commentable_id' => $posts[$random_post_index]->id,
            'commentable_type' => 'App\Models\Post'
        ];
    }
}
