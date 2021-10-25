<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBulkPaymentDetail extends Model
{
    protected $fillable = [
        
        'supplier_bulk_payment_id',      
        'booking_id',   
        'bd_reference_id', 
        'paid_amount',            
        'credit_note_amount',       
        'currency_id'               
    ];
}
