<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
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
        $request_exists = FriendRequest::where('user_id', Auth::user()->id)
            ->where('friend_id', $request->input('friend_id'))
        ->exists();

        if (!$request_exists) {
            FriendRequest::create([
                'user_id' => Auth::user()->id,
                'friend_id' => $request->input('friend_id'),
                'is_accepted' => false
            ]);
        }

        return redirect()->route('friends.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FriendRequest  $friendRequest
     * @return \Illuminate\Http\Response
     */
    public function show(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FriendRequest  $friendRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FriendRequest  $friendRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FriendRequest $friendRequest)
    {
        $request_exists = FriendRequest::where('user_id', $request->input('from_id'))
            ->where('friend_id', Auth::user()->id)
        ->exists();

        if ($request_exists) {
            FriendRequest::where('user_id', $request->input('from_id'))
                ->where('friend_id', Auth::user()->id)
            ->delete();

            Auth::user()->friends()->attach($request->input('from_id'));
            $u = User::find($request->input('from_id'));
            $u->friends()->attach(Auth::user()->id);
        }

        return redirect()->route('friends.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FriendRequest  $friendRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FriendRequest $friendRequest)
    {
        return $friendRequest;
        
        $request_exists = FriendRequest::where('user_id', $request->input('from_id'))
            ->where('friend_id', Auth::user()->id)
        ->exists();

        if ($request_exists) {
            FriendRequest::where('user_id', $request->input('from_id'))
                ->where('friend_id', Auth::user()->id)
            ->delete();
        }

        return redirect()->route('friends.index');
    }
}
