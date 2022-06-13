<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use function foo\func;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'visitor_cod', 'email', 'password',
        'national_code', 'status', 'level', 'mobile', 'wallet',
        'bank_id', 'active', 'province', 'city_id', 'birth_date', 'image',
        'parent', 'best', 'nickname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parentUser()
    {
        return $this->belongsTo('App\Position', 'parent', 'visitor_code');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function positions()
    {
        return $this->hasMany('App\Position');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'Reference_code', 'visitor_cod');
    }

    public function packageCarts()
    {
        return $this->hasMany(PackageCart::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function discountCarts()
    {
        return $this->hasMany(DiscountCart::class);
    }

    public function visitCarts()
    {
        return $this->hasMany(VisitCart::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getPositionAttribute()
    {

    }

    public function getFullNameAttribute($value)
    {
        return $this->name . " " . $this->last_name;
    }

    public function walletLogs()
    {
        return $this->morphMany('App\WalletLog', 'walletLogable');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function isAdmin()
    {
        return $this->level == "admin";
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function commissions()
    {
        return $this->hasMany('App\WalletLog');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($roles)
    {
        return !!$roles->intersect($this->roles)->all();
    }

    public function isSeller()
    {
        return $this->level == "seller";
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function plans()
    {
        return $this->hasMany('App\PlanUser', 'user_id', 'id');
    }

    public function hasPlan($category_id)
    {
        if (is_string($category_id)) {
            if ($category_id == 'cart') {
                if ($this->plans()->where('status', 1)
                    ->where('used', 0)
                    ->where('expire_at', '>=', now())
                    ->whereHas('plan', function ($q) use ($category_id) {
                        return $q->where('id', 1);
                    })->count())
                    return true;

                return false;
            } elseif ($category_id == 'sms') {
                if ($this->plans()->where('status', 1)
                    ->where('used', 0)
                    ->where('expire_at', '>=', now())
                    ->whereHas('plan', function ($q) use ($category_id) {
                        return $q->where('id', 2);
                    })->count())
                    return true;

                return false;
            }
        } else {
            $category = Category::find($category_id);
            if ($category->parent_id != 0)
                $category_id = $category->parent->id;

            if ($this->plans()->where('status', 1)
                ->where('expire_at', '>=', now())
                ->where('used', 0)
                ->whereHas('plan', function ($q) use ($category_id) {
                    return $q->where('category_id', $category_id);
                })->count())
                return true;

            return false;
        }

        return false;
    }

    public function canActive()
    {
        $score = $this->plans->where('status', 1)
                ->where('expire_at', '>=', now())->sum('score') ?? 0;

        $position = $this->positions()->where('active', 1)->count() * 10;

        return ($score - $position) >= 10;
    }

    public function getScore()
    {
        $score = $this->plans->where('status', 1)
                ->where('expire_at', '>=', now())->sum('score') ?? 0;

        $position = $this->positions()->where('active', 1)->count() * 10;

        $score = $score - $position;

        return $score > 0 ? $score : 0;
    }

    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }
}
