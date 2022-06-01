<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePersonPayment extends Model
{
    protected $fillable = [
        
        'sale_person_id',
        'sale_person_currency_id',
        'balance_owed_amount',
    ];

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }
    
    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }

}
