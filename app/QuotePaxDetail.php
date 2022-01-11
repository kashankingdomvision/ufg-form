<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePaxDetail extends Model
{
    protected $fillable = [
        'nationality_id',
        'quote_id',
        'full_name',
        'email_address',
        'contact_number',
        'date_of_birth',
        'bedding_preference',
        'dietary_preferences',
        'covid_vaccinated',
        'resident_in',
    ];

    public function getPassengerNationality()
    {
        return $this->hasOne(Country::class, 'id', 'nationality_id');
    }

    public function getPassengerResidentIn()
    {
        return $this->hasOne(Country::class, 'id', 'resident_in');
    }
}
