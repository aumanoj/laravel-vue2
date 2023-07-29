<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Models;
use App\Models\ModelContent;
use App\Models\Network;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\Brand;
use App\Models\Tool;
use DB;
use \App\DhruFusion\DhruFusion;
use App\UnlockBase\UnlockBase;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;

class CronController extends Controller
{
    public function confirm_wating_orders_gsmfather(){
    	
    	$orderDetails = DB::table('tbl_order_details')
            ->join('tbl_orders', 'tbl_order_details.order_id', '=', 'tbl_order_details.order_id')
            ->join('tools', 'tbl_order_details.tool_id', '=', 'tools.tool_id')
            ->join('manufacturers', 'tbl_order_details.manu_id', '=', 'manufacturers.manu_id')
            ->join('models', 'tbl_order_details.model_id', '=', 'models.model_id')
            ->join('suppliers', 'tools.provider_id', '=', 'suppliers.id')
            ->select('tbl_order_details.*','tbl_orders.email','suppliers.url','suppliers.username','suppliers.api_key','suppliers.api_secret','tools.provider_id','manufacturers.manu_name','models.model_num')
            ->where('tbl_order_details.unlock_status','Waiting')
            ->where('tools.provider_id',2)
            ->groupBy('tbl_order_details.order_id')
            ->get();

           
    	foreach ($orderDetails as $key => $orderDetail) {
    		//echo '<pre>'; print_r($orderDetail); exit;
    		
    		$unlock_status = 'Waiting';
    		$unlock_code = '';
    		$manualprocess = '';

    		define("REQUESTFORMAT", "JSON"); 
	        define('DHRUFUSION_URL', $orderDetail->url);
	        define("USERNAME", $orderDetail->username);
	        define("API_ACCESS_KEY", $orderDetail->api_key); 
	        $api = new DhruFusion();
	        $api->debug = true;
	        $para['ID'] = $orderDetail->order_id;
	        $Data = $api->action('getimeiorder', $para);
	        echo '<PRE>';
        	print_r($Data);
        	echo '</PRE>'; 
	        if(!empty($Data['ERROR'][0]['CODE']) || !empty($Data['SUCCESS'][0]['CODE'])) { 
                    if (isset($Data['ERROR'])){
				       $unlock_code = $Data['ERROR'][0]['CODE'];
				       $unlock_status = 'Failed';
				       
				    }
				    
				    if (isset($Data['SUCCESS']) && $Data['SUCCESS'][0]['STATUS'] == 4){
				        $unlock_code = $Data['SUCCESS'][0]['CODE'];
				        $unlock_status = 'Delivered';
				    }else {
				        $unlock_status = 'Unavailable';
				    }

				    $updateOrderDetail = TblOrderDetail::where('order_id', '=', $orderDetail->order_id)->update(['unlock_status' => $unlock_status,'unlock_code'=> $unlock_code]);

				    if($Data['SUCCESS'][0]['STATUS'] == 4){
							$tool_available = 'Yes';
						}else {
							$tool_available = 'No';
						}
	                $tool_ids = $gdata['tool_id'];
					$toolName = $gdata['fun_tool_name'];;
					$dataa = $unlock_status;
					 

					$manualprocess .= "Waiting Order <br>";
					$manualprocess .= "Used Tool - $tool_ids - $toolName <br>";
					$manualprocess .= "Response - $dataa <br>";
					$manualprocess .= "Tool Available - $tool_available <br>";
					DB::table('order_comments')->insert(['order_id'=>$orderDetail->order_id,'comment'=>$manualprocess,'created'=>NOW()]);

					if ($updateOrderDetail) {
						if($Data['SUCCESS'][0]['STATUS'] == 4){
							$emailTemplate = EmailTemplate::where('alias','delivered')->first();
				    		$baseURL = url('');
				    		$unlockCode = $unlock_code;
				    		$email = $orderDetail->email;
					        $msg = $emailTemplate->content;
					        $msg = str_replace('&lt;&lt;imei&gt;&gt;',$orderDetail->imei_code,$msg);
					        $msg = str_replace('&lt;&lt;Brand&gt;&gt;',$orderDetail->manu_name,$msg);
					        $msg = str_replace('&lt;&lt;Model&gt;&gt;',$orderDetail->model_num,$msg);
					        $msg = str_replace('#baseurl#',$baseURL,$msg);
					        $msg = str_replace('&lt;&lt;unlock code&gt;&gt;',$unlockCode,$msg);
					        $sub = $emailTemplate->subject;
					        $sub = str_replace('<<Brand>>',$orderDetail->manu_name,$sub);
					        $sub = str_replace('<<Model>>',$orderDetail->model_num,$sub);
					        $emailTemplate->subject = $sub;
					        //echo '<pre>'; print_r($emailTemplate->toArray()); exit;        
					        if ($emailTemplate)
					        {
					            $chk = Mail::send([], ['orderDetail' => $orderDetail, 'emailTemplate' => $emailTemplate,'msg' => $msg], function($message) use($orderDetail, $emailTemplate, $msg){
					                $message->subject($emailTemplate->subject);
					                $message->to($orderDetail->email);
					                //$message->bcc($emailTemplate->bcc);
					                //$message->cc($emailTemplate->cc);
					                //$message->replyTo($emailTemplate->reply_to);
					                $message->returnPath($emailTemplate->from);
					                $message->from($emailTemplate->from);
					                $message->setBody($msg,"text/html");
					            });
					            echo $chk; exit;
				    		//echo $orderDetail->url; exit;
				    		}
				    		exit;

						}
					} 
					

	        } 
    	}
    }

