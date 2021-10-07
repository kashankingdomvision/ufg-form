<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionCriteriaSeason extends Model
{
    protected $fillable = [
        'commission_id',    
        'season_id'
    ]; 

}
