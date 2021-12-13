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
    ];

    public function getSupplier()
    {
        return $this->belongsToMany(Supplier::class,'supplier_categories','category_id', 'supplier_id');
    }

    public function getSupplierWithLocation($location_id)
    {
        return $this->getSupplier()->where('location_id', $location_id);
    }
}
