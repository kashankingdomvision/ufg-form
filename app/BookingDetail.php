<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class BookingDetail extends Model
{
    protected $fillable = [
        
        'booking_id',
        'category_id',
        'supplier_id',
        'product_id',
        'booking_method_id',
        'booked_by_id',
        'supervisor_id',
        'supplier_currency_id',
        'booking_type_id',
        'refundable_percentage',
        'date_of_service',
        'end_date_of_service',
        'time_of_service',
        'booking_date',
        'booking_due_date',
        'service_details',
        'booking_reference',
        'comments',
        'estimated_cost',
        'actual_cost',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'actual_cost_bc',
        'profit_percentage',
        'selling_price_bc',
        'markup_amount_bc',
        'added_in_sage', 
        'invoice',
        'outstanding_amount_left',
        'status'
    ];

    public function getCategory()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');   
    }

    function getSupplierCurrency() {
        return $this->hasOne(Currency::class,  'id' ,'supplier_currency_id');
    }
    
    public function getInvoiceUrlAttribute()
    {
        return url(Storage::url($this->invoice));
    }
    
    public function getBookingFinance()
    {
        return $this->hasMany(BookingDetailFinance::class, 'booking_detail_id', 'id');   
    }

    public function getBookingCancellation()
    {
        return $this->hasOne(BookingDetailCancellation::class, 'booking_detail_id', 'id');   
    }

    public function getBookingRefundPayment()
    {
        return $this->hasMany(BookingRefundPayment::class, 'booking_detail_id', 'id');   
    }

    public function getBookingCreditNote()
    {
        return $this->hasMany(BookingCreditNote::class, 'booking_detail_id', 'id');   
    }

    public function getAccomodationDetials()
    {
        return $this->hasOne(AccomodationDetail::class, 'booking_detail_id', 'id');   
    }

    public function getTransferDetials()
    {
        return $this->hasOne(TransferDetail::class, 'booking_detail_id', 'id');   
    }

    public function getServiceExcussionDetials()
    {
        return $this->hasOne(ServiceExcursionDetail::class, 'booking_detail_id', 'id');   
    }

    public function getDateOfServiceAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }

    public function getEndDateOfServiceAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function getBookingDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function getBookingDueDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function setDateOfServiceAttribute( $value ) {
        $this->attributes['date_of_service']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }

    public function setEndDateOfServiceAttribute( $value ) {
        $this->attributes['end_date_of_service']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }

    public function setBookingDateAttribute( $value ) {
        $this->attributes['booking_date']       = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
    
    public function setBookingDueDateAttribute( $value ) {
        $this->attributes['booking_due_date']   = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }  

}
