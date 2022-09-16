<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = Conversation::with('users')->whereHas('users', function($query) {
            $query->where('user_id', Auth::user()->id);
        })
        ->orderBy('updated_at', 'desc')
        ->paginate($this->pagination_max_items_per_page);

        return view('conversations.index', compact('conversations'));
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

    public function createConversation(Request $request, User $user) {
        return view('conversations.create', compact('user'));
    }

    public function storeConversation(Request $request, User $user) {
        $conversation = Conversation::create();
        $conversation->touch();

        Auth::user()->conversations()->attach($conversation->id);
        $user->conversations()->attach($conversation->id);

        Auth::user()->conversations()->updateExistingPivot($conversation->id, ['last_visited' => now()]);
        $user->conversations()->updateExistingPivot($conversation->id, ['last_visited' => now()]);

        $message = Message::create([
            'content' => $request->input('content'),
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id
        ]);
        $message->touch();

        return redirect()->route('conversations.index');
    }

    public function storeMessage(Request $request, Conversation $conversation)
    {
        // Check if conversation belongs to the current user
        $is_user_conversation = $conversation->users->contains(Auth::user());

        if (!$is_user_conversation) {
            return redirect()->route('conversations.index');
        }

        Message::create([
            'content' => $request->input('content'),
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id
        ]);

        $conversation->touch();

        return redirect()->route('conversations.show', compact('conversation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $messages = $conversation->messages()->orderBy('id', 'desc')->paginate(5);

        Auth::user()->conversations()->updateExistingPivot($conversation->id, [
            'last_visited' => Carbon::now()
        ]);

        return view('conversations.show', compact('conversation', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
