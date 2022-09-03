<?php

use App\Models\Blog;
use App\Models\Post;
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
    $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
    $posts = Post::where('user_id', Auth::user()->id)->paginate(10);

    return view('dashboard', compact('blogs', 'posts'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
