<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function blogs() {
        $blogs = Blog::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('dashboard.blogs', compact('blogs'));
    }

    public function posts() {
        $posts = Post::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('dashboard.posts', compact('posts'));
    }

    public function categories() {
        $categories = Category::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('dashboard.categories', compact('categories'));
    }

    public function comments() {
        $comments = Comment::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('dashboard.comments', compact('comments'));
    }
}
