<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'logo','about_us'
    ];
   
    public function getHolidayTypes()
    {
        return $this->hasMany(HolidayType::class, 'brand_id', 'id');
    }

    public function getImagePathAttribute()
    {
        return url(Storage::url($this->logo));
    }
}


// public function getSupplierCountries()
// {
//     return $this->belongsToMany(Country::class, 'brand_supplier_countries', 'brand_id', 'country_id');
// }
