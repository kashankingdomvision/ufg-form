<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAgentCommissionBatch extends Model
{
    protected $table = 'sac_batches';

    protected $fillable = [
        
        'name',
        'payment_method_id',
        'total_paid_amount',
        'total_outstanding_amount'
    ];

    function getPaymentMethod() {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    public function getSaleAgentCommissionBatchDetails()
    {
        return $this->hasMany(SaleAgentCommissionBatchDetails::class, 'sac_batch_id', 'id');
    }

    public function setTotalPaidAmountAttribute( $value ) {
        $this->attributes['total_paid_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalOutstandingAmountAttribute( $value ) {
        $this->attributes['total_outstanding_amount'] = str_replace( ',', '', $value );
    }

}
