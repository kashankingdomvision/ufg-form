<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateDetail extends Model
{
    protected $fillable = [ 
        'template_id', 'category_id', 'supplier_id', 'product_id', 'booking_method_id', 'booked_by_id', 'supervisor_id', 
        'supplier_currency_id', 'booking_type_id', 'date_of_service', 'time_of_service', 'booking_date', 'booking_due_date', 
        'service_details', 'booking_reference', 'comments', 'estimated_cost', 'markup_amount', 'markup_percentage', 'selling_price',
        'profit_percentage','estimated_cost_bc', 'selling_price_bc', 'markup_amount_bc', 'added_in_sage',
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
}
