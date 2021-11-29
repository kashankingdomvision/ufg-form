<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'inclusions',
        'packing_list',
    ];
    
    public function getSuppliers()
    {
        return $this->belongsToMany(Product::class, 'supplier_products', 'product_id', 'supplier_id');
    }
}
