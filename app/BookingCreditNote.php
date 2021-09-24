<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingCreditNote extends Model
{
    protected $fillable = [ 
        'booking_detail_id',
        'credit_note_amount',
        'credit_note_no',
        'credit_note_recieved_date',
        'credit_note_recieved_by',
        'user_id',
        'supplier_id',
        'currency_id'
    ];

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    function getBookingDetail() {
        return $this->hasOne(BookingDetail::class, 'id','booking_detail_id');
    }

    // public function getCreditNoteRecievedDateAttribute( $value ) {
    //     return (new Carbon($this->value))->format('d/m/Y');
    // }

}
