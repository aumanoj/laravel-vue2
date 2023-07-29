<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Auth;
use App\Models\TblOrderDetail;
use Illuminate\Contracts\Session\Session as SessionSession;
Use Session;
use App\Models\Manufacturer;
use App\Models\Models;
use App\Models\Network;
use App\Models\TblOrder;

use App\Models\Tool;
use App\Models\Enabletool;
use App\Models\Supplier;
use App\Models\OrderComment;
use Illuminate\Support\Facades\Auth;
use URL;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use \App\DhruFusion\DhruFusion;
use App\UnlockBase\UnlockBase;
use DB;

class DashBoardController extends Controller
{
    public function index()
    {
		$user= Session::get('clients');
    	if ($user)
    	{
			$orderDetail = TblOrderDetail::with('Manufacturer','Tool')
				->join('tbl_orders','tbl_orders.order_id','tbl_order_details.order_id')
				->where('tbl_orders.email', $user)
				->where('tbl_orders.pay_status',1)
				->where('tbl_orders.insert_time','>','2021-03-04 12:24:25')
				->get();

			return view('dashboard.index', [
				'orderDetails' => $orderDetail
			]);
    	}
    	return redirect('/');
    }

    public function edit($id)
    {
    	$orderDetail = TblOrderDetail::with('Manufacturer')
			->with('Model')
			->with('Network')
			->with('customPriceTool')
			->join('tbl_orders','tbl_orders.order_id','tbl_order_details.order_id')
			->where('id', $id)
			->where('status',1)
			->first();

		if ($orderDetail)
		{
			//return view('dashboard.edit', [
			//	'orders' => $orderDetail]);

			return response()->json(['data' => $$orderDetail]);
		}
    }

   	public function update(Request $request, $id, $imei)
    {
		//print_r($request->toArray()); exit;
		$request->validate([
			'imei_code' => 'required|min:15'
		]);

		$order = TblOrderDetail::find($id);
		$tool = Enabletool::where('tool_id',$order->tool_id)->first();
		
		$order_id = $id;
		$orderID = $id;
		// print_r($order);exit;
		try { 
		
    	if ($order)
    	{
			//$order->imei_code = $request->imei_edit;
			// $order->prd = $request->prd;
			$order->update($request->all());

			/**** Order process code start here ******/

			if ($tool->auto_process == 1) {
				$tools = Tool::where('tool_id',$order->tool_id)->first();
	        	$toolName = $tools->tool_name;
	        	if ($tools->provider_id == 3) {
			          $dataArray['pid']   = $order_id;
			          $dataArray['IMEI']  = $order->imei_code;
			          $dataArray['Tool']  = $tools->tool_id;
			          $OrderRow['model_id'] = $order->model_id;
			          $dataArray["Network"] = $order->network_id;
			          $dataArray["Mobile"] =  $order->model_id;
			          $dataArray["Email"] = 'info@unlockninja.com';
			          //$apii = new UnLock();
			         // exit;
			          $XML = UnlockBase::CallAPI('PlaceOrder', $dataArray);
			          //echo '<pre>'; print_r($XML); exit;
			          //exit;
			          //$edata = $funObj->tbl_general_configuration();
			          if (is_string($XML)){
			          	$Data = simplexml_load_string($XML);
          				$Data = (array) $Data;
			          /* Parse the XML stream */
			          //echo 'hello i am in code'; exit;
			            //$Data = UnlockBase::ParseXML($XML);
			            //echo '<pre>'; print_r($Data); exit;
			            if (is_array($Data)){
			                    if (isset($Data['Error'])){
			                              $data = 'Failed'; 
			                              $data .= $Data['Error']; 
			                              $order->unlock_status = 'Failed';
			                              $order->unlock_msg = $Data['Error'];
			                              $order->save();
			                    }else{    
			                              $data = 'Waiting'; 
			                              $data .= $Data['ID']; 
			                              $data .= $Data['Success'];
			                              $order->unlock_status = 'Waiting';
			                              $order->unlock_id = $Data['ID'];
			                              $order->unlock_msg = $Data['Success'];
			                              $order->Codes = $Data['Codes'];
			                              $order->save();

			                    } 
			                    $manualprocess = '';
			                    $manualprocess = "Used Tool - $tool_id - $toolName <br>";
			                    $manualprocess .= "Response - $data <br>"; 
			                    DB::table('order_comments')->insert(['order_id'=>$orderID,'comment'=>$manualprocess,'created'=>NOW()]);
			                   // echo $data; exit;
			            } 
			          }  
			          
			        }else{
			          $suppliers = Supplier::where('id',$tools->provider_id)->first();
			          //echo '<pre>'; print_r($suppliers->toArray()); exit;
			          //echo 'heelo i am in code'; exit;
			          define("REQUESTFORMAT", "JSON"); 
			          define('DHRUFUSION_URL', $suppliers->url);
			          define("USERNAME", $suppliers->username);
			          define("API_ACCESS_KEY", $suppliers->api_key); 
			          $api = new DhruFusion();
			          $api->debug = true;
			          $para['IMEI'] = $order->imei_code;
			          $para['ID'] = $orderID;
			          $Data = $api->action('placeimeiorder', $para);
			          echo '<PRE>';
			          print_r($Data);
			          echo '</PRE>'; 
			          	if (!empty($Data)){  
			                          if (isset($Data['ERROR'])){
			                              $data = 'Failed'; 
			                              $data .= $Data['ERROR'][0]['MESSAGE'];   
			                              $order->unlock_status = 'Failed';
			                              $order->unlock_msg = $Data['ERROR'][0]['MESSAGE'];
			                              $order->save();
			                          }else{
			                              $data = 'Waiting'; 
			                              $data .= $Data['SUCCESS'][0]['REFERENCEID']; 
			                              $data .= $Data['ERROR'][0]['MESSAGE']; 
			                              //$dddd = $Data['SUCCESS'];
			                              $order->unlock_status = 'Waiting';
			                              $order->unlock_id = $Data['SUCCESS'][0]['REFERENCEID'];
			                              $order->unlock_msg = $Data['SUCCESS'][0]['MESSAGE'];
			                               $order->save();
			                          }

			            // $array = Array(); 
			            // echo '<pre>'; print_r($dddd); exit;            
			            //$data = implode(',',$dddd);
			            //exit;
			            $manualprocess = '';
			            $manualprocess = "Used Tool - $tool_id - $toolName <br>";
			            $manualprocess .= "Response - $data <br>"; 
			            DB::table('order_comments')->insert(['order_id'=>$orderID,'comment'=>$manualprocess,'created'=>NOW()]);             

			          	}

			    	} 
				
			}
			/**** Order process code end here ******/
    	}

    	}
        catch(\Exception $e)
        {
            $msg = $e->getMessage();
            
        }

		return redirect('/dashboard')->with('success', 'IMEI updated successfully !');    	
    }

    //Update using pages by pages
    /*public function update(Request $request)
    {
    	$request->validate([
			'imei' => 'required|min:15'
		]);

		$order = TblOrderDetail::find($request->order_id);
		if ($order)
		{
			$order->imei_code = $request->imei;
			$order->save();
		}

		return redirect('dashboard');
    }*/
}
