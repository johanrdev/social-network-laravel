<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Bookmark;
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
            // $new_messages = Message::where('user_id', '!=', Auth::user()->id)->where('is_read', false)->count();
            $new_messages = 0;
            foreach (Auth::user()->conversations as $conversation) {
                $count = $conversation->messages->where('user_id', '!=', Auth::user()->id)
                                            ->where('created_at', '>', $conversation->users->find(Auth::user()->id)->pivot->last_visited)->count();

                $new_messages += $count;
            }
            
            // $new_messages = Auth::user()->messages->pivot();

            // $last_visited = Auth::user()->conversations()->where('conversation_id', 1)->select('last_visited')->first()->last_visited;
            $new_requests = Auth::user()->incomingRequests()->count();
            $updated_bookmarks = Bookmark::where('user_id', Auth::user()->id)->where('has_changes', true)->count();

            // Get all messages that belong to user conversations, but is not users
            // Count all created_at > last_updated

            
            
            $view->with('new_requests', $new_requests)
                ->with('new_messages', $new_messages)
                ->with('updated_bookmarks', $updated_bookmarks)
                ->with('num_of_blogs', $num_of_blogs)
                ->with('num_of_posts', $num_of_posts)
                ->with('num_of_categories', $num_of_categories)
                ->with('num_of_comments', $num_of_comments);
        });
    }
}
