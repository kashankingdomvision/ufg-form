<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

        'name',
        'slug',
        'feilds',
        'quote',
        'booking',
        'sort_order',
        'set_end_date_of_service',
        'show_tf',
        'label_of_time',
    ];

    
    public function getProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getSupplier()
    {
        return $this->belongsToMany(Supplier::class,'supplier_categories','category_id', 'supplier_id');
    }

    public function getSupplierWithLocation($location_id)
    {
        return $this->getSupplier()->whereHas('getLocations', function($query) use ($location_id) {
            $query->where('id', $location_id);
        });

    }
}
