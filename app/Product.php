<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'country_id',
        'location_id',
        'currency_id',
        'duration',
        'price',
        'description',
        'inclusions',
        'packing_list'
    ];
    
    public function getSuppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_products', 'product_id', 'supplier_id');
        // return $this->belongsToMany(Product::class, 'supplier_products', 'product_id', 'supplier_id');
    }
}
