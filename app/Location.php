<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'country_id',
        'name',
    ];

    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
