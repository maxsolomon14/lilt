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
    protected $fillable = ['name'];

    protected $casts = ['name' => 'datetime'];
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
