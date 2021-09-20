<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class BookingDetailFinance extends Model
{
    protected $fillable = [
        
        'booking_detail_id',
        'payment_method_id',
        'deposit_amount',
        'deposit_due_date',
        'paid_date',
        'upload_to_calender',
        'additional_date',
        'outstanding_amount',
        'status',
        'currency_id',
        'user_id'
    ];

    function getPaymentMethod() {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }
     
    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function getStaffPerson()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    function getBookingDetail() {
        return $this->hasOne(BookingDetail::class, 'id','booking_detail_id');
    }

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');   
    }

    public function getPaidDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }

}
