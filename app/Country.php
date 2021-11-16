<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'sortname',
        'name',
        'phonecode',
    ];

    public function getTowns()
    {
        return $this->hasMany(Town::class, 'country_id', 'id');
    }
}
