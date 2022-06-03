<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePersonPaymentDetail extends Model
{
    protected $fillable = [
        
        'sale_person_payment_id',
        'booking_id',
        'paid_amount',
    ];

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');   
    }
}
