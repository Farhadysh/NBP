<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'name', 'title', 'book_url', 'country', 'voice_url', 'image', 'status', 'writer', 'date', 'publisher'
    ];
}
