<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class Booking extends Model
{
    protected $fillable = [ 
        'quote_id',
        'user_id',
        'commission_id',
        'season_id',
        'brand_id',
        'currency_id',
        'holiday_type_id',
        'sale_person_id',
        'ref_name',
        'ref_no',
        'quote_ref',
        'lead_passenger',
        'agency',
        'agency_name',
        'agency_contact',
        'dinning_preference',
        'bedding_preference',
        'pax_no',
        'net_price',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',
        'commission_amount',
        'selling_currency_oc',
        'selling_price_ocr',
        'amount_per_person',
        'rate_type',
        'booking_status',
        'booking_date',
        'country_id',
        
    ];
    
    public function getVersionAttribute()
    {
        return Str::random(6).' '.$this->formated_created_at. ' By '.Auth::user()->name;
    }
    
    public function getFormatedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
    
    public function getBookingDetail()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id', 'id');
    }
    
    function getSeason() {
        return $this->hasOne(season::class, 'id','season_id');
    }
    
    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    // function getSupplierCurrency() {
    //     return $this->hasOne(Currency::class, 'supplier_currency_id', 'currency_id');
    // }
    
    function getBrand() {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    function getHolidayType() {
        return $this->hasOne(HolidayType::class,'id', 'holiday_type_id' );
    }

    public function getBookingPaxDetail()
    {
        return $this->hasMany(BookingPaxDetail::class, 'booking_id', 'id');
    }
    
    public function getBookingData()
    {
        return $this->hasOne(BookingData::class, 'id', 'booking_id');
    }
    
    public function getQuote()
    {
        return $this->hasOne(Quote::class, 'id', 'quote_id');
    }

    public function getPaxDetail()
    {
        return $this->hasMany(BookingPaxDetail::class, 'booking_id', 'id');
    }
    
    public function getBookingLogs()
    {
        return $this->hasMany(BookingLog::class, 'booking_id', 'id')->orderBy('log_no','DESC');
    }
   
}