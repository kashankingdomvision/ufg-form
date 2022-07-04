<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SACBDetailHistory extends Model
{
    protected $table = 'sac_batch_details';

    protected $fillable = [
        
        'sac_batch_trans_detail_id',                 
        'sac_batch_id',                             
        'booking_id',                            
        'sale_person_id',                          
        'sale_person_currency_id',              
        'commission_amount_in_sale_person_currency', 
        'total_paid_amount_yet',                  
        'outstanding_amount_left',                 
        'pay_commission_amount',                  
        'total_paid_amount',                   
        'total_outstanding_amount',             
        'deposited_amount_value',                    
        'bank_amount_value',                         
        'status'                                    
    ];
}
