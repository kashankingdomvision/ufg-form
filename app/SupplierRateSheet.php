<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class SupplierRateSheet extends Model
{
    protected $fillable = [
        'supplier_id',
        'season_id',
        'file'
    ];

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }
        
    public function getSeason(){
    	return $this->hasOne(Season::class, 'id' ,'season_id');
    }

    public function getImagePathAttribute()
    {
        return url(Storage::url($this->file));
    }
}
