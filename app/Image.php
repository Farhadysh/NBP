<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $casts = [
        'image' => 'array'
    ];
    protected $fillable = [
        'product_id', 'thumb', 'image'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function hasImage()
    {
        return !is_null($this->image);
    }

    public function imagePath()
    {
        return $this->hasImage() ? $this->image : null;
    }
}
