<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'category_id', 'active', 'price', 'image', 'taxes', 'points', 'url'
    ];

    public function packageLists()
    {
        return $this->hasMany(PackageList::class);
    }

    public function packageCart()
    {
        return $this->belongsTo(PackageCart::class, 'package_id');
    }

//    public function getIsIdAttribute()
//    {
//        $cart = false;
//
//        if (auth()->check())
//            $cart = $this->packageCart()->where('user_id', auth()->user()->id)->first();
//        return (!is_null($cart)) ? true : false;
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
