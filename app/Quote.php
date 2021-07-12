<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;

class Quote extends Model
{
    protected $fillable = [ 
        'user_id',
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
        'selling_currency_oc',
        'selling_price_ocr',
        'amount_per_person',
        'rate_type',
        'booking_status',
        'booking_date'
    ];
    
    public function getQuotelogs()
    {
        return $this->hasMany(QuoteLog::class, 'quote_id', 'id');
    }
    
    public function getSeason(){
    	return $this->hasOne(Season::class, 'id' ,'season_id');
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
                return '<span class="badge badge-success">Booked</span>';
                break;
            case 'quote':
                return '<span class="badge badge-dark">Quote</span>';
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
    
    
}
