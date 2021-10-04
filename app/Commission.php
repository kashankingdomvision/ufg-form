<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'name'
        //'percentage'
    ];

    function getCommissionGroups(){
        return $this->hasMany(CommissionGroup::class, 'commission_id', 'id');
    }
}
