<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetailCountry extends Model
{
    public $timestamps = false;
    
    protected $fillable = [ 
        
        'booking_id',
        'booking_detail_id',
        'country_id',
    ];
}
