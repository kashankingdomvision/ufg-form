<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'booking_id',
        'booking_detail_id',
        'supplier_id',
        'amount',
        'type'
    ];

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function getBooking()
    {
        return $this->hasOne(Booking::class,'id','booking_id');
    }
}
