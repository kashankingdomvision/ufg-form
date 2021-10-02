<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class QuoteDetail extends Model
{
    protected $fillable = [ 
        
        'quote_id',
        'category_id',
        'supplier_id',
        'product_id',
        'booking_method_id',
        'booked_by_id',
        'supervisor_id',
        'date_of_service',
        'end_date_of_service',
        'booking_date',
        'booking_due_date',
        'service_details',
        'booking_reference',
        'booking_type_id',
        'refundable_percentage',
        'supplier_currency_id',
        'comments',
        'estimated_cost',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',
        'estimated_cost_bc',
        'selling_price_bc',
        'markup_amount_bc',
        'added_in_sage', 
        'time_of_service', 
        'amount_per_person',
        'booking_type_id',
        'parent_id',
        'image',
    ];
    
    public function getChildQuote()
    {
        // dd('wqw');
        return $this->hasMany(QuoteDetail::class, 'parent_id', 'id');
    }
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    function getSupervisor() {
        return $this->hasOne(User::class, 'id', 'supervisor_id');
    }

    function getBookingMethod() {
        return $this->hasOne(BookingMethod::class, 'id', 'booking_method_id');
    }

    function getBookingBy() {
        return $this->hasOne(User::class, 'id', 'booked_by_id');
    }
    
    function getBookingType() {
        return $this->hasOne(BookingType::class, 'id', 'booking_type_id');
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    function getSupplierCurrency() {
        return $this->hasOne(Currency::class,  'id' ,'supplier_currency_id');
    }

    public function getPassengerNationality()
    {
        return $this->hasOne(Country::class, 'id', 'nationality_id');
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

    public function getOriginalDateFormatAttribute( $value ) {
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

    public function getStoredText()
    {
        return $this->hasOne(QuoteDetailStoredText::class, 'quote_detail_id', 'id');
    }
}
