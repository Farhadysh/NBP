<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;

    const sendDay_AMADE = 1;
    const sendDay_TWO = 2;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    const ACTIVE_TRUE = 1;
    const ACTIVE_FALSE = 0;

    protected $fillable = [
        'name', 'active', 'price', 'discount', 'sell_count', 'unit',
        'description', 'slug', 'limit_weight', 'telegram', 'instagram', 'special',
        'limit_count', 'code', 'user_id', 'approved', 'sendDay',
        'production_price', 'company_price', 'brand', 'cause', 'buyCount', 'viewCount', 'commission'
    ];

    public function getActiveAttribute($value)
    {
        $data = [];
        switch ($value) {
            case Product::ACTIVE_FALSE:
                $data['title'] = 'غیر فعال';
                $data['color'] = 'danger';
                return $data;
                break;
            case Product::ACTIVE_TRUE:
                $data['title'] = 'فعال';
                $data['color'] = 'success';
                return $data;
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function hasImage()
    {
        return count($this->images) > 0;
    }

    public function imagePath()
    {
        return $this->hasImage() ? $this->images->where('thumb', 1)->first()->image : null;
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function commission()
    {
        return ($this->discount - $this->company_price);
    }
}
