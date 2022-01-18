<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDetailCountry extends Model
{
    public $timestamps = false;
    
    protected $fillable = [

        'quote_id',
        'quote_detail_id',
        'country_id',
    ];
}
