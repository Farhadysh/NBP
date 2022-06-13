<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'price', 'date', 'send',
        'ref_id', 'count', 'discount', 'production_price', 'company_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
