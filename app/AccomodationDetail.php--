<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AccomodationDetail extends Model
{
    protected $fillable = [
        'booking_detail_id',
        'accomadation_name',
        'arrival_date',
        'no_of_nights',
        'no_of_rooms',
        'room_types',
        'meal_plan',
        'refrence',
        'day_event',
        'confirmed_with_supplier',
    ];

        
    public function setArrivalDateAttribute( $value ) {
        $this->attributes['arrival_date']   = isset($value) && !is_null($value) ?  date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d'))) : null;
    } 
}
