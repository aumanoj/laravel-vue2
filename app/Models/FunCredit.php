<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunCredit extends Model
{
    use HasFactory;

    protected $fillable=[
        'tool_id',
         'provider_id',
         'tool_name',
         'api_price',
         'selling_price',
         'mrp',
         'summary',
         'detail_summary',
         'estimated_time',
         'guaranted_time',
         'instruction',
         'is_sip',
         'is_imei',
         'unlock_type',
    ];


   /* public function suppliers()
    {
    	return $this->belongsTo('App\Models\Supplier','provider_id','id');
    } */
}
