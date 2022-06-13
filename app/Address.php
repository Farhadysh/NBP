<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'city_id', 'address', 'mobile', 'postal_code', 'description'
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
