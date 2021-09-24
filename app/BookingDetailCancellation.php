<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetailCancellation extends Model
{
    protected $fillable = [
        'booking_detail_id',
        'cancelled_by_id'
    ];
}
