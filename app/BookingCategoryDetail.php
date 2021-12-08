<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCategoryDetail extends Model
{
    protected $fillable = [

        'booking_id',
        'booking_detail_id',
        'category_id',
        'type',
        'key',
        'value',
    ];
}
