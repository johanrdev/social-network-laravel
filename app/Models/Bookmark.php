<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bookmarkable_id', 'bookmarkable_type', 'has_changes'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookmarkable() {
        return $this->morphTo(__FUNCTION__, 'bookmarkable_type', 'bookmarkable_id');
    }
}
