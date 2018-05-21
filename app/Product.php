<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku', 'price', 'description'
    ];

    /**
     * A product can have many bids
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    /**
     * A product can have one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Custom validation rules
     *
     * @return array
     */

    protected $rules = [
        'sku' => 'required|unique:products',
    ];
}
