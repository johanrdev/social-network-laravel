<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Post;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(9);

        return view('users.index', compact('users'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = Blog::where('user_id', $user->id)
            ->orderBy('id', 'desc')
        ->paginate($this->pagination_max_blogs_per_page_in_profile);

        $posts = Post::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(8)
        ->get();

        $friends = User::whereHas('friends', function($query) use ($user) {
            $query->where('friend_id', $user->id);
        })->orderBy('name', 'asc')->get();

        $has_request = FriendRequest::where(function($query) use ($user) {
            $query->where('user_id', Auth::user()->id);
            $query->where('friend_id', $user->id);
        })->orWhere(function($query) use ($user)  {
            $query->where('user_id', $user->id);
            $query->where('friend_id', Auth::user()->id);
        })->exists();

        return view('users.show', compact('user', 'blogs', 'posts', 'friends', 'has_request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user_to_update = User::find(Auth::user()->id);

        if (Hash::check($request->input('current_password'), $user_to_update->password)) {
            // $user_to_update->touch();

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect()->route('users.show', Auth::user());
        } else {
            return redirect()->route('users.edit', Auth::user())->withErrors(['Current password is incorrect']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
