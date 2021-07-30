<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDocument extends Model
{
    protected $fillable = [
        'user_id',
        'quote_id',
        'data',
    ];
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
    
    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }
    
}
