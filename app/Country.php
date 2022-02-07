<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'sort_order',
        'name',
        'phone',
    ];

    public function getTowns()
    {
        return $this->hasMany(Town::class, 'country_id', 'id');
    }

    public function getLocations()
    {
        return $this->hasMany(Location::class, 'country_id', 'id');
    }
 
    public function getSuppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_countries', 'country_id', 'supplier_id');
    }
}
