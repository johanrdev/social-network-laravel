<?php

use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $max_items_per_page = 25;

    $blogs = Blog::where('user_id', Auth::user()->id)->paginate($max_items_per_page);
    $posts = Post::where('user_id', Auth::user()->id)->paginate($max_items_per_page);
    $categories = Category::where('user_id', Auth::user()->id)->paginate($max_items_per_page);
    $comments = Comment::where('user_id', Auth::user()->id)->paginate($max_items_per_page);
    $bookmarks = Bookmark::where('user_id', Auth::user()->id)->paginate($max_items_per_page);

    return view('dashboard', compact('blogs', 'posts', 'categories', 'comments', 'bookmarks'));
})->middleware(['auth'])->name('dashboard');

Route::resource('blogs', BlogController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
