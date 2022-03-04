<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        
        'name',
        'phone',
        'sort_order',
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

    public function scopeOrderByService($query)
    {
        return $query->orderBy('service_sort_order', 'ASC');
    }

    public function scopeOrderByAsc($query)
    {
        return $query->orderBy('name', 'ASC');
    }
}
