<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'image_path',
        'author_id',
        'author_name',
];

    protected $casts = [
        'title'       => 'string',
        'body'        => 'string',
        'image_path'  => 'string',
        'author_id'   => 'integer',
        'author_name' => 'string',
];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
