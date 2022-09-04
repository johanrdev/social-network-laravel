<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(9);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        Blog::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard', ['tab' => 'blogs']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $bookmark = Bookmark::where('bookmarkable_id', $blog->id)
            ->where('bookmarkable_type', 'App\Models\Blog')
            ->where('user_id', Auth::user()->id)
        ->first();

        $posts = Post::where('blog_id', $blog->id)
            ->orderBy('id', 'desc')
        ->paginate(9);
        
        return view('blogs.show', compact('blog', 'posts', 'bookmark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogRequest $request, Blog $blog)
    {
        $blog->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $posts = Post::where('blog_id', $blog->id)->get();

        foreach ($posts as $post) {
            Comment::where('commentable_id', $post->id)
                ->where('commentable_type', 'App\Models\Post')
            ->delete();
            
            Bookmark::where('bookmarkable_id', $post->id)
                ->where('bookmarkable_type', 'App\Models\Post')
            ->delete();
        }

        Bookmark::where('bookmarkable_id', $blog->id)
            ->where('bookmarkable_type', 'App\Models\Blog')
        ->delete();
        Post::where('blog_id', $blog->id)->delete();
        Category::where('blog_id', $blog->id)->delete();

        $blog->delete();

        return redirect()->route('dashboard', ['tab' => 'blogs']);
    }
}
