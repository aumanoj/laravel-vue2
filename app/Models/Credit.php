<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable=[
        'fun_tool_id',
         'provider_id',
         'fun_tool_name',
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
}
