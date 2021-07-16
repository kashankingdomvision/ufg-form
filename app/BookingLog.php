<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    protected $fillable = [
        'booking_id',	'version_no',	'data', 'log_no'
    ];
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
    
    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }
    
    public function setLogNoAttribute($value)
    {
        $this->attributes['log_no'] = $value + 1;
    }
    
    public function getQueryData($id, $modelName)
    {
        $model_name = 'App\\'.$modelName;
        return $model_name::where('id', $id)->get();
    }
}
