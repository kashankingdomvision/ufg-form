<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',  'user_id', 'rate_type','ref_no', 'ref_name','quote_ref','lead_passenger',     'brand_id','holiday_type_id',    'sale_person_id',      'season_id',         'agency',   'dinning_preference', 'bedding_preference', 'currency_id',       'pax_no',   'markup_amount',     
         'markup_percentage',   'selling_price', 'profit_percentage',   'selling_currency_oc', 'selling_price_ocr','amount_per_person',  
         "date_of_service", "time_of_service","category_id", "supplier_id","product_id","supervisor_id", "booking_date","booking_due_date","booking_reference","booking_method_id", "booked_by_id", "booking_type","supplier_currency_id","estimated_cost","markup_amount",
        "markup_percentage","selling_price","profit_percentage","selling_price_in_booking_currency","markup_amount_in_booking_currency","added_in_sage","service_details",
        "comments", 
    ];

    public function getCategory()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier');
    }

    function getSupplierCurrency() {
        return $this->hasOne(Currency::class,  'id' ,'supplier_currency_id',);
    }
    
    public function getBookingFinance()
    {
        return $this->hasMany(BookingDetailFinance::class, 'booking_detail_id', 'id');   
    }

    public function getDateOfServiceAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function getBookingDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function getBookingDueDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function setDateOfServiceAttribute( $value ) {
        $this->attributes['date_of_service']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
    
    public function setBookingDateAttribute( $value ) {
        $this->attributes['booking_date']       = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
    
    public function setBookingDueDateAttribute( $value ) {
        $this->attributes['booking_due_date']   = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }    
}
