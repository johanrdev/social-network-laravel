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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConversationController;
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

Route::model('friend', User::class);

Route::group(['middleware' => ['auth']], function() {
    // Resource routes for each model
    Route::resource('users', UserController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('bookmarks', BookmarkController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('messages', MessageController::class);
    Route::resource('friendrequests', FriendRequestController::class);
    Route::resource('friends', FriendController::class);
    Route::resource('conversations', ConversationController::class);

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/blogs', [DashboardController::class, 'blogs'])->name('blogs');
    Route::get('/dashboard/posts', [DashboardController::class, 'posts'])->name('posts');
    Route::get('/dashboard/categories', [DashboardController::class, 'categories'])->name('categories');
    Route::get('/dashboard/comments', [DashboardController::class, 'comments'])->name('comments');

    // Delete dashboard checked items routes
    Route::delete('/blogs', [BlogController::class, 'destroyAll'])->name('deleteCheckedBlogs');
    Route::delete('/posts', [PostController::class, 'destroyAll'])->name('deleteCheckedPosts');
    Route::delete('/categories', [CategoryController::class, 'destroyAll'])->name('deleteCheckedCategories');
    Route::delete('/comments', [CommentController::class, 'destroyAll'])->name('deleteCheckedComments');
    Route::delete('/bookmarks', [BookmarkController::class, 'destroyAll'])->name('deleteCheckedBookmarks');

    // Friendship routes
    Route::post('/friends', [FriendController::class, 'createRequest'])->name('createFriendRequest');
    Route::post('/friends/{friendRequest}', [FriendController::class, 'acceptRequest'])->name('acceptFriendRequest');
    Route::delete('/friends/destroy/{friendRequest}', [FriendController::class, 'declineRequest'])->name('declineFriendRequest');

    // Conversation routes
    Route::post('/conversations/{conversation}', [ConversationController::class, 'storeMessage'])->name('publishMessage');
    Route::get('/conversations/create/{user}', [ConversationController::class, 'createConversation'])->name('createConversation');
    Route::post('/conversations/create/{user}', [ConversationController::class, 'storeConversation'])->name('storeConversation');
});

require __DIR__.'/auth.php';
