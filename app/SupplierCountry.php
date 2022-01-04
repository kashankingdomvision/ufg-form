<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierCountry extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'supplier_id',	'country_id'
    ];
}
