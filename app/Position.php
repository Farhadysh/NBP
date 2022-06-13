<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'user_id', 'Reference_code', 'Consultant_code',
        'wallet', 'wallet_status', 'visitor_code',
        'position', 'name', 'hand_id', 'active',
        'r_hand', 'l_hand', 'leftCount', 'rightCount', 'hand_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checkouts()
    {
        return $this->hasMany('App\Checkout');
    }

    public function parent()
    {
        return $this->belongsTo(Position::class, 'Consultant_code',
            'visitor_code');
    }

    public function children()
    {
        return $this->hasMany(Position::class, 'Consultant_code',
            'visitor_code');
    }

    public function consultant()
    {
        return $this->belongsTo(Position::class,
            'visitor_code', 'Consultant_code');
    }

    public function consultantChild()
    {
        return $this->hasMany(Position::class, 'Consultant_code', 'visitor_code');
    }

    public function allParent()
    {
        return $this->parent()->with('allParent');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function walletLogs()
    {
        return $this->morphMany('App\WalletLog', 'walletLogable');
    }

    public function reference()
    {
        return $this->belongsTo('App\Position', 'Reference_code', 'visitor_code');
    }
}
