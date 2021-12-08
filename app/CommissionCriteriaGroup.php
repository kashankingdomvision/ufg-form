<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionCriteriaGroup extends Model
{
    protected $fillable = [
        'commission_criteria_id',    
        'commission_group_id',    
    ];
}
