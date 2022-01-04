<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLocation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'supplier_id',	'location_id'
    ];
}
