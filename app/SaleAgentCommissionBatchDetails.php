<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SaleAgentCommissionBatchDetails extends Model
{
    protected $table = 'sac_batch_details';

    protected $fillable = [
        
        // 'sac_batch_id',
        // 'booking_id',
        // 'sale_person_id',
        // 'sale_person_currency_id',
        // 'commission_amount_in_sale_person_currency',
        // 'total_paid_amount_yet',
        // 'outstanding_amount_left',
        // 'pay_commission_amount',
        // 'total_paid_amount',
        // 'total_outstanding_amount',
        // 'status',
        // 'dispute_detail',
        // 'deposited_amount_value',
        // 'bank_amount_value',
        
        // 'sac_batch_trans_detail_id',
        // 'booking_id',
        // 'sac_batch_id',
        // 'sale_person_id',
        // 'sale_person_id',
        // 'sale_person_currency_id',
        // 'total_paid_amount_yet',
        // 'outstanding_amount_left',
        // 'pay_commission_amount',
        // 'total_paid_amount',
        // 'total_outstanding_amount',
        // 'deposited_amount_value',
        // 'bank_amount_value',
        // 'status',


        'sac_batch_trans_detail_id',                 
        'sac_batch_id',                             
        'booking_id',                            
        'sale_person_id',                          
        'sale_person_currency_id',              
        'commission_amount_in_sale_person_currency', 
        'total_paid_amount_yet',                  
        'outstanding_amount_left',                 
        'pay_commission_amount',                  
        'total_paid_amount',                   
        'total_outstanding_amount',             
        'deposited_amount_value',                    
        'bank_amount_value',                         
        'status'                                    
    ];


    public function getFormattedStatusAttribute()
    {
        switch ($this->attributes['status']) {
            
            case 'confirmed':
                return '<h5><span class="badge badge-success">Confirmed</span></h5>';
                break;
            
            case 'pending':
                return '<h5><span class="badge badge-info">Pending</span></h5>';
                break;

            case 'dispute':
                return '<h5><span class="badge badge-danger">Dispute</span></h5>';
                break;

            case 'paid':
                return '<h5><span class="badge badge-success">Paid</span></h5>';
                break;
        }
    }
    
    public function getDepositDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }

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

    public function setDepositedAmountValueAttribute( $value ) {
        $this->attributes['deposited_amount_value'] = str_replace( ',', '', $value );
    }

    public function setBankAmountValueAttribute( $value ) {
        $this->attributes['bank_amount_value'] = str_replace( ',', '', $value );
    }

    public function setDepositDateAttribute( $value ) {
        $this->attributes['deposit_date']   = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
}
