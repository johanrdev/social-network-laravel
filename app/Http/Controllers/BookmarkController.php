<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('bookmarks.index', compact('bookmarks'));
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
        $user_id = Auth::user()->id;
        $post_id = $request->input('post_id');
        $post_type = 'App\\Models\\' . ucfirst($request->input('post_type'));

        $bookmark_check = Bookmark::where('user_id', $user_id)
            ->where('bookmarkable_id', $post_id)
            ->where('bookmarkable_type', $post_type)
        ->first();

        if ($bookmark_check === null) {
            Bookmark::create([
                'user_id' => $user_id,
                'bookmarkable_id' => $post_id,
                'bookmarkable_type' => $post_type
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();

        return redirect()->back();
    }

    public function destroyAll(Request $request) {
        $ids = $request->ids;
        $id_array = explode(',', $ids);
        $count = 0;

        if ($ids == null) {
            return redirect()->route('dashboard', ['tab' => 'bookmarks']);
        }

        foreach ($id_array as $id) {
            $recordExists = Bookmark::where('id', $id)
                ->where('user_id', Auth::user()->id)
            ->exists();

            if ($recordExists) $count++;
        }

        if ($count === count($id_array)) {
            Bookmark::whereIn('id', explode(',', $ids))->delete();
        }

        return redirect()->route('dashboard', ['tab' => 'bookmarks']);
    }
}
