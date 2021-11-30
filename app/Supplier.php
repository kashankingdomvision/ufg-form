<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'currency_id',
        'country_id',
        'town_id',
        'location_id',
        'name',
        'email',
        'phone',
        'description'
    ];
    
    public function getCategories()
    {
        return $this->belongsToMany(Category::class, 'supplier_categories', 'supplier_id', 'category_id');
    }

    public function getProducts(){
        return $this->belongsToMany(Product::class, 'supplier_products', 'supplier_id', 'product_id');
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function getCountry()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function getTown()
    {
        return $this->hasOne(Town::class, 'id', 'town_id');
    }
}
