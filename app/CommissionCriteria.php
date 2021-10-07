<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionCriteria extends Model
{
    protected $fillable = [
        'commission_id',    
        'percentage',    
        'commission_group_id',    
        'brand_id',    
        'holiday_type_id',    
        'currency_id',    
        'season_id',   
        'user_id'
    ]; 

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'commission_criteria_seasons', 'commission_criteria_id', 'season_id')->withTimestamps();
    }

    function getCommission() {
        return $this->hasOne(Commission::class, 'id', 'commission_id');
    }

    function getCommissionGroup() {
        return $this->hasOne(CommissionGroup::class, 'id', 'commission_group_id');
    }

    
    function getCurrency() {
        return $this->hasOne(Currency::class,'id', 'currency_id');
    }

    function getBrand() {
        return $this->hasOne(Brand::class,'id', 'brand_id');
    }

    public function getHolidayType()
    {
        return $this->hasOne(HolidayType::class, 'id', 'holiday_type_id');
    }
}
