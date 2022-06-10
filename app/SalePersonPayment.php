<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SalePersonPayment extends Model
{
    protected $fillable = [
        
        'sale_person_id',
        'sale_person_currency_id',
        'deposit_date',
        'total_deposited_amount',
        'current_deposited_total_outstanding_amount',
        'total_deposited_outstanding_amount',
        'total_deposit_amount'
        // 'balance_owed_amount',
        // 'balance_owed_outstanding_amount',
        // 'balance_owed_total_paid_amount',
    ];

    public function getSalePersonPaymentDetails()
    {
        return $this->hasMany(SalePersonPaymentDetail::class, 'sale_person_payment_id', 'id');
    }

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }
    
    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }

    // public function setBalanceOwedOutstandingAmountAttribute( $value ) {
    //     $this->attributes['balance_owed_outstanding_amount'] = str_replace( ',', '', $value );
    // }

    // public function setBalanceOwedTotalPaidAmountAttribute( $value ) {
    //     $this->attributes['balance_owed_total_paid_amount'] = str_replace( ',', '', $value );
    // }

    public function setTotalDepositedAmountAttribute( $value ) {
        $this->attributes['total_deposited_amount'] = str_replace( ',', '', $value );
    }

    public function setCurrentDepositedTotalOutstandingAmountAttribute( $value ) {
        $this->attributes['current_deposited_total_outstanding_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalDepositedOutstandingAmountAttribute( $value ) {
        $this->attributes['total_deposited_outstanding_amount'] = str_replace( ',', '', $value );
    }

    public function setTotalDepositAmountAttribute( $value ) {
        $this->attributes['total_deposit_amount'] = str_replace( ',', '', $value );
    }


    public function getDepositDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
}
