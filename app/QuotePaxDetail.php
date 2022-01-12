<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePaxDetail extends Model
{
    protected $fillable = [

        'quote_id',
        'full_name',
        'email_address',
        'contact_number',
        'date_of_birth',
        'nationality_id',
        'resident_in',
        'bedding_preference',
        'dietary_preferences',
        'medical_requirement',
        'covid_vaccinated',
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
