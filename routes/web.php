<?php

use App\Models\User;
use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\FriendController;
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

Route::get('/explore', [BlogController::class, 'index'])->name('explore');

Route::get('/dashboard', function () {
    $max_items_per_page = 25;

    $blogs = Blog::where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')
    ->paginate($max_items_per_page);

    $posts = Post::where('user_id', Auth::user()->id)
        // ->where('blog_id', Auth::user()->selected_blog_id)
        ->orderBy('id', 'desc')
    ->paginate($max_items_per_page);

    $categories = Category::where('user_id', Auth::user()->id)
        // ->where('blog_id', Auth::user()->selected_blog_id)
        ->orderBy('id', 'desc')
    ->paginate($max_items_per_page);

    $comments = Comment::where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')
    ->paginate($max_items_per_page);

    $bookmarks = Bookmark::where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')
    ->paginate($max_items_per_page);

    return view('dashboard.index', compact(
        'blogs', 
        'posts', 
        'categories', 
        'comments', 
        'bookmarks'
    ));
})->middleware(['auth'])->name('dashboard');

Route::model('friend', User::class);

// Resource routes for each model
Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('blogs', BlogController::class)->middleware(['auth']);
Route::resource('posts', PostController::class)->middleware(['auth']);
Route::resource('categories', CategoryController::class)->middleware(['auth']);
Route::resource('bookmarks', BookmarkController::class)->middleware(['auth']);
Route::resource('comments', CommentController::class)->middleware(['auth']);
Route::resource('messages', MessageController::class)->middleware(['auth']);
Route::resource('friendrequests', FriendRequestController::class)->middleware(['auth']);
Route::resource('friends', FriendController::class)->middleware(['auth']);

// Delete checked items routes
Route::delete('/blogs', [BlogController::class, 'destroyAll'])->middleware(['auth'])->name('deleteCheckedBlogs');
Route::delete('/posts', [PostController::class, 'destroyAll'])->middleware(['auth'])->name('deleteCheckedPosts');
Route::delete('/categories', [CategoryController::class, 'destroyAll'])->middleware(['auth'])->name('deleteCheckedCategories');
Route::delete('/comments', [CommentController::class, 'destroyAll'])->middleware(['auth'])->name('deleteCheckedComments');
Route::delete('/bookmarks', [BookmarkController::class, 'destroyAll'])->middleware(['auth'])->name('deleteCheckedBookmarks');

Route::post('/friends', [FriendController::class, 'createRequest'])->middleware(['auth'])->name('createFriendRequest');
Route::post('/friends/{friendRequest}', [FriendController::class, 'acceptRequest'])->middleware(['auth'])->name('acceptFriendRequest');
Route::delete('/friends/destroy/{friendRequest}', [FriendController::class, 'declineRequest'])->middleware(['auth'])->name('declineFriendRequest');

Route::put('/set_current_blog_id', function() {
    $user = User::where('id', Auth::user()->id)
        ->update(['selected_blog_id' => request()
    ->input('selected_blog_id')]);
    
    return redirect()->back();
})->middleware(['auth'])->name('set_current_blog');

require __DIR__.'/auth.php';
