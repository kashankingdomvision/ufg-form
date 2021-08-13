<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCreditNote extends Model
{
    protected $fillable = [ 
        'booking_detail_id',
        'credit_note_amount',
        'credit_note_no',
        'credit_note_recieved_date',
        'credit_note_recieved_by',
        'user_id',
        'supplier_id'
    ];
}
