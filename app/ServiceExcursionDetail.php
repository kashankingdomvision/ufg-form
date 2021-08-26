<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ServiceExcursionDetail extends Model
{
    protected $fillable = [
        'booking_detail_id',
        'name',
        'description',              
        'date',           
        'time',     
        'quantity',            
        'refrence',           
        'confirmed_with_supplier',          
        'note',  
    ];

    
    public function setDateAttribute( $value ) {
        $this->attributes['date']   =  isset($value) && !is_null($value) ?  date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d'))) : null;
    } 
}
