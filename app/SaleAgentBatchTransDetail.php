<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SaleAgentBatchTransDetail extends Model
{
    protected $table = 'sac_batch_trans_details';

    public $timestamps = false; 

    protected $fillable = [
        
        'sale_person_id',
        'type',
        'sac_batch_id',
    ];

    public function batchDetails()
    {
        return $this->hasOne(SaleAgentCommissionBatchDetails::class, 'sac_batch_trans_detail_id');
    }

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');   
    }

    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }

    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }

    public function getSACommissionBatch()
    {
        return $this->hasOne(SaleAgentCommissionBatch::class, 'id', 'sac_batch_id');   
    }

    public function getDepositDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
}
