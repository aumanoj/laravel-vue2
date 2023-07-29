<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    
    const CREATED_AT = 'tstp';
    const UPDATED_AT = null;

    public function Model()
    {
    	return $this->belongsTo('App\Models\Models','manu_id','manu_id');
    }
    
}
