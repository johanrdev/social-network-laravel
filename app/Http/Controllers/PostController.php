<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        // $bookmark = Bookmark::where('bookmarkable_id', $post->id)->where('bookmarkable_type', $post->bookmarkable)
        return view('posts.show', compact('post', 'bookmark'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id')
        ]);

        return redirect()->route('dashboard', ['tab' => 'posts']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Comment::where('commentable_id', $post->id)->where('commentable_type', 'App\Models\Post')->delete();
        Bookmark::where('bookmarkable_id', $post->id)->where('bookmarkable_type', 'App\Models\Post')->delete();
        Bookmark::where('bookmarkable_id', $post->id)->where('bookmarkable_type', 'App\Models\Blog')->delete();
        $post->delete();

        return redirect()->route('dashboard', ['tab' => 'posts']);
    }
}