    public function confirm_wating_orders_unlockseller(){
    	
    	$orderDetails = DB::table('tbl_order_details')
            ->join('tbl_orders', 'tbl_order_details.order_id', '=', 'tbl_order_details.order_id')
            ->join('tools', 'tbl_order_details.tool_id', '=', 'tools.tool_id')
            ->join('manufacturers', 'tbl_order_details.manu_id', '=', 'manufacturers.manu_id')
            ->join('models', 'tbl_order_details.model_id', '=', 'models.model_id')
            ->join('suppliers', 'tools.provider_id', '=', 'suppliers.id')
            ->select('tbl_order_details.*','tbl_orders.email','suppliers.url','suppliers.username','suppliers.api_key','suppliers.api_secret','tools.provider_id','manufacturers.manu_name','models.model_num')
            ->where('tbl_order_details.unlock_status','Waiting')
            ->where('tools.provider_id',1)
            ->groupBy('tbl_order_details.order_id')
            ->get();

           
    	foreach ($orderDetails as $key => $orderDetail) {
    		//echo '<pre>'; print_r($orderDetail); exit;
    		
    		$unlock_status = 'Waiting';
    		$unlock_code = '';
    		$manualprocess = '';

    		define("REQUESTFORMAT", "JSON"); 
	        define('DHRUFUSION_URL', $orderDetail->url);
	        define("USERNAME", $orderDetail->username);
	        define("API_ACCESS_KEY", $orderDetail->api_key); 
	        $api = new DhruFusion();
	        $api->debug = true;
	        $para['ID'] = $orderDetail->order_id;
	        $Data = $api->action('getimeiorder', $para);
	        echo '<PRE>';
        	print_r($Data);
        	echo '</PRE>'; 
	        if(!empty($Data['ERROR'][0]['CODE']) || !empty($Data['SUCCESS'][0]['CODE'])) { 
                    if (isset($Data['ERROR'])){
				       $unlock_code = $Data['ERROR'][0]['CODE'];
				       $unlock_status = 'Failed';
				       
				    }
				    
				    if (isset($Data['SUCCESS']) && $Data['SUCCESS'][0]['STATUS'] == 4){
				        $unlock_code = $Data['SUCCESS'][0]['CODE'];
				        $unlock_status = 'Delivered';
				    }else {
				        $unlock_status = 'Unavailable';
				    }

				    $updateOrderDetail = TblOrderDetail::where('order_id', '=', $orderDetail->order_id)->update(['unlock_status' => $unlock_status,'unlock_code'=> $unlock_code]);

				    if($Data['SUCCESS'][0]['STATUS'] == 4){
							$tool_available = 'Yes';
						}else {
							$tool_available = 'No';
						}
	                $tool_ids = $gdata['tool_id'];
					$toolName = $gdata['fun_tool_name'];;
					$dataa = $unlock_status;
					 

					$manualprocess .= "Waiting Order <br>";
					$manualprocess .= "Used Tool - $tool_ids - $toolName <br>";
					$manualprocess .= "Response - $dataa <br>";
					$manualprocess .= "Tool Available - $tool_available <br>";
					DB::table('order_comments')->insert(['order_id'=>$orderDetail->order_id,'comment'=>$manualprocess,'created'=>NOW()]);

					if ($updateOrderDetail) {
						if($Data['SUCCESS'][0]['STATUS'] == 4){
							$emailTemplate = EmailTemplate::where('alias','delivered')->first();
				    		$baseURL = url('');
				    		$unlockCode = $unlock_code;
				    		$email = $orderDetail->email;
					        $msg = $emailTemplate->content;
					        $msg = str_replace('&lt;&lt;imei&gt;&gt;',$orderDetail->imei_code,$msg);
					        $msg = str_replace('&lt;&lt;Brand&gt;&gt;',$orderDetail->manu_name,$msg);
					        $msg = str_replace('&lt;&lt;Model&gt;&gt;',$orderDetail->model_num,$msg);
					        $msg = str_replace('#baseurl#',$baseURL,$msg);
					        $msg = str_replace('&lt;&lt;unlock code&gt;&gt;',$unlockCode,$msg);
					        $sub = $emailTemplate->subject;
					        $sub = str_replace('<<Brand>>',$orderDetail->manu_name,$sub);
					        $sub = str_replace('<<Model>>',$orderDetail->model_num,$sub);
					        $emailTemplate->subject = $sub;
					        //echo '<pre>'; print_r($emailTemplate->toArray()); exit;        
					        if ($emailTemplate)
					        {
					            $chk = Mail::send([], ['orderDetail' => $orderDetail, 'emailTemplate' => $emailTemplate,'msg' => $msg], function($message) use($orderDetail, $emailTemplate, $msg){
					                $message->subject($emailTemplate->subject);
					                $message->to($orderDetail->email);
					                //$message->bcc($emailTemplate->bcc);
					                //$message->cc($emailTemplate->cc);
					                //$message->replyTo($emailTemplate->reply_to);
					                $message->returnPath($emailTemplate->from);
					                $message->from($emailTemplate->from);
					                $message->setBody($msg,"text/html");
					            });
					            echo $chk; exit;
				    		//echo $orderDetail->url; exit;
				    		}
				    		exit;

						}
					} 
					

	        } 
    	}
    }
}
