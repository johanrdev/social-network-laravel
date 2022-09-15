<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'description',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogs() {
        return $this->hasMany(Blog::class);
    }
    
    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function bookmarks() {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    // public function sentMessages() {
    //     return $this->hasMany(Message::class, 'sender_id');
    // }

    // public function receivedMessages() {
    //     return $this->hasMany(Message::class, 'recipient_id');
    // }

    // public function sentMessages() {
    //     return $this->hasMany(Message::class, 'sender_id');
    // }

    // public function receivedMessages() {
    //     return $this->hasMany(Message::class, 'recipient_id');
    // }

    // public function startedConversations() {
    //     return $this->hasMany(Conversation::class, 'sender_id');
    // }

    // public function receivedConversations() {
    //     return $this->hasMany(Conversation::class, 'recipient_id');
    // }

    public function messages() {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function friends() {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id');
    }

    public function outgoingRequests() {
        return $this->hasMany(FriendRequest::class, 'user_id');
    }

    public function incomingRequests() {
        return $this->hasMany(FriendRequest::class, 'friend_id');
    }

    public function conversations() {
        return $this->belongsToMany(Conversation::class)
            ->withTimestamps()
            ->withPivot(['last_visited']);
    }
}
