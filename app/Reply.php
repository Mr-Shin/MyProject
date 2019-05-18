<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable=[
        'text',
        'author',
        'photo',
        'comment_id',
    ];



}
