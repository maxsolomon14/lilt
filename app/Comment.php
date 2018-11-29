<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_name',
        'user_id',
        'comment',
        'post_id',
    ];

    protected $casts = [
        'user_name' => 'string',
        'user_id'   => 'integer',
        'comment'   => 'string',
        'post_id'   => 'integer',
    ];
}
