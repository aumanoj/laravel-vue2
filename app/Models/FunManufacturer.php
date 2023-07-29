<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunManufacturer extends Model
{
    
    const CREATED_AT = 'tstp';
    const UPDATED_AT = null;

    public function Model()
    {
    	return $this->belongsTo('App\Models\FunModel','manu_id','manu_id');
    }
    
}
