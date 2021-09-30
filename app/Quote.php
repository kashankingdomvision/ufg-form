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
        'quote_title',
        'commission_id',
        'group_id',
        'user_id',
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
        'lead_passenger_resident',
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
        'is_archive',
        'tas_ref',
        'revelant_quote',
        'transfer',
        'stored_text',
        'markup_type',
    ];
    
    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
 

    public function getQuotelogs()
    {
        return $this->hasMany(QuoteLog::class, 'quote_id', 'id')->orderBy('log_no','DESC');
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
    
    public function getBookingFormatedStatusAttribute()
    {
        $status = $this->booking_status;
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
    
    function getBrand() {
        return $this->hasOne(Brand::class,'id', 'brand_id' );
    }

    function getHolidayType() {
        return $this->hasOne(HolidayType::class,'id', 'holiday_type_id' );
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
    
    function getBookingCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
    
    public function getPaxDetail()
    {
        return $this->hasMany(QuotePaxDetail::class, 'quote_id', 'id');
    }
    
    public function getVersionAttribute()
    {
        return  'UFG-'.rand(23, 200).''.Str::random(5).' '.date('d/m/Y', strtotime(now())).' By '.Auth::user()->name; 
    }

    public function getQuoteUpdateDetail()
    {
        return $this->hasOne(QuoteUpdateDetail::class, 'foreign_id', 'id')->where('status','quotes');
    }

    public function getHasUserEditAttribute()
    {
        $checkUserExist = $this->getQuoteUpdateDetail()->where('user_id','!=',Auth::id())->exists();
        if($checkUserExist){
            return "<i class='fa fa-lock'  style='font-size:15px;'></i>";
        }
    }
    
    public function getBooking()
    {
        return $this->hasOne(Booking::class, 'quote_id', 'id');
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

    public function getCommission(){
    	return $this->hasOne(Commission::class, 'id' ,'commission_id');
    }

    public function getNationality(){
    	return $this->hasOne(Country::class, 'id' ,'lead_passsenger_nationailty_id');
    }

    public function getStoredTextAttribute( $value ) {
        return json_decode($value);
    }
    
    public function setStoredTextAttribute( $value ) {
        $this->attributes['stored_text']    = json_encode($value);
    }
}
