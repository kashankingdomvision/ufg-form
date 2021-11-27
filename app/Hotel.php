<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'accom_code',
        'name',
        'country',
        'currency',
        'type',
    ];
}
