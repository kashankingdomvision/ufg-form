<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBulkPaymentDetail extends Model
{
    protected $fillable = [
        
        'supplier_bulk_payment_id',      
        'booking_id',   
        'bd_reference_id', 
        'actual_cost', 
        'outstanding_amount_left', 
        'row_total_paid_amount', 
        'paid_amount',            
        'credit_note_amount',       
        'currency_id'               
    ];

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');   
    }

    public function getBookingDetail()
    {
        return $this->hasOne(BookingDetail::class, 'booking_detail_unique_ref_id', 'bd_reference_id');   
    }
}
