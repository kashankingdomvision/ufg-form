<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [ 
        
        'season_id',
        'brand_id',
        'holiday_type_id',
        'currency_id',
        'sale_person_id',
        'default_supplier_currency_id',
        'commission_id',
        'commission_group_id',
        'commission_criteria_id',
        'booking_details',
        'reason_for_trip',
        'sale_person_currency_id',
        'ref_name',
        'ref_no',
        'quote_ref',
        'country_destination_ids',

        'agency',
        'agency_name',
        'agency_email',
        'agency_contact',
        'agency_contact_name',
        'agency_commission',
        'agency_commission_type',
        'total_net_margin',
        
        'lead_passenger_name',
        'lead_passenger_email',
        'lead_passenger_contact',
        'lead_passenger_dbo',

        'lead_passsenger_nationailty_id',
        'lead_passenger_resident',
        'lead_passenger_covid_vaccinated',
        'lead_passenger_bedding_preference',
        'lead_passenger_dietary_preferences',
        'lead_passenger_medical_requirement',

        'pax_no',
        'net_price',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',

        'commission_amount',
        'commission_amount_in_sale_person_currency',
        'commission_percentage',

        'selling_currency_oc',
        'selling_price_ocr',
        'booking_amount_per_person_in_osp',
        'amount_per_person',

        'rate_type',
        'markup_type',
        
        'revelant_quote',

        'status',
        'booking_date',
        'is_archive',
        'tas_ref',
        'departure_date',
        'return_date',
        'created_by',
        'user_id'
    ];

    public function getCountryDestinations()
    {
        return $this->belongsToMany(Country::class, 'quote_country_destinations', 'quote_id', 'country_id');
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    
    public function getSeason(){
    	return $this->hasOne(Season::class, 'id' ,'season_id');
    }
    
    public function getSalePerson(){
    	return $this->hasOne(User::class, 'id' ,'sale_person_id');
    }

    public function getQuoteDetails()
    {
        return $this->hasMany(QuoteDetail::class,'quote_id','id');
    }

    function getBrand() {
        return $this->hasOne(Brand::class,'id', 'brand_id' );
    }

    function getHolidayType() {
        return $this->hasOne(HolidayType::class,'id', 'holiday_type_id' );
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    function getSalePersonCurrency() {
        return $this->hasOne(Currency::class, 'id', 'sale_person_currency_id');
    }
    
    function getBookingCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
    
    public function getPaxDetail()
    {
        return $this->hasMany(QuotePaxDetail::class, 'quote_id', 'id');
    }

    public function getQuoteUpdateDetail()
    {
        return $this->hasOne(QuoteUpdateDetail::class, 'foreign_id', 'id')->where('status','quotes');
    }

    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'quote_id', 'id');
    }
    
    public function getLeadPassengerNationality()
    {
        return $this->hasOne(Country::class, 'id', 'lead_passsenger_nationailty_id');
    }

    public function getLeadPassengerResidentIn()
    {
        return $this->hasOne(Country::class, 'id', 'lead_passenger_resident');
    }

    public function getCommissionCriteria(){
    	return $this->hasOne(CommissionCriteria::class, 'id' ,'commission_criteria_id');
    }

    public function getCommission(){
    	return $this->hasOne(Commission::class, 'id' ,'commission_id');
    }

    public function getCommissionGroup(){
    	return $this->hasOne(CommissionGroup::class, 'id' ,'commission_group_id');
    }

    public function getNationality(){
    	return $this->hasOne(Country::class, 'id' ,'lead_passsenger_nationailty_id');
    }

    public function getQuotelogs()
    {
        return $this->hasMany(QuoteLog::class, 'quote_id', 'id')->orderBy('id','DESC');
    }

    /**
     * The groups that belong to the shop.
    */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }
    
    public function getBookingFormatedStatusAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 'booked':
                return '<h5><span class="badge badge-success">Booked</span></h5>';
                break;
            case 'quote':
                return '<h5><span class="badge badge-info">Quote</span></h5>';
                break;
            case 'cancelled':
                return '<h5><span class="badge badge-danger">Cancelled</span></h5>';
                break;
        }
        
        return $status;
    }
    
    public function getFormatedBookingDateAttribute()
    {
        if($this->booking_date == null){
            return "-";
        }
        return date('d/m/Y', strtotime($this->booking_date));
    }
    
    public function getDepartureDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function getReturnDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }

    public function getFormatedCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }
    
    public function getDocFormatedCreatedAtAttribute()
    {
        return date('d M Y', strtotime($this->created_at));
    }
    
    public function getFormatedDeletedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->deleted_at));
    }

    public function getFormatedDateOfBirthAttribute()
    {
        return Carbon::parse($this->lead_passenger_dbo)->format('d/m/Y');
    }
    
    public function getVersionAttribute()
    {
        return  'UFG-'.rand(23, 200).''.Str::random(5).' '.date('d/m/Y', strtotime(now())).' By '.Auth::user()->name; 
    }

    // public function getHasUserEditAttribute()
    // {
    //     $checkUserExist = $this->getQuoteUpdateDetail()->where('user_id','!=',Auth::id())->exists();
    //     if($checkUserExist){
    //         return "";
    //         // return "<i class='fa fa-lock'  style='font-size:15px;'></i>";
    //     }
    // }

    public function setRevelantQuoteAttribute($value)
    {
        $this->attributes['revelant_quote'] = json_encode($value);
    }
    
    public function getRevelantQuoteAttribute($value)
    {
        return json_decode($value);
    }

    public function getStoredTextAttribute( $value ) {
        return json_decode($value);
    }
    
    public function setStoredTextAttribute( $value ) {
        $this->attributes['stored_text'] = json_encode($value);
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

    public function setCommissionAmountInSalePersonCurrencyAttribute( $value ) {
        $this->attributes['commission_amount_in_sale_person_currency'] = str_replace( ',', '', $value );
    }

    public function setSellingPriceOcrAttribute( $value ) {
        $this->attributes['selling_price_ocr'] = str_replace( ',', '', $value );
    }

    public function setBookingAmountPerPersonInOspAttribute( $value ) {
        $this->attributes['booking_amount_per_person_in_osp'] = str_replace( ',', '', $value );
    }

    public function setDepartureDateAttribute( $value ) {
        $this->attributes['departure_date']   = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));

    }

    public function setReturnDateAttribute( $value) {
        $this->attributes['return_date']   = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
}
