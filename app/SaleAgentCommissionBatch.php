<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SaleAgentCommissionBatch extends Model
{
    protected $table = 'sac_batches';

    protected $fillable = [
        
        'name',
        'payment_method_id',
        'total_paid_amount',
        'total_outstanding_amount',
        'sale_person_id',
        'sale_person_currency_id',
        'status',
        'sp_deposit_amount',
        'sp_deposit_date',
        'sp_deposit_paid_date',
        'bank_total_amount_paid',
    ];

    public function getFormattedStatusAttribute()
    {
        switch ($this->attributes['status']) {
            
            case 'pending':
                return '<h5><span class="badge badge-info">Pending</span></h5>';
                break;

            case 'partial':
                return '<h5><span class="badge badge-info">Partial</span></h5>';
                break;

            case 'disputed':
                return '<h5><span class="badge badge-danger">Disputed</span></h5>';
                break;

            case 'confirmed':
                return '<h5><span class="badge badge-success">Confirmed</span></h5>';
                break;

            case 'paid':
                return '<h5><span class="badge badge-success">Paid</span></h5>';
                break;

        }
    }

    public function getFormattedDepositDateAttribute()
    {
        return !isset($this->attributes['sp_deposit_date']) && is_null($this->attributes['sp_deposit_date']) ? '-' : Carbon::parse($this->attributes['sp_deposit_date'])->format('d/m/Y');
    }

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }

    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }

    function getPaymentMethod() {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    public function getSaleAgentCommissionBatchDetails()
    {
        return $this->hasMany(SaleAgentCommissionBatchDetails::class, 'sac_batch_id', 'id');
    }

    public function getBatchBookingIDSAttribute()
    {
        return $this->getSaleAgentCommissionBatchDetails->pluck('booking_id')->toArray();
    }

    public function setTotalPaidAmountAttribute( $value ) {
        $this->attributes['total_paid_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalOutstandingAmountAttribute( $value ) {
        $this->attributes['total_outstanding_amount'] = str_replace( ',', '', $value );
    }

}
