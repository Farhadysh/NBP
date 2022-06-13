<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{

    use Sluggable;

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
        'name', 'active', 'parent_id', 'image', 'slug'
    ];

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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
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
