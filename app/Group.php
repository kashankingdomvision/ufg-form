<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'total_net_price',
        'total_markup_amount',
        'total_markup_percentage',
        'total_selling_price',
        'total_profit_percentage',
        'total_commission_amount',
        'currency_id'
    ];

    /**
     * The quotes that belong to the shop.
     */
    public function quotes()
    {
        return $this->belongsToMany('App\Quote');
    }

    /**
     * The currency that belong to the shop.
     */
    function getBookingCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
}
