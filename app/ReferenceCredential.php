<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceCredential extends Model
{
    protected $fillable = [
        'code', 'access_token', 'refresh_token', 'type',
    ];
}
