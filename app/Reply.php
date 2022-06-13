<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Reply extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'message', 'file', 'sellerView'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i:s Y/m/d');
    }
}
