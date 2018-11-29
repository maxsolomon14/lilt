<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
            'post_id',
            'user_id',
    ];

    protected $casts = [
            'post_id'        => 'integer',
            'user_id'        => 'integer',
    ];
}
