<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBulkPayment extends Model
{
    protected $fillable = [

        'total_paid_amount',      
        'current_credit_amount',   
        'remaining_credit_amount', 
        'payment_date',            
        'payment_method_id',       
        'user_id',                 
        'season_id',
        'currency_id'             
    ];
}
