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
        'created_by',
        'commission_id',
        'commission_group_id',
        'country_destination_ids',
        'default_supplier_currency_id',
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
        'lead_passenger_medical_requirement',
        'lead_passenger_resident',
        'pax_no',
        'net_price',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',
        'commission_criteria_id',
        'commission_amount',
        'commission_percentage',
        'selling_currency_oc',
        'selling_price_ocr',
        'booking_amount_per_person_in_osp',
        'amount_per_person',
        'rate_type',
        'markup_type',
        'status',
        'booking_date',
        'cancel_date',
        'tas_ref',
        'revelant_quote',
        'is_sale_agent_paid',
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
        $status = $this->status;
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
    
    
    public function getCountryDestinations()
    {
        return $this->belongsToMany(Country::class, 'booking_country_destinations', 'booking_id', 'country_id');
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

    public function getCommissionCriteria(){
    	return $this->hasOne(CommissionCriteria::class, 'id', 'commission_criteria_id');
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
            return "";
            // return "<i class='fa fa-lock'  style='font-size:15px;'></i>";
        }
    }
    
    public function getSalePerson()
    {
        return $this->hasOne(User::class, 'id', 'sale_person_id');
    }

    public function getLastSaleAgentCommissionBatchDetails()
    {
        return $this->hasOne(SaleAgentCommissionBatchDetails::class, 'booking_id', 'id')->latest();
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

    public function setNetPriceAttribute( $value ) {
        $this->attributes['net_price'] = str_replace( ',', '', $value );
    }

    public function setMarkupAmountAttribute( $value ) {
        $this->attributes['markup_amount'] = str_replace( ',', '', $value );
    }

    public function setAgencyCommissionAttribute( $value ) {
        $this->attributes['agency_commission'] = str_replace( ',', '', $value );
    }

    public function setTotalNetMarginAttribute( $value ) {
        $this->attributes['total_net_margin'] = str_replace( ',', '', $value );
    }

    public function setSellingPriceAttribute( $value ) {
        $this->attributes['selling_price'] = str_replace( ',', '', $value );
    }

    public function setAmountPerPersonAttribute( $value ) {
        $this->attributes['amount_per_person'] = str_replace( ',', '', $value );
    }

    public function setCommissionAmountAttribute( $value ) {
        $this->attributes['commission_amount'] = str_replace( ',', '', $value );
    }

    public function setSellingPriceOcrAttribute( $value ) {
        $this->attributes['selling_price_ocr'] = str_replace( ',', '', $value );
    }

    public function setBookingAmountPerPersonInOspAttribute( $value ) {
        $this->attributes['booking_amount_per_person_in_osp'] = str_replace( ',', '', $value );
    }
}

// function getSupplierCurrency() {
//     return $this->hasOne(Currency::class, 'supplier_currency_id', 'currency_id');
// }