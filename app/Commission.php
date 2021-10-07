<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'name',
        'percentage',
        'commission_group_id',
        'brand_id',
        'holiday_type_id',
        'currency_id',
        'season_id',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'commission_seasons', 'commission_id', 'season_id')->withTimestamps();
    }
}
