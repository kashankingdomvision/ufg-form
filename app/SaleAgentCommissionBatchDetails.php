<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAgentCommissionBatchDetails extends Model
{
    protected $table = 'sac_batch_details';

    protected $fillable = [
        
        'sac_batch_id',
        'booking_id',
        'sales_agent_default_currency_id',
        'commission_amount_in_default_currency',
        'total_paid_amount_yet',
        'outstanding_amount_left',
        'pay_commission_amount',
        'total_paid_amount',
        'total_outstanding_amount',
    ];

    function getBooking() {
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sales_agent_default_currency_id');
    }

    public function setCommissionAmountInDefaultCurrencyAttribute( $value ) {
        $this->attributes['commission_amount_in_default_currency'] = str_replace( ',', '', $value );
    }

    public function setTotalPaidAmountYetAttribute( $value ) {
        $this->attributes['total_paid_amount_yet'] = str_replace( ',', '', $value );
    }

    public function setOutstandingAmountLeftAttribute( $value ) {


        $this->attributes['outstanding_amount_left'] = str_replace( ',', '', $value );
    }

    public function setPayCommissionAmountAttribute( $value ) {
        $this->attributes['pay_commission_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalPaidAmountAttribute( $value ) {
        $this->attributes['total_paid_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalOutstandingAmountAttribute( $value ) {
        $this->attributes['total_outstanding_amount'] = str_replace( ',', '', $value );
    }
}