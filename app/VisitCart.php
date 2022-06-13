<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class VisitCart extends Model
{
    protected $fillable = [
        'user_id', 'fa_id','en_id','email','description','seen','numeric_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i Y/m/d');
    }
}
