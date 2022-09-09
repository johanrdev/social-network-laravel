<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'sender_type', 'sender_id', 'recipient_type', 'recipient_id'];

    public function sender() {
        return $this->morphTo();
    }

    public function recipient() {
        return $this->morphTo();
    }
}
