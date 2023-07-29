<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblOrderDetail extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
		'imei_code','prd',
    ];
    
    public function Manufacturer()
    {
    	return $this->belongsTo('App\Models\Manufacturer','manu_id','manu_id');
    }

    public function FunManufacturer()
    {
        return $this->belongsTo('App\Models\FunManufacturer','fun_manu_id','manu_id');
    }

    public function Model()
    {
    	return $this->belongsTo('App\Models\Models','model_id','model_id');
    }

    public function Network()
    {
    	return $this->belongsTo('App\Models\Network','network_id','network_id');
    }

    /*public function customPriceTool()
    {
    	return $this->belongsTo('App\Models\CustomPriceTool','tool_id','tool_id');
    }*/

    public function TblOrders()
    {
        return $this->belongsTo('App\Models\TblOrder','order_id','order_id');
    }
    public function Tool()
    {
    	return $this->belongsTo('App\Models\Tool','tool_id','tool_id');
    }

    public function OrderComment()
    {
        return $this->hasMany('App\Models\OrderComment','order_id','order_id');
    }

    public function FunCredit()
    {
        return $this->belongsTo('App\Models\FunCredit','tool_id','fun_tool_id')
        ->leftJoin('tbl_order_details','tool_id','fun_credits.fun_tool_id');;
    }

    public function CustomPriceTool()
    {
        return $this->belongsTo('App\Models\CustomPriceTool','tool_id','tool_id');
    }
//     public function orderUsers()
//     {
//     	return $this->belongsTo('App\OrderUser','order_id','email');
//     }
}
