<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePaxDetail extends Model
{
    protected $fillable = [
        'nationality_id', 'quote_id','full_name','email','contact','date_of_birth','bedding_preference','dinning_preference'
    ];
}
