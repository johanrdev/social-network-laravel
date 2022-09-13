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

Route::get('/dashboard', function () {
    return view('dashboard.index');
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
Route::resource('conversations', ConversationController::class)->middleware(['auth']);

// Dashboard routes
Route::get('/dashboard/blogs', [DashboardController::class, 'blogs'])
    ->middleware(['auth'])
->name('blogs');

Route::get('/dashboard/posts', [DashboardController::class, 'posts'])
    ->middleware(['auth'])
->name('posts');

Route::get('/dashboard/categories', [DashboardController::class, 'categories'])
    ->middleware(['auth'])
->name('categories');

Route::get('/dashboard/comments', [DashboardController::class, 'comments'])
    ->middleware(['auth'])
->name('comments');

// Delete dashboard checked items routes
Route::delete('/blogs', [BlogController::class, 'destroyAll'])
    ->middleware(['auth'])
->name('deleteCheckedBlogs');

Route::delete('/posts', [PostController::class, 'destroyAll'])
    ->middleware(['auth'])
->name('deleteCheckedPosts');

Route::delete('/categories', [CategoryController::class, 'destroyAll'])
    ->middleware(['auth'])
->name('deleteCheckedCategories');

Route::delete('/comments', [CommentController::class, 'destroyAll'])
    ->middleware(['auth'])
->name('deleteCheckedComments');

Route::delete('/bookmarks', [BookmarkController::class, 'destroyAll'])
    ->middleware(['auth'])
->name('deleteCheckedBookmarks');

// Friendship routes
Route::post('/friends', [FriendController::class, 'createRequest'])
    ->middleware(['auth'])
->name('createFriendRequest');

Route::post('/friends/{friendRequest}', [FriendController::class, 'acceptRequest'])
    ->middleware(['auth'])
->name('acceptFriendRequest');

Route::delete('/friends/destroy/{friendRequest}', [FriendController::class, 'declineRequest'])
    ->middleware(['auth'])
->name('declineFriendRequest');

// Messages routes
Route::get('/messages/conversation/{id}', [MessageController::class, 'getConversation'])
    ->middleware(['auth'])
->name('showConversation');

// Conversation routes
Route::post('/conversations/{conversation}', [ConversationController::class, 'storeMessage'])
    ->middleware(['auth'])
->name('publishMessage');

require __DIR__.'/auth.php';
