<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingPaxDetail extends Model
{
    protected $fillable = [ 
        'nationality_id',
        'resident_in',
        'booking_id',
        'full_name',
        'email',
        'contact',
        'date_of_birth',
        'bedding_preference',
        'dinning_preference',
        'covid_vaccinated'
    ];
}
