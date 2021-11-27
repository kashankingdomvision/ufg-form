<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harbour extends Model
{
    protected $fillable = [
        'port_id',
        'name',
    ];
}
