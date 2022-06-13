<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class PackageList extends Model
{
    protected $fillable = [
        'package_id', 'price', 'date', 'ref_id', 'count', 'total_points', 'expire_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i   Y/m/d');
    }

    public function planUser()
    {
        return $this->belongsTo('App\PlanUser', 'plan_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }


}
