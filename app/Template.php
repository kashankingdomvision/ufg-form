<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'season_id',
        'currency_id',
    ];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getSeason()
    {
        return $this->hasOne(Season::class, 'id', 'season_id');
    }

    public function getFormatedCreatedAtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));

    }

    public function getFormatedStatusAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case '1':
                return '<span class="badge badge-success">Active</span>';
                break;
            case '0':
                return '<span class="badge badge-dark">Inactive</span>';
                break;
        }
        
        return $status;
    }

    function getCurrency() {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function getDetails()
    {
        return $this->hasMany(TemplateDetail::class, 'template_id', 'id');
    }

}
