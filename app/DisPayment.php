<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisPayment extends Model
{
    protected $fillable = [
        'discount_id', 'user_id', 'price', 'Authority', 'RefId',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }
}
