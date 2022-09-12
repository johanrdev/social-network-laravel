<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('recipient_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->groupBy('sender_id')
        ->paginate(10);
        
        // $conversations = DB::table('messages')
        //     ->where('sender_id', Auth::user()->id)
        //     ->orWhere('recipient_id', Auth::user()->id)
        // ->get();

        // $users = $conversations->map(function($conversation) {
        //     if ($conversation->sender_id == Auth::user()->id) {
        //         return $conversation->recipient_id;
        //     }

        //     return $conversation->sender_id;
        // })->unique();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (empty(request('recipient_id'))) {
            return redirect()->route('messages.index');
        }

        $recipient = null;
        $message = null;

        if (!empty(request('message_id')) && !empty(request('recipient_id'))) {
            $valid_message =  Message::where('id', request('message_id'))
                ->where('recipient_id', Auth::user()->id)
                ->where('sender_id', request('recipient_id'))
            ->exists();

            if ($valid_message) {
                $message = Message::where('id', request('message_id'))
                    ->where('recipient_id', Auth::user()->id)
                    ->where('sender_id', request('recipient_id'))
                ->first();

                $recipient = User::where('id', request('recipient_id'))->first();
            }
        }

        return view('messages.create', compact('message', 'recipient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('recipient_id') == Auth::user()->id) {
            return redirect()->route('messages.create', ['recipient_id' => $request->input('recipient_id')])
                ->withErrors([['message' => 'Cannot send a message to yourself.']]);
        }
        
        $recipient_id = $request->input('recipient_id');

        Message::create([
            'content' => $request->input('content'),
            'sender_id' => Auth::user()->id,
            'recipient_id' => $request->input('recipient_id')
        ]);

        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function getConversation($id) {
        Message::where('is_read', false)
            ->where('recipient_id', Auth::user()->id)
        ->update(['is_read' => true]);
        
        $messages = Message::where(function($query) use ($id) {
            $query->where('sender_id', $id);
            $query->where('recipient_id', Auth::user()->id);
        })->orWhere(function($query) use ($id) {
            $query->where('sender_id', Auth::user()->id);
            $query->where('recipient_id', $id);
        })
        ->orderBy('id', 'desc')
        ->get();

        foreach ($messages as $message) {
            echo '<p><strong>From: ' . $message->sender->name . '</strong></p>';
            echo '<p>' . $message->content . '</p>';
        }

        return;
    }
}
