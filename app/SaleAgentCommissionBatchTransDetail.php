<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleAgentCommissionBatchTransDetail extends Model
{
    protected $table = 'sac_batch_trans_details';

    protected $fillable = [

        'sac_batch_id',
        'type',
    ];
}
