<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransferDetail extends Model
{
    protected $fillable = [
        'booking_detail_id',
        'transfer_description',
        "quantity",              
        "pickup_port",           
        "pickup_accomodation",     
        "pickup_date",            
        "pickup_time",           
        "dropoff_port",          
        "dropoff_accomodation",  
        "dropoff_date",           
        "dropoff_time",           
        "confirmed_with_supplier",
    ];


    public function setPickUpDateAttribute( $value ) {
        $this->attributes['pickup_date']   = isset($value) && !is_null($value) ? date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d'))) : null;
    } 

    public function setDropoffDateAttribute( $value ) {
        $this->attributes['dropoff_date']   = isset($value) && !is_null($value) ? date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d'))) : null;
    } 
}
