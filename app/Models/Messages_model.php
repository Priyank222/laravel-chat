<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Messages_model extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'image'];

    function sender_users() {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    function receiver_users() {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
}
