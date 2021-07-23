<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteUpdateDetail extends Model
{
    protected $fillable = [
        'quote_id', 'user_id'
    ];
}
