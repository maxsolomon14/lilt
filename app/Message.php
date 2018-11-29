<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message',
        'sender_id',
        'recipient_id',
    ];

    protected $casts = [
        'message'      => 'string',
        'sender_id'    => 'integer',
        'recipient_id' => 'integer',
    ];
}
