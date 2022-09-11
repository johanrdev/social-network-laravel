<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            if (!Auth::check()) return;

            // For displaying count in dashboard sidebar
            $num_of_blogs = Blog::where('user_id', Auth::user()->id)->count();
            $num_of_posts = Post::where('user_id', Auth::user()->id)->count();
            $num_of_categories = Category::where('user_id', Auth::user()->id)->count();
            $num_of_comments = Comment::where('user_id', Auth::user()->id)->count();

            // For notifying user about new messages and friend requests
            $new_messages = Message::where('recipient_id', Auth::user()->id)->where('is_read', false)->count();
            $new_requests = Auth::user()->incomingRequests()->count();
            
            $view->with('new_messages', $new_messages)
                ->with('new_requests', $new_requests)
                ->with('num_of_blogs', $num_of_blogs)
                ->with('num_of_posts', $num_of_posts)
                ->with('num_of_categories', $num_of_categories)
                ->with('num_of_comments', $num_of_comments);
        });
    }
}
