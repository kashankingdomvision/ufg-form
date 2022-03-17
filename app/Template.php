<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Template extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'season_id',
        'currency_id',
        'rate_type',
        'markup_type',
        'privacy_status'
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

    public function scopePublic($query)
    {
        return $query->where('privacy_status', 1);
    }

    public function scopePrivate($query)
    {
        return $query->where('user_id', Auth::id())->where('privacy_status', 0);
    }

}
