<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingPaxDetail extends Model
{
    protected $fillable = [ 
        'country_id', 'booking_id', 'full_name', 'email', 'contact', 'date_of_birth', 'bedding_preference', 'dinning_preference'
    ];
}
