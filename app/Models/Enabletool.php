<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enabletool extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    
    protected $fillable = [
        'brand_id', 'model_id', 'country_id', 'network_id', 'tool_id','model_type','country_type','network_type', 'auto_process', 'status'
    ];


    public function Manufacturer()
    {
    	return $this->belongsTo('App\Models\Manufacturer','manu_id','id');
    }

    public function Tool()
    {
    	return $this->belongsTo('App\Models\Tool','tool_id','tool_id');
    }
}
