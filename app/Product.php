<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'country_id',
        'location_id',
        'currency_id',
        'booking_type_id',
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

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    function getBookingType() {
        return $this->hasOne(BookingType::class, 'id', 'booking_type_id');
    }
}
