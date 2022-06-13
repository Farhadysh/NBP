<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'product_id', 'title', 'prop','status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
