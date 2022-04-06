<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupOwner extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, 'group_owner_id', 'id');
    }
}
