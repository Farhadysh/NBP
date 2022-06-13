<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageCart extends Model
{
    protected $fillable = [
        'user_id', 'package_id','count','total_points','name','image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }


}
