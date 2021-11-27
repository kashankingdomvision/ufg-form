<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportCode extends Model
{
    protected $fillable = [
        'name',
        'iata_code',
        'country',
    ];
}
