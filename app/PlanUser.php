<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class PlanUser extends Model
{
    protected $fillable = [
        'user_id', 'plan_id', 'price', 'score', 'used',
        'expire_at', 'Authority', 'RefID', 'status', 'address_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i:s Y/m/d');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}