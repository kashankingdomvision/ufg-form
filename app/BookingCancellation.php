<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCancellation extends Model
{
    protected $fillable = [ 
       'booking_id',
       'cancellation_charges',
       'cancellation_reason',
       'total_refund_amount',
       'currency_id',
    ];
}