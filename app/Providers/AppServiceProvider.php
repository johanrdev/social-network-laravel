<?php

namespace App\Providers;

use App\Models\Blog;
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
            $view->with('userBlogs', $blogs);
        });
    }
}
