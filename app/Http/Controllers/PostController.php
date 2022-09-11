<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogs = Blog::where('user_id', Auth::user()->id)->get();
        
        $blog_id = request('blog_id') ?? '';

        if ($blog_id) {
            $is_valid_blog_id = Blog::where('user_id', Auth::user()->id)->where('id', $blog_id)->exists();

            if ($is_valid_blog_id) {
                $selected_blog = Blog::where('user_id', Auth::user()->id)
                    ->where('id', $blog_id)
                    ->select('name')
                ->first();
                
                $categories = Category::where('user_id', Auth::user()->id)
                    ->where('blog_id', $blog_id)
                    ->orderBy('id', 'desc')
                ->get();

                return view('posts.create', compact('selected_blog', 'categories'));
            } else {
                return redirect()->route('posts.create', compact('blogs'))->withErrors(['error' => 'Select a valid blog']);
            }
        } else {
            return view('posts.create', compact('blogs'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // Check in case blog id has been tampered with
        $is_valid_blog_id = Blog::where('user_id', Auth::user()->id)
            ->where('id', $request->input('blog_id'))
        ->exists();

        // Check in case category id has been tampered with
        $is_valid_category_id = Category::where('user_id', Auth::user()->id)
            ->where('id', $request->input('category_id'))
            ->where('blog_id', $request->input('blog_id'))
        ->exists();

        // Return errors if blog or category id is invalid
        if (!$is_valid_blog_id || !$is_valid_category_id) {
            return redirect()->route('posts.create')
                ->withErrors(['error' => 'Please select a valid blog.']);
        }

        // Create the post
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'user_id' => Auth::user()->id,
            'blog_id' => $request->input('blog_id')
        ]);

        // Notify all bookmark subscribers that the blog has updates
        $bookmark = Bookmark::where('bookmarkable_id', $post->blog->id)
            ->where('has_changes', false)
        ->update(['has_changes' => true]);

        return redirect()->route('dashboard', ['tab' => 'posts']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $bookmark = Bookmark::where('bookmarkable_id', $post->id)
            ->where('bookmarkable_type', 'App\Models\Post')
            ->where('user_id', Auth::user()->id)
        ->first();

        if ($bookmark) {
            if ($bookmark->has_changes) {
                $bookmark->update(['has_changes' => false]);
            }
        }

        $comments = Comment::where('commentable_id', $post->id)
            ->orderBy('id', 'desc')
        ->paginate(3);
        
        return view('posts.show', compact('post', 'bookmark', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('user_id', Auth::user()->id)
            ->where('blog_id', $post->blog_id)
            ->orderBy('id', 'desc')
        ->get();

        $blogs = Blog::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->get();

        return view('posts.edit', compact('post', 'categories', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        // Check in case blog id has been tampered with
        $is_valid_blog_id = Blog::where('user_id', Auth::user()->id)
            ->where('id', $request->input('blog_id'))
        ->exists();

        // Check in case category id has been tampered with
        $is_valid_category_id = Category::where('user_id', Auth::user()->id)
            ->where('id', $request->input('category_id'))
            ->where('blog_id', $request->input('blog_id'))
        ->exists();

        // Return errors if blog or category id is invalid
        if (!$is_valid_blog_id || !$is_valid_category_id) {
            return redirect()->route('posts.edit', $post)
                ->withErrors(['error' => 'Invalid blog id.']);
        }
        
        // Update the post
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id')
        ]);

        // Notify all bookmark subscribers that the post has updates
        Bookmark::where('bookmarkable_id', $post->id)
            ->where('bookmarkable_type', 'App\Models\Post')
        ->update(['has_changes' => true]);

        return redirect()->route('dashboard', ['tab' => 'posts'])
            ->with('message', 'The post was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Comment::where('commentable_id', $post->id)
            ->where('commentable_type', 'App\Models\Post')
        ->delete();
        
        Bookmark::where('bookmarkable_id', $post->id)
            ->where('bookmarkable_type', 'App\Models\Post')
        ->delete();

        Bookmark::where('bookmarkable_id', $post->id)
            ->where('bookmarkable_type', 'App\Models\Blog')
        ->delete();
        
        $post->delete();

        return redirect()->route('dashboard', ['tab' => 'posts']);
    }

    public function destroyAll(Request $request) {
        $ids = $request->ids;
        $id_array = explode(',', $ids);
        $count = 0;

        if ($ids == null) {
            return redirect()->route('dashboard', ['tab' => 'posts']);
        }

        foreach ($id_array as $id) {
            $recordExists = Post::where('id', $id)
                ->where('user_id', Auth::user()->id)
            ->exists();

            if ($recordExists) $count++;
        }

        if ($count === count($id_array)) {
            // Remove any comments associated with the posts
            Comment::whereIn('commentable_id', explode(',', $ids))
                ->where('commentable_type', 'App\Models\Post')
            ->delete();
            
            // Remove any bookmarks associated with the posts
            Bookmark::whereIn('bookmarkable_id', explode(',', $ids))
                ->where('bookmarkable_type', 'App\Models\Post')
            ->delete();

            // Remove any blog bookmarks associated with the posts
            Bookmark::whereIn('bookmarkable_id', explode(',', $ids))
                ->where('bookmarkable_type', 'App\Models\Blog')
            ->delete();

            Post::whereIn('id', explode(',', $ids))
                ->where('user_id', Auth::user()->id)
            ->delete();
        }

        return redirect()->route('dashboard', ['tab' => 'posts']);
    }
}
