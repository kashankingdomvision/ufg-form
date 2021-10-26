<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBulkPayment extends Model
{
    protected $fillable = [

        'supplier_id',      
        'total_used_credit_amount',      
        'total_paid_amount',      
        'current_credit_amount',   
        'remaining_credit_amount', 
        'payment_date',            
        'payment_method_id',       
        'user_id',                 
        'season_id',
        'currency_id'             
    ];

    function getPaymentMethod() {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    function getSeason() {
        return $this->hasOne(season::class, 'id','season_id');
    }

    
    function getUser() {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function getPaymentDetail()
    {
        return $this->hasMany(SupplierBulkPaymentDetail::class, 'supplier_bulk_payment_id', 'id');
    }
}
