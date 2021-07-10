<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class QuoteLog extends Model
{

    protected $fillable = [
        'quote_id', 'version_no', 'data', 'log_no'
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
        $model_name = 'App\\'.$modelName;
        return $model_name::where('id', $id)->get();
    }
    
    
    public function setLogNoAttribute($value)
    {
        $this->attributes['log_no'] = $value + 1;
    }
    

}
