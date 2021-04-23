<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'radio_id',
    ];

    /**
     * Get the radio associated with the channel.
     */
    public function radio()
    {
        return $this->hasOne(Radio::class);
    }

    /**
     * Get the messages of the channel.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}