<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [ 
        'user_id', 'season_id', 'brand_id', 'currency_id', 'holiday_type_id', 'ref_name', 'ref_no', 'quote_ref', 'lead_passenger', 'sale_person', 'agency', 'agency_name', 'agency_contact',
        'dinning_preference','bedding_preference','pax_no','markup_amount','markup_percentage','selling_price','profit_percentage','selling_currency_oc','selling_price_oc','amount_per_person','rate_type', 
    ];
    
    
    public function getSeason(){
    	return $this->hasOne(Season::class, 'id' ,'season_id');
    }

    public function getQuoteDetails()
    {
        return $this->hasMany(QuoteDetail::class,'quote_id','id');
    }
    
    public function getBookingFormatedStatusAttribute()
    {
        $status = $this->qoute_to_booking_status;
        switch ($status) {
            case 1:
                return '<span class="badge badge-success">Booked</span>';
                break;
            case 0:
                return '<span class="badge badge-dark">Quote</span>';
                break;
        }
        
        return $status;
    }
    function getBrand() {
        return $this->hasOne(Brand::class,'id', 'brand_name' );
    }

    function getHolidayType() {
        return $this->hasOne(HolidayType::class,'id', 'holiday_type_id' );
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'code', 'currency_id');
    }
    
    public function getPaxDetail()
    {
        return $this->hasMany(QuotePaxDetail::class, 'quote_id', 'id');
    }
}
