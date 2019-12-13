<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'id',
        'title',
        'detail',
        'photo',
        'type'
    ];
}
