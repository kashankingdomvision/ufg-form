<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class TemplateDetail extends Model
{
    protected $fillable = [ 
        
        'template_id',
        'category_id',
        'supplier_id',
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
        'refundable_percentage',
        'supplier_currency_id',
        'comments',
        'estimated_cost',
        'markup_amount',
        'markup_percentage',
        'selling_price',
        'profit_percentage',
        'estimated_cost_bc',
        'selling_price_bc',
        'markup_amount_bc',
        'added_in_sage', 
        'time_of_service', 
        'amount_per_person',
        'booking_type_id',
        'parent_id',
        'image',
        'category_details',
        'stored_text',
        'action_date',
    ];

    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
    
    function getSupplierCurrency() {
        return $this->hasOne(Currency::class,  'id' ,'supplier_currency_id');
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

    public function getActionDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function setActionDateAttribute( $value ) {
        $this->attributes['action_date']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
}
