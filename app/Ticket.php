<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Ticket extends Model
{
    const STATUS_NEW = 1;
    const STATUS_OPEN = 2;
    const STATUS_CLOSED = 3;

    const PRIORITY_LOW = 1;
    const PRIORITY_NORMAL = 2;
    const PRIORITY_HIGH = 3;

    protected $fillable = [
        'subject', 'body', 'status', 'user_id', 'parent_id', 'file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Jalalian::forge($value)->format('H:i:s Y/m/d');
    }

    public function getStatusAttribute($value)
    {
        $data = [];

        switch ($value) {
            case self::STATUS_NEW:
                $data['title'] = 'جدید';
                $data['color'] = 'success';
                return $data;
                break;
            case self::STATUS_OPEN:
                $data['title'] = 'باز';
                $data['color'] = 'info';
                return $data;
                break;
            case self::STATUS_CLOSED:
                $data['title'] = 'بسته';
                $data['color'] = 'danger';
                return $data;
                break;

            default :
                return $data;
        }
    }

    public function getPriorityAttribute($value)
    {
        $data = [];

        switch ($value) {
            case self::PRIORITY_LOW:
                $data['title'] = 'کم';
                $data['color'] = 'success';
                return $data;
                break;
            case self::PRIORITY_NORMAL:
                $data['title'] = 'متوسط';
                $data['color'] = 'info';
                return $data;
                break;
            case self::PRIORITY_HIGH:
                $data['title'] = 'زیاد';
                $data['color'] = 'danger';
                return $data;
                break;

            default :
                return $data;
        }
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getAgoAttribute()
    {
        return Jalalian::forge($this->getOriginal('created_at'))->ago();
    }
}
