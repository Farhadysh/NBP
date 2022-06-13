<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Order extends Model
{

    const STATUS_Not_PAYMENT = 'init';
    const STATUS_PAYMENT = 'success';
    const STATUS_CANCELED = 'failed';


    protected $fillable = [
        'user_id', 'address_id', 'status', 'send_status', 'description',
        'send_price', 'Authority', 'RefID', 'send_price', 'clear', 'send_type'
    ];

    public function getStatusAttribute($value)
    {
        $data = [];
        switch ($value) {
            case Order::STATUS_Not_PAYMENT:
                $data['title'] = 'پرداخت نشده';
                $data['color'] = 'warning';
                return $data;
                break;
            case Order::STATUS_PAYMENT:
                $data['title'] = 'پرداخت شده';
                $data['color'] = 'success';
                return $data;
                break;
            case Order::STATUS_CANCELED:
                $data['title'] = 'نا موفق';
                $data['color'] = 'danger';
                return $data;
                break;
        }
    }


    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i   Y/m/d');
    }

    public function orderLists()
    {
        return $this->hasMany(OrderList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
