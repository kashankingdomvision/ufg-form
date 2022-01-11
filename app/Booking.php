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
        'commission_group_id',
        'season_id',
        'brand_id',
        'currency_id',
        'holiday_type_id',
        'sale_person_id',
        'booking_details',
        'reason_for_trip',
        'ref_name',
        'ref_no',
        'quote_ref',
        'agency',
        'agency_name',
        'agency_commission_type',
        'agency_commission',
        'total_net_margin',
        'agency_contact',
        'agency_email',
        'agency_contact_name',
        'lead_passenger_name',
        'lead_passenger_email',
        'lead_passenger_contact',
        'lead_passenger_dbo',
        'lead_passsenger_nationailty_id',
        'lead_passenger_dietary_preferences',
        'lead_passenger_bedding_preference',
        'lead_passenger_covid_vaccinated',
        'lead_passenger_resident',
        'pax_no',
        'net_price',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',
        'commission_amount',
        'commission_percentage',
        'selling_currency_oc',
        'selling_price_ocr',
        'amount_per_person',
        'rate_type',
        'markup_type',
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

    public function getFormatedDateOfBirthAttribute()
    {
        return Carbon::parse($this->lead_passenger_dbo)->format('d/m/Y');
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
    
    public function getBookingFormatedStatusAttribute()
    {
        $status = $this->booking_status;
        switch ($status) {
            case 'confirmed':
                return '<h5><span class="badge badge-success">Confirmed</span></h5>';
                break;
            case 'cancelled':
                return '<h5><span class="badge badge-danger">Cancelled</span></h5>';
                break;
        }
        
        return $status;
    }
    
    public function getBookingDetail()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id', 'id');
        // ->orderBy('date_of_service', 'ASC')->orderBy('time_of_service', 'ASC');
    }
    
    function getSeason() {
        return $this->hasOne(Season::class, 'id','season_id');
    }
    
    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    function getCommission() {
        return $this->hasOne(Commission::class, 'id', 'commission_id');
    }

    function getCommissionGroup() {
        return $this->hasOne(CommissionGroup::class, 'id', 'commission_group_id');
    }

    function getTotalRefundAmount() {
        return $this->hasOne(BookingCancellation::class, 'booking_id', 'id');
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

    public function getBookingCancellationRefundPaymentDetail()
    {
        return $this->hasMany(BookingCancellationRefundPayment::class, 'booking_id', 'id');
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

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getLeadPassengerNationality()
    {
        return $this->hasOne(Country::class, 'id', 'lead_passsenger_nationailty_id');
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