<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class WalletLog extends Model
{
    protected $fillable = [
        'user_id', 'price', 'subject'
    ];

    public function walletLogable()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i Y/m/d');
    }
}
