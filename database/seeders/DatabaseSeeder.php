<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create(['name' => 'admin', 'email' => 'admin@example.com', 'password' => Hash::make('admin'), 'is_admin' => 1])->each(function ($user) {
            $blogs = Blog::factory(5)->create(['user_id' => $user->id]);

            foreach ($blogs as $blog) {
                $categories = Category::factory(3)->create(['user_id' => $blog->user->id, 'blog_id' => $blog->id]);

                foreach ($categories as $category) {
                    Post::factory(8)->create(['user_id' => $category->user->id, 'blog_id' => $category->blog->id, 'category_id' => $category->id]);
                }
            }
        });
        
        User::factory(9)->create()->each(function ($user) {
            $blogs = Blog::factory(5)->create(['user_id' => $user->id]);

            foreach ($blogs as $blog) {
                $categories = Category::factory(3)->create(['user_id' => $blog->user->id, 'blog_id' => $blog->id]);

                foreach ($categories as $category) {
                    Post::factory(8)->create(['user_id' => $category->user->id, 'blog_id' => $category->blog->id, 'category_id' => $category->id]);
                }
            }
        });
    }
}
