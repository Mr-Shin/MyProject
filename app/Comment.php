<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'text',
        'author',
        'book_id',
        'photo',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
