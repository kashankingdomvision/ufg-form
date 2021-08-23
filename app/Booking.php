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
        'agency',
        'agency_name',
        'agency_contact',
        'agency_email',
        'agency_contact_name',
        'lead_passenger_name',
        'lead_passenger_email',
        'lead_passenger_contact',
        'lead_passenger_dbo',
        'lead_passsenger_nationailty_id',
        'lead_passenger_dinning_preference',
        'lead_passenger_bedding_preference',
        'lead_passenger_covid_vaccinated',
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
        'cancel_date',
        'tas_ref',
        'revelant_quote',
    ];
    
    public function getVersionAttribute()
    {
        return Str::random(6).' '.$this->formated_created_at. ' By '.Auth::user()->name;
    }
    
    public function getFormatedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function getAgencyBookingAttribute()
    {
        if($this->agency == 1){
            return "Yes";
        }else{
            return "No";
        }
    }

    public function getLeadPassengerDinningPreferencesAttribute()
    {
        if($this->agency == 1){
            return "";
        }else{
            return $this->lead_passenger_dinning_preference;
        }
    }
    public function getLeadPassengerBeddingPreferencesAttribute()
    {
        if($this->agency == 1){
            return "";
        }else{
            return $this->lead_passenger_bedding_preference;
        }
    }
    
    
    public function getBookingDetail()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id', 'id')->orderBy('updated_at','ASC');
        // ->orderBy('date_of_service', 'ASC')->orderBy('time_of_service', 'ASC');
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

    public function getQuoteUpdateDetail()
    {
        return $this->hasOne(QuoteUpdateDetail::class, 'foreign_id', 'id')->where('status','bookings');
    }

    public function getHasUserEditAttribute()
    {
        $checkUserExist = $this->getQuoteUpdateDetail()->where('user_id','!=',Auth::id())->exists();
        if($checkUserExist){
            return "<i class='fa fa-lock'  style='font-size:15px;'></i>";
        }
    }
    
    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }
   
    public function setRevelantQuoteAttribute($value)
    {
        $this->attributes['revelant_quote'] = json_encode($value);
    }
    
    
    public function getRevelantQuoteAttribute($value)
    {
        return json_decode($value);
    }
}