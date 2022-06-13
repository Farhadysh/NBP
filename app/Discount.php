<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name', 'price', 'image', 'active'
    ];

    public function imagePath()
    {
        return $this->image;
    }

    public function getActiveAttribute($value)
    {
        $data = [];
        switch ($value) {
            case Category::ACTIVE_FALSE:
                $data['title'] = 'غیر فعال';
                $data['color'] = 'danger';
                return $data;
                break;
            case Category::ACTIVE_TRUE:
                $data['title'] = 'فعال';
                $data['color'] = 'success';
                return $data;
                break;
        }
    }
}
