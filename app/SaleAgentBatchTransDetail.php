<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAgentBatchTransDetail extends Model
{
    protected $table = 'sac_batch_trans_details';

    public $timestamps = false; 

    protected $fillable = [
        
        'sale_person_id',
        'type',
    ];

}
