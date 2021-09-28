<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class QuoteDetailStoredText extends Model
{
    protected $fillable= [
        'stored_text',
        'quote_detail_id',
        'action_date',
    ];


    public function getActionDateAttribute( $value ) {
        return (new Carbon($value))->format('d/m/Y');
    }
    
    public function setActionDateAttribute( $value ) {
        $this->attributes['action_date']    = date('Y-m-d', strtotime(Carbon::parse(str_replace('/', '-', $value))->format('Y-m-d')));
    }
}
