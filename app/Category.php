<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
            'name', 'slug','feilds'
        ];

    public function getSupplier()
    {
        return $this->belongsToMany(Supplier::class,'supplier_categories','category_id', 'supplier_id');
    }
}
