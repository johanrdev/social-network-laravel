<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['last_visited']);
    }

    public function getNewMessagesCount() {
        return $this->messages->where('user_id', '!=', Auth::user()->id)
        ->where('created_at', '>=', $this->users->find(Auth::user()->id)->pivot->last_visited)->count();
    }
}
