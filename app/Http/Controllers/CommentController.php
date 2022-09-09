<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
            'commentable_type' => 'App\\Models\\' . ucfirst($request->input('post_type')),
            'commentable_id' => $request->input('post_id')
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content')
        ]);

        return redirect()->route('dashboard', ['tab' => 'comments'])
            ->with('message', 'The comment was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('dashboard', ['tab' => 'comments']);
    }

    public function destroyAll(Request $request) {
        $ids = $request->ids;
        $id_array = explode(',', $ids);
        $count = 0;

        if ($ids == null) {
            return redirect()->route('dashboard', ['tab' => 'comments']);
        }

        foreach ($id_array as $id) {
            $recordExists = Comment::where('id', $id)
                ->where('user_id', Auth::user()->id)
            ->exists();

            if ($recordExists) $count++;
        }

        if ($count === count($id_array)) {
            Comment::whereIn('id', explode(',', $ids))
                ->where('user_id', Auth::user()->id)
            ->delete();
        }

        return redirect()->route('dashboard', ['tab' => 'comments']);
    }
}
