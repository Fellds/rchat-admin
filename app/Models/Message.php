<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id', 'channel_id','message'
    ];
    
    /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the channel that owns the message.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}