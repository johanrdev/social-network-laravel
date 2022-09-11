<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use App\Models\Post;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $blogs = Blog::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->get();

        return view('categories.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->input('name'),
            'blog_id' => $request->input('blog_id'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard', ['tab' => 'categories']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $blogs = Blog::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->get();

        return view('categories.edit', compact('category', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->input('name'),
            'blog_id' => $request->input('blog_id')
        ]);

        return redirect()->route('dashboard', ['tab' => 'categories'])
            ->with('message', 'The category was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('user_id', Auth::user()->id)
        ->get();

        foreach ($posts as $post) {
            $post->update(['category_id' => null]);
        }

        $category->delete();

        return redirect()->route('dashboard', ['tab' => 'categories']);
    }

    public function destroyAll(Request $request) {
        $ids = $request->ids;
        $id_array = explode(',', $ids);
        $count = 0;

        if ($ids == null) {
            return redirect()->route('dashboard', ['tab' => 'categories']);
        }

        foreach ($id_array as $id) {
            $recordExists = Category::where('id', $id)
                ->where('user_id', Auth::user()->id)
            ->exists();

            if ($recordExists) $count++;
        }

        if ($count === count($id_array)) {
            $posts = Post::whereIn('category_id', explode(',', $ids))
                ->where('user_id', Auth::user()->id)
            ->get();

            foreach ($posts as $post) {
                $post->update(['category_id' => null]);
            }

            $categories = Category::whereIn('id', explode(',', $ids))->delete();
        }

        return redirect()->route('dashboard', ['tab' => 'categories']);
    }
}
