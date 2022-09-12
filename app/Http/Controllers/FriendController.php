<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Auth::user()->friends()->paginate($this->pagination_max_items_per_page);
        $title = $friends->total() == 1 ? $friends->total() . ' Friend' : $friends->total() . ' Friends';

        return view('friends.index', compact('friends', 'title'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Auth::user()->friends()->detach($user->id);
        $user->friends()->detach(Auth::user()->id);

        return redirect()->route('friends.index');
    }

    public function createRequest(Request $request) {
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

    public function acceptRequest(FriendRequest $friendRequest) {
        Auth::user()->friends()->attach($friendRequest->user->id);
        $friendRequest->user->friends()->attach(Auth::user()->id);

        $friendRequest->delete();

        return redirect()->route('friends.index');
    }

    public function declineRequest(FriendRequest $friendRequest) {
        $friendRequest->delete();

        return redirect()->route('friends.index');
    }
}
