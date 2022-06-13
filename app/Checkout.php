<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Checkout extends Model
{
    protected $fillable = [
        'position_id', 'price', 'status', 'RefID', 'Authority', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i   Y/m/d');
    }

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 'init':
                return [
                    'title' => 'در دست بررسی',
                    'color' => 'warning'
                ];
                break;
            case 'success':
                return [
                    'title' => 'موفق',
                    'color' => 'success'
                ];
                break;
            case 'failed':
                return [
                    'title' => 'نا موفق',
                    'color' => 'danger'
                ];
                break;
            default:
                return [
                    'title' => 'در دست بررسی',
                    'color' => 'warning'
                ];
        }
    }
}
