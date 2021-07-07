<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class QuoteLog extends Model
{
    protected $fillable = [
        'quote_id',
        'version_no',
        'data',
    ];
    
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
    
    public function getDataAttribute($value)
    {
       return json_decode($value, true);
    }
    
    public function getQueryData($id, $modelName)
    {
        dd($id);
    }

}
