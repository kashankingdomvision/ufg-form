<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePersonPayment extends Model
{
    protected $fillable = [
        
        'sale_person_id',
        'sale_person_currency_id',
        'balance_owed_amount',
        'balance_owed_outstanding_amount',
        'balance_owed_total_paid_amount',
    ];

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }
    
    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }

    public function setBalanceOwedOutstandingAmountAttribute( $value ) {
        $this->attributes['balance_owed_outstanding_amount'] = str_replace( ',', '', $value );
    }

    public function setBalanceOwedTotalPaidAmountAttribute( $value ) {
        $this->attributes['balance_owed_total_paid_amount'] = str_replace( ',', '', $value );
    }
}
