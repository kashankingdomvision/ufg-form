<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'currency_id',
        'town_id',
        'group_owner_id',
        'code',
        'commission_rate',
        'name',
        'email',
        'phone',
        'contact_person',
        'description'
    ];
    
    public function getCategories()
    {
        return $this->belongsToMany(Category::class, 'supplier_categories', 'supplier_id', 'category_id');
    }

    public function getProducts(){
        return $this->belongsToMany(Product::class, 'supplier_products', 'supplier_id', 'product_id');
    }

    public function getProductsWithLocation($location_id){
        return $this->getProducts()->where('location_id', $location_id);
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    function getCountries() {
        return $this->belongsToMany(Country::class, 'supplier_countries', 'supplier_id', 'country_id');
    }

    function getLocations(){
        return $this->belongsToMany(Location::class, 'supplier_locations', 'supplier_id', 'location_id');
    }

    public function getTown()
    {
        return $this->hasOne(Town::class, 'id', 'town_id');
    }

    public function getGroupOwner()
    {
        return $this->hasOne(GroupOwner::class, 'id', 'group_owner_id');
    }

}
