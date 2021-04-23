<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    protected $fillable = [
        'name', 'frequency','logo'
    ];

    /**
     * Get the channel associated with the radio.
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}