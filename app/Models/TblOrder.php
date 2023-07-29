<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblOrder extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'order_id';

    
    
    protected $fillable = [
        'fname', 'lname', 'email', 'total_amount', 'pay_status', 
        'payment_status', 'payment_type', 'paid_amount', 
        'txn_id', 'payer_email', 'payment_date', 'refund_id', 
        'user_ip_address', 'payment_time', 'paymethod', 
        'stripe_details', 'brand_id', 'modal_id', 'country_id', 
        'network_id', 'tool_id', 'api_price', 'selling_price', 
        'delivery_time', 'unlock_status', 'unlock_msg', 
        'unlock_id', 'unlock_code', 'imei_code', 'prd', 'status',
    ];
    
    public function orderUsers()
    {
    	return $this->belongsTo('App\Models\OrderUser','email','email');
    }
}
