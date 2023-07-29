<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelContent extends Model
{
    use HasFactory;

    const CREATED_AT = 'tstp';
    const UPDATED_AT = null;

    protected $fillable=[
        'manu_id','model_id','madel_num','description','meta_title','meta_keyword','meta_desc','heading_title',
        
    ];

    public function manufacturers()
    {
    	return $this->belongsTo('App\Models\Manufacturer','manu_id','manu_id');
    }
}
