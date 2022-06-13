<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountCart extends Model
{
    protected $fillable = [
        'user_id', 'name', 'last_name',
        'image', 'Authority', 'RefID', 'price', 'status','bank_id','bank_name','mobile'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
