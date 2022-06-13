<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'price', 'score', 'expire_time', 'positionCount',
        'image', 'description', 'active', 'category_id', 'discount'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
