<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRefundPayment extends Model
{
    protected $fillable = [
        'booking_detail_id',
        'refund_amount',
        'refund_date',
        'refund_confirmed_by',
        'bank_id',
    ];
}
