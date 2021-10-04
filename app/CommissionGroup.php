<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionGroup extends Model
{
    protected $fillable = [
        'commission_id', 
        'name',       
        'percentage',     
    ];
        
    function getCommission() {
        return $this->hasOne(Commission::class, 'id', 'commission_id');
    }

    function getGroup() {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
