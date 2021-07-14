<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'season_id',
        'booking_currency_id',
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
                return '<span class="badge badge-success">active</span>';
                break;
            case '0':
                return '<span class="badge badge-dark">not-active</span>';
                break;
        }
        
        return $status;
    }

    public function getDetails()
    {
        return $this->hasMany(TemplateDetail::class, 'template_id', 'id');
    }

}
