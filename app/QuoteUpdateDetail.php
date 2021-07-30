<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteUpdateDetail extends Model
{
    protected $fillable = [
        'foreign_id', 'user_id', 'status'
    ];
}
