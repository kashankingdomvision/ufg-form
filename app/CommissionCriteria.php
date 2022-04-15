<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionCriteria extends Model
{
    protected $fillable = [
        'name',
        // 'commission_id',    
        'percentage',    
        // 'commission_group_id',    
        'brand_id',    
        'holiday_type_id',    
        'currency_id',    
        'season_id',   
        'user_id'
    ]; 

    public function getSeasons()
    {
        return $this->belongsToMany(Season::class, 'commission_criteria_seasons', 'commission_criteria_id', 'season_id')->withTimestamps();
    }

    function getCommission() {
        return $this->hasOne(Commission::class, 'id', 'commission_id');
    }

    function getCommissionGroups() {
        return $this->belongsToMany(CommissionGroup::class, 'commission_criteria_groups', 'commission_criteria_id', 'commission_group_id')->withTimestamps();
    }
    
    function getCurrencies() {
        return $this->belongsToMany(Currency::class, 'commission_criteria_currencies', 'commission_criteria_id', 'currency_id')->withTimestamps();
    }
    
    function getBrands() {
        return $this->belongsToMany(Brand::class, 'commission_criteria_brands', 'commission_criteria_id', 'brand_id')->withTimestamps();
    }
    
    public function getHolidayTypes()
    {
        return $this->belongsToMany(HolidayType::class, 'commission_criteria_holiday_types', 'commission_criteria_id', 'holiday_type_id')->withTimestamps();
    }
    
    // return $this->hasOne(Currency::class,'id', 'currency_id');
    // return $this->hasOne(CommissionGroup::class, 'id', 'commission_group_id');
    // return $this->hasOne(HolidayType::class, 'id', 'holiday_type_id');
    // return $this->hasOne(Brand::class,'id', 'brand_id');
}
