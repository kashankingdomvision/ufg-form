<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class QuoteDetail extends Model
{
    protected $fillable = [ 
        
        'quote_id',
        'category_id',
        // 'supplier_location_id',
        'supplier_country_ids',
        'supplier_id',
        'group_owner_id',
        // 'product_location_id',
        'product_id',
        'booking_method_id',
        'booked_by_id',
        'supervisor_id',
        'date_of_service',
        'end_date_of_service',
        'number_of_nights',
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
        'selling_price_in_booking_currency',
        'markup_amount_in_booking_currency',
        'added_in_sage', 
        'time_of_service', 
        'second_time_of_service', 
        'amount_per_person',
        'booking_type_id',
        'parent_id',
        'image',
        'category_details',
        'product_details',
    ];
    

    public function getQuoteDetailCountries()
    {
        return $this->hasMany(QuoteDetailCountry::class, 'quote_detail_id','id');
    }

    public function getSuppliers()
    {
        return $this->belongsToMany(Supplier::class, 'id', 'supplier_id');
    }

    public function getChildQuote()
    {
        // dd('wqw');
        return $this->hasMany(QuoteDetail::class, 'parent_id', 'id');
    }
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getCategoryDetailFeilds()
    {
        return $this->hasMany(QuoteCategoryDetail::class, 'quote_detail_id', 'id');   
    }

    
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function getGroupOwner()
    {
        return $this->hasOne(GroupOwner::class, 'id', 'group_owner_id');
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

    public function setEstimatedCostAttribute( $value ) {
        $this->attributes['estimated_cost'] = str_replace( ',', '', $value );
    }

    public function setMarkupAmountAttribute( $value ) {
        $this->attributes['markup_amount'] = str_replace( ',', '', $value );
    }

    public function setSellingPriceAttribute( $value ) {
        $this->attributes['selling_price'] = str_replace( ',', '', $value );
    }

    public function setEstimatedCostBcAttribute( $value ) {
        $this->attributes['estimated_cost_bc'] = str_replace( ',', '', $value );
    }

    public function setMarkupAmountInBookingCurrencyAttribute( $value ) {
        $this->attributes['markup_amount_in_booking_currency'] = str_replace( ',', '', $value );
    }

    public function setSellingPriceInBookingCurrencyAttribute( $value ) {
        $this->attributes['selling_price_in_booking_currency'] = str_replace( ',', '', $value );
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
