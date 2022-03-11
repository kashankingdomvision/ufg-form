<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingCancellationRefundPayment extends Model
{
    protected $fillable = [ 

        "booking_id",           
        "refund_amount",         
        "refund_date",          
        "refund_approved_date", 
        "refund_approved_by",    
        "refund_processed_by",   
        "bank_id",               
    ];

    public function setRefundAmountAttribute( $value ) {
        $this->attributes['refund_amount'] = str_replace( ',', '', $value );
    }
}