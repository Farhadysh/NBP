<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'last_name', 'mobile', 'title', 'description', 'seen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
