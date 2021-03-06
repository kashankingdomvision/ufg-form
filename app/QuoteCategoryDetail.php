<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteCategoryDetail extends Model
{
    protected $fillable = [

        'quote_id',
        'quote_detail_id',
        'category_id',
        'type',
        'label',
        'value',
        'multiple',
        'data',
        'inline',
        'min',
        'max',
        'subtype',
        'toggle'
    ];
}
