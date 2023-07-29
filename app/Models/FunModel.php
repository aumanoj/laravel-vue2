<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunModel extends Model
{
    const CREATED_AT = 'tstp';
    const UPDATED_AT = null;

    protected $fillable=[
        'manu_id','model_id','madel_num','description','meta_title','meta_keyword','meta_desc','priority_number','status'
        
    ];

    public function funmanufacturers()
    {
    	return $this->belongsTo('App\Models\FunManufacturer','manu_id','manu_id');
    }
}
