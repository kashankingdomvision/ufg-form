<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteBehalfUser extends Model
{
    protected $fillable = [
        'user_id',
        'quote_id',
        'behalf_user_id',
    ];
}
