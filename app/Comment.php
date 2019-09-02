<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'comment',
        'author',
        'book_id',
        'user_id',
        'photo',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
