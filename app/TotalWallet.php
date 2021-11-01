<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalWallet extends Model
{
    protected $fillable = [ 
        'supplier_id',
        'amount'
    ];
}
