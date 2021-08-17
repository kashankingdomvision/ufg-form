<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDetialPackage extends Model
{
    protected $fillable = [
        'quote_id',
        'package_val',
    ];
    
    
    public function getQuoteDetail()
    {
        return $this->hasMany(QuoteDetail::class, 'package_key', 'id');
    }
}
