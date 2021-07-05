<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'name', 'description'
    ];
    
    public function getSuppliers()
    {
        return $this->belongsToMany(Product::class, 'supplier_products', 'product_id', 'supplier_id');
    }
}
