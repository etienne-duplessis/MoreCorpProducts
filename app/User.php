<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * A user can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    /**
     * A user can have one bid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bids()
    {
        return $this->hasOne('App\Bid');
    }

    /**
     * A function to make publishing products easier. Uses the relationship
     *
     */

    public function publishProduct(Product $product)
    {
        $this->products()->save($product);
    }
}
