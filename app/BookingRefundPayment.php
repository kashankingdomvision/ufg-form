<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class BookingRefundPayment extends Model
{
    protected $fillable = [
        
        'booking_detail_id',
        'refund_amount',
        'refund_date',
        'refund_confirmed_by',
        'bank_id',
        'refund_recieved',
        'refund_recieved_date',
        'currency_id',
        'user_id'
    ];

    function getBookingDetail() {
        return $this->hasOne(BookingDetail::class, 'id','booking_detail_id');
    }

    public function getBank()
    {
        return $this->hasOne(Bank::class,'id','bank_id');
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class,'id','currency_id');
    }

    public function getUser()
    {
        return $this->hasOne(User::class,'id','refund_confirmed_by');
    }
    
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
    
    public function setRefundDateAttribute( $value ) {
        $this->attributes['refund_date']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }

    public function setRefundAmountAttribute( $value ) {
        $this->attributes['refund_amount'] = str_replace( ',', '', $value );
    }
}
