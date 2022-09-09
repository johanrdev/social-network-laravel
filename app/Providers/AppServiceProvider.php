<?php

namespace App\Providers;

use App\Models\Blog;
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

            $blogs = Blog::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $new_messages = Message::where('recipient_id', Auth::user()->id)->where('is_read', false)->count();
            
            $view->with('userBlogs', $blogs)->with('new_messages', $new_messages);
        });
    }
}
