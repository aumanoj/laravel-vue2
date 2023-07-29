<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Models;
use App\Models\Network;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\Tool;
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
use DateTime;
use SimpleXMLElement;
//namespace App\helpers;


class OrdersController extends Controller
{   
  // var $xmlData;
  //var $xmlResult;
  // var $debug;
  // var $action;

  function __construct() {
    $this->client = new \GuzzleHttp\Client();

    $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','show','old_orders','old_orders_show']]);
    $this->middleware('permission:order-create', ['only' => ['create','store']]);
    $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:order-delete', ['only' => ['destroy']]);


  }

  public function index()
  {
    //$orders = TblOrder::with('TblOrderDetails')->paginate(10);
    $orders = TblOrderDetail::with('TblOrders','Tool','Manufacturer','Model','Network')->whereHas('TblOrders', function ($query) {
    return $query->where('pay_status', '=', 1);
    })->where('order_dt_tm','>','2021-03-04 12:24:25')->orderBy('id', 'DESC')->get();//->paginate(2);

    return response()->json($orders);
  }

  public function old_orders()
  {
    //$orders = TblOrder::with('TblOrderDetails')->paginate(10);
    $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders', function ($query) {
      return $query->where('pay_status', '=', 1);
    })->where('order_dt_tm','<','2021-03-04 12:24:25')->orderBy('id', 'DESC')->paginate(100);//->paginate(2);
    //echo '<pre>'; print_r($orders->toArray()); exit;
    return response()->json($orders);
    }


    public function old_orders_show($id)
    {
    //$orders = TblOrder::with('TblOrderDetails')->paginate(10);
      $tools = Tool::all();
    $order = TblOrderDetail::with('TblOrders.orderUsers','FunCredit','Manufacturer','Model','Network')->where('order_id',$id)->get();//->paginate(2);
    //echo '<pre>'; print_r($order->toArray()); exit;
    return response()->json(array('orders'=>$order,'tools'=>$tools));
    }

    public function show($id)
    { 
      //$orders = User::where('id', $id)->first();
      //$tools = Tool::pluck('tool_name','tool_id');
      $tools = Tool::All();
      $OrderComment = OrderComment::where('order_id',$id)->get();
      $order = TblOrderDetail::with('TblOrders.orderUsers','Tool','Manufacturer','Model','Network','Tool','OrderComment')
      ->where('order_id',$id)->get();
      //echo '<pre>'; print_r($tools->toArray()); exit;
      return response()->json(array('orders'=>$order,'tools'=>$tools,'comments'=>$OrderComment));
    }

    public function search(Request $request)
    {

      

      if(isset($request->date) && !empty($request->date)){
        $arr= explode('-',$request->date);
        //echo '<pre>'; print_r($request->date); exit;
        $startDate=date('Y-m-d', strtotime($arr[0]));
        $endDate=date('Y-m-d', strtotime($arr[1]));

       $orderDate = TblOrder::whereDate('insert_time','>=',$startDate,)->whereDate('insert_time','<=',$endDate,)->where('pay_status', 1)->where('insert_time','>','2021-03-04 12:24:25')->count();

      if ($orderDate > 0){
        //echo '<pre>'; print_r($request->date); exit;
        $orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders'])->whereHas('TblOrders' , function ($query) use ($startDate,$endDate) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->whereDate('insert_time','>=',$startDate,)->whereDate('insert_time','<=',$endDate,);
        })->orderBy('id', 'DESC')->get();
        /*$orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','Tool','TblOrders' => function ($query) use ($request) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
         // $query->where('email', $request->search);
         $query->where('order_id', $request->search);
       }])->orderBy('id', 'DESC')->take(1)->get(); */
       return response()->json($orders);
      }
      
      }
      //echo '<pre>'; print_r($startDate); exit;

     // $count = TblOrder::where('email', $request->search)->where('pay_status', 1)->orwhere('order_id', $request->search)->count();
      $emailcount = TblOrder::where('email', $request->search)->where('pay_status', 1)->where('insert_time','>','2021-03-04 12:24:25')->count();
      $ordercount = TblOrder::where('order_id', $request->search)->where('pay_status', 1)->where('insert_time','>','2021-03-04 12:24:25')->count();
      
      $brand = TblOrderDetail::where('manu_id', $request->manu_id)->where('status', 1)->count();
      $imei = TblOrderDetail::where('imei_code', $request->search)->where('status', 1)->count();
      //echo '<pre>'; print_r($brand); exit;

      //$orderDate = TblOrder::whereDate('insert_time','>=',$startDate,)->whereDate('insert_time','<=',$endDate,)->where('pay_status', 1)->where('insert_time','>','2021-03-04 12:24:25')->count();

      if ($emailcount > 0) {
         $orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders'])->whereHas('TblOrders' , function ($query) use ($request) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->where('email', $request->search);
        })->orderBy('id', 'DESC')->take(1)->get();
      } elseif ($ordercount > 0){
        $orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders'])->whereHas('TblOrders' , function ($query) use ($request) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->where('order_id', $request->search);
        })->orderBy('id', 'DESC')->take(1)->get();
        /*$orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders' => function ($query) use ($request) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
         // $query->where('email', $request->search);
         $query->where('order_id', $request->search);
       }])->orderBy('id', 'DESC')->take(1)->get(); */
      } 

      elseif ($brand > 0){
        
        $orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders'])->whereHas('TblOrders' , function ($query) use ($request) {
          
          // $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);

          $query->where('manu_id' ,$request->manu_id);
        })->orderBy('id', 'DESC')->get();

          //$query->where('manu_id' ,$request->manu_id);
      //  })->where('manu_id' ,$request->manu_id)->orderBy('id', 'DESC')->get();


        //echo '<pre>'; print_r($request->manu_id); exit;
        /*$orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders' => function ($query) use ($request) {
          $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
         // $query->where('email', $request->search);
         $query->where('order_id', $request->search);
       }])->orderBy('id', 'DESC')->take(1)->get(); */
      }

      elseif ($imei > 0){
        
        $orders = TblOrderDetail::with(['Tool','Manufacturer','Model','Network','TblOrders'])->whereHas('TblOrders' , function ($query) use ($request) {
          // $query->where('insert_time','>','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          
        })->where('imei_code', 'like', '%'.$request->search.'%')->orderBy('id', 'DESC')->get();
      }
      else{
        $orders = array();
      }
       
      // echo '<pre>'; print_r($orders->toArray()); exit;
       //  ->where('order_dt_tm','>','2021-03-04 12:24:25')
       return response()->json($orders);
      /*$emails=TblOrder::get('email','email');
      echo '<pre>'; print_r($emails->toArray()); exit;
      if(str_contains( $emails,$request->get('search'))){ */
      /*  $orders=TblOrderDetail::with('TblOrders','Tool','Manufacturer','Model','Network','Tool')->get();//->paginate(2);
        $orders = $orders->where('TblOrders.email', $request->search);
       return response()->json($orders); */
      // }


      // if (isset($request->search)){
      
       /*   $orders=TblOrderDetail::with('TblOrders.orderUsers','Tool','Manufacturer','Model','Network','Tool');
          $orders = $orders->where('order_id','like', '%'.$request->search.'%')
           ->orWhere('imei_code','like', '%'.$request->search.'%')
          //->orWhere('email', $request->search)
          //->paginate(2);
          ->get();
          return response()->json($orders); */
      //}
    }


    public function old_search(Request $request)
    {

      if(isset($request->date) && !empty($request->date)){
       $arr= explode('-',$request->date);
       $startDate=date('Y-m-d', strtotime($arr[0]));
       $endDate=date('Y-m-d', strtotime($arr[1]));

       $orderDate = TblOrder::whereDate('insert_time','>=',$startDate,)->whereDate('insert_time','<=',$endDate,)->where('pay_status', 1)->where('insert_time','<','2021-03-04 12:24:25')->count();

      if ($orderDate > 0){
        //echo '<pre>'; print_r($request->date); exit;
        $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders' , function ($query) use ($startDate,$endDate) {
          $query->where('insert_time','<','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->whereDate('insert_time','>=',$startDate,)->whereDate('insert_time','<=',$endDate,);
        })->orderBy('id', 'DESC')->get();
        
       return response()->json($orders);
      }
      
      }
      //echo '<pre>'; print_r($startDate); exit;

     // $count = TblOrder::where('email', $request->search)->where('pay_status', 1)->orwhere('order_id', $request->search)->count();
      $emailcount = TblOrder::where('email', $request->search)->where('pay_status', 1)->count();
      $ordercount = TblOrder::where('order_id', $request->search)->where('pay_status', 1)->count();
      //echo '<pre>'; print_r($ordercount); exit;
      $brand = TblOrderDetail::where('manu_id', $request->manu_id)->where('status', 1)->count();

      $imei = TblOrderDetail::where('imei_code', $request->search)->where('status', 1)->count();

      //echo '<pre>'; print_r($brand); exit;
      
      //echo '<pre>'; print_r($orderDate); exit;
      if ($emailcount > 0) {
         $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders' , function ($query) use ($request) {
          //$query->where('insert_time','<','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->where('email', $request->search);
        })->orderBy('id', 'DESC')->take(1)->get();
      } elseif ($ordercount > 0){
        $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders' , function ($query) use ($request) {
          //$query->where('order_dt_tm','<','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
          $query->where('order_id', $request->search);
        })->orderBy('id', 'DESC')->take(1)->get();
       
      } 
      elseif ($brand > 0){
        
        $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders' , function ($query) use ($request) {
          
          // $query->where('insert_time','<','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
        })->where('manu_id', $request->manu_id)->orderBy('id', 'DESC')->get();

      }

      elseif ($imei > 0){
        
        $orders = TblOrderDetail::with('TblOrders','FunCredit','Manufacturer','Model','Network','CustomPriceTool')->whereHas('TblOrders' , function ($query) use ($request) {
          
          // $query->where('insert_time','<','2021-03-04 12:24:25');
          $query->where('pay_status', 1);
        })->where('imei_code', $request->search)->orderBy('id', 'DESC')->get();

      }
      else{
        $orders = array();
      }
       
       return response()->json($orders);
      
    }

    protected function objToArray($obj)
    {
        // Not an object or array
        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }

        // Parse array
        foreach ($obj as $key => $value) {
            $arr[$key] = $this->objToArray($value);
        }

        // Return parsed array
        return $arr;
    }
   
    public function gettools()
    {     
          $dt = new DateTime();
          $date = $dt->format('Y-m-d H:i:s'); 
          
          try {
            //$XML = $unlock_base->CallAPI('GetTools');
            $XML = UnlockBase::CallAPI('GetTools');
          }
          catch(Exception $e) {
            $XML = $e->getMessage();
          } 
          //echo $XML; exit;

          /*if (is_string($XML)){
            $Data = simplexml_load_string($XML);
          $Data = (array) $Data;
          }   */
          //echo '<pre>'; print_r($Data); exit;

          if (is_string($XML))
          {
            // Load the XML
        //$xmlResponse = simplexml_load_string($response->getBody());

// JSON encode the XML, and then JSON decode to an array.
//$responseArray = json_decode(json_encode($xmlResponse), true);
            /* Parse the XML stream */
            //$Data = $unlock_base->ParseXML($XML);
            $Data = simplexml_load_string($XML);
            $Data = json_decode(json_encode($Data), true);
           //  $Data = get_object_vars($object);
            //$Data = $this->objToArray($Data);
           //$Data = (array) $Data;
           //$Data = new SimpleXMLElement($XML);
           //$Data = new \SimpleXMLElement($XML, 0, true);
           // echo '<pre>'; print_r($Data); exit;
            if (is_array($Data))
            {
              if (isset($Data['Error']))
              {
                /* The API has returned an error */
                return 'API error : ' . htmlspecialchars($Data['Error']);
              }
              else
              {

                DB::table('fun_credits')->where('tool_type', 'UNLOCKBASE')->delete();
                
              /*  mysql_query(" TRUNCATE TABLE `fun_credits` ") or die(mysql_error()); */
                
            
                ///echo '<pre>'; print_r($Data); exit;
                
                foreach ($Data['Group'] as $Group)
                {
                  foreach ($Group['Tool'] as $Tool)
                  {
                      //echo '<pre>'; print_r($Tool); 
                      //echo '<br>';
                   try {
            
                //var_dump($Tool['Message']); exit;
                    //echo '<pre>'; print_r($Tool['Message']); exit;
                    if (!isset($Tool['Message'])) {
                     $Tool['Message'] = '';
                    }

                    if (!isset($Tool['Delivery.Min'])) {
                     $Tool['Delivery.Min'] = '';
                    }

                    if (!isset($Tool['Delivery.Max'])) {
                     $Tool['Delivery.Max'] = '';
                    }

                    if (!isset($Tool['Delivery.LastWeekActual'])) {
                     $LastWeekActualvalue = $Tool['Delivery.LastWeekActual'] = '';
                    }else{
                      $LastWeekActualvalue = $Tool['Delivery.LastWeekActual'];
                    }

                    echo '<pre>'; print_r($Tool); 
                      echo '<br>';
                   
                   /* $Tool['Message'] = isset($Tool['Message']) ? $Tool['Message'] : "";
                   
                    
                    $Tool['Delivery.Min'] = isset($Tool['Delivery.Min']) ? $Tool['Delivery.Min'] : "";
                    
                    $Tool['Delivery.Max'] = isset($Tool['Delivery.Max']) ? $Tool['Delivery.Max'] : ""; */
              
             // $tstp=$s->caltimestamp();
              
              //$LastWeekActualvalue = isset($Tool['Delivery.LastWeekActual']) ? $Tool['Delivery.LastWeekActual'] : '';

                  DB::table('fun_credits')->insert([
                      'fun_group_id' => $Group['ID'],
                      'fun_group_name' => $Group['Name'],
                      'fun_tool_id' => $Tool['ID'],
                      'fun_tool_name' => $Tool['Name'],
                      'fun_tool_credits' => $Tool['Credits'],
                      'fun_tool_type' => $Tool['Type'],
                      'fun_tool_SMS' => $Tool['SMS'],
                      'fun_tool_Message' => $Tool['Message'],
                      'fun_tool_DeliveryMin' => $Tool['Delivery.Min'],
                      'fun_tool_DeliveryMax' => $Tool['Delivery.Max'],
                      'fun_tool_DeliveryUnit' => $Tool['Delivery.Unit'],
                      'fun_tool_RequiresNetwork' => $Tool['Requires.Network'],
                      'fun_tool_RequiresMobile' => $Tool['Requires.Mobile'],
                      'fun_tool_RequiresProvider' => $Tool['Requires.Provider'],
                      'fun_tool_RequiresPIN' => $Tool['Requires.PIN'],
                      'fun_tool_RequiresKBH' => $Tool['Requires.KBH'],
                      'fun_tool_RequiresMEP' => $Tool['Requires.MEP'],
                      'fun_tool_RequiresPRD' => $Tool['Requires.PRD'],
                      'fun_tool_RequiresReference' => $Tool['Requires.Reference'],
                      'fun_tool_RequiresServiceTag' => $Tool['Requires.ServiceTag'],
                      'fun_tool_RequiresType' => $Tool['Requires.Type'],
                      'fun_tool_RequiresLocks' => $Tool['Requires.Locks'],
                      'fun_tool_RequiresSecRO' => $Tool['Requires.SecRO'],
                      'fun_tool_RequiresSN' => $Tool['Requires.SN'],
                      'fun_tool_DeliveryLastWeekActual' => $LastWeekActualvalue,
                      'tstp' => $date,
                      'tool_type' => 'UNLOCKBASE',
                      'tool_type_name' => 'Unlockbase'

                  ]);  

                    }
                    catch(Exception $e) {
                      $XML = $e->getMessage();
                    } 
              
                }
                  //print('</tr>');
                }
                return "";
              }
            }
            else
            {
              /* Parsing error */
              return 'Could not parse the XML stream';
            }
          }
          else
          {
            /* Communication error */
            return 'Could not communicate with the api';
          } 
    }  

    public function gettoolsseller()
    {     
          $dt = new DateTime();
          $date = $dt->format('Y-m-d H:i:s'); 
          $suppliers = Supplier::where('id',1)->first();
          //echo '<pre>'; print_r($suppliers->toArray()); exit;
          //echo 'heelo i am in code'; exit;
          define("REQUESTFORMAT", "JSON"); 
          define('DHRUFUSION_URL', $suppliers->url);
          define("USERNAME", $suppliers->username);
          define("API_ACCESS_KEY", $suppliers->api_key); 
          $api = new DhruFusion();
          $api->debug = true;
          
          $request = $api->action('imeiservicelist');

          DB::table('fun_credits')->where('tool_type_name', 'Unlock Reseller')->delete();
          echo '<PRE>';
          print_r($request);
          echo '</PRE>';
          
          foreach($request['SUCCESS'][0]['LIST']  as $key=>$value){
       // echo 'i am in code'; exit;
         //$fun_group_name = $value['GROUPNAME'];
       // echo '<pre>'; print_r($value);  
        
                $fun_group_name = $value['GROUPNAME']; 
                  foreach($value['SERVICES'] as $keyy=>$valuee){
                      $fun_tool_id = $valuee['SERVICEID']; 
                      $fun_tool_name = $valuee['SERVICENAME']; 
                      $fun_tool_credits = $valuee['CREDIT']; 
                      $fun_tool_DeliveryUnit = $valuee['TIME'];

                      DB::table('fun_credits')->insert([
                      'fun_group_name' => $fun_group_name,
                      'fun_tool_id' => $fun_tool_id,
                      'fun_tool_name' => $fun_tool_name,
                      'fun_tool_credits' => $fun_tool_credits,
                      'fun_tool_DeliveryUnit' => $fun_tool_DeliveryUnit,
                      'tstp' => $date,
                      'tool_type' => 'DHURV',
                      'tool_type_name' => 'Unlock Reseller'

                  ]);   
                      
                      echo $keyy; 
                  }
            
              
            
          }
        
        exit;
          
          
    } 

    public function re_process($tool_id, $order_id, Request $request)
    {   
        //echo $tool_id.'-'.$order_id; exit;
        $tools = Tool::where('tool_id',$tool_id)->first();
        $toolName = $tools->tool_name;
        //echo '<pre>'; print_r($tools->toArray()); exit;
        $orderID = $order_id;
        $order = TblOrderDetail::where('order_id',$order_id)->first();
        //echo $tools->provider_id; exit;
        //echo '<pre>'; print_r($tools->toArray()); exit;
        if ($tools->provider_id == 3) {
          $dataArray['pid']   = $order_id;
          $dataArray['IMEI']  = $order->imei_code;
          $dataArray['Tool']  = $tools->tool_id;
          $OrderRow['model_id'] = $order->model_id;
          $dataArray["Network"] = $order->network_id;
          $dataArray["Mobile"] =  $order->model_id;
          $dataArray["Email"] = 'info@demoninja.com';
          //$apii = new UnLock();
         // exit;
         try {
          $XML = UnlockBase::CallAPI('PlaceOrder', $dataArray);
          }
          catch(Exception $e) {
            $XML = $e->getMessage();
          }  
         // echo $XML; exit;
          //echo '<pre>'; print_r($XML); exit;
          //exit;
          //$edata = $funObj->tbl_general_configuration();
          if (is_string($XML)){
          //$xml = new \SimpleXMLElement($XML, 0, true);  
          //$xml = new SimpleXMLElement($XML);
          //$Data = $xml->xpath('*/item');
          $Data = simplexml_load_string($XML);
          $Data = (array) $Data;
          //echo '<pre>'; print_r($Data); exit;
          //echo $Data['Error']; exit;
          /* Parse the XML stream */
          /*try {
          $Data = UnlockBase::ParseXML($XML);
          }
          catch(Exception $e) {
            $Data = $e->getMessage();
            echo $Data; exit;
          }   */
            
            //echo 'hello i am in code'; exit;
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
                    echo $data; exit;
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
          try {
          $Data = $api->action('placeimeiorder', $para);
          }
          catch(Exception $e) {
            $Data = $e->getMessage();
        } 
          
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
            echo $data; exit;
          }

          }        
    }


    public function order_comment(Request $request)
    {
        $request->validate([
            'order_id' => ['required'],
            'comment' => ['required'],
            
        ]);

        OrderComment::create([
            'order_id' => $request->order_id,
            'comment' => $request->comment,
            
        ]);

    }

    public function verify_email_clear_out(Request $request)
    {
        $threeDate = \Carbon\Carbon::today()->subDays(3);
        
        $tblOrder = TblOrder::select('insert_time','order_id','uuid',
            'fname','lname','email')
            ->where('pay_status',0)
            ->where('verify_email','NONE')
            ->whereDate('insert_time','>=',$threeDate)
            ->get();

        if (count($tblOrder) > 0)
        {
            foreach ($tblOrder as $tOrd)
            {
                if (isset($tOrd->email) && !empty($tOrd->email))
                {
                    $curl = curl_init();
                    curl_setopt_array($curl,array(
                        CURLOPT_URL => 'https://api.clearout.io/v2/email_verify/instant',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '
                            {"email":"'.$tOrd->email.'"}',
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                             "Authorization: Bearer:007320c6e87dea8b243b4eb5baf4ff74:ae9d53b93dccae6685b00ba1e973addcee10ae7e795bb3539274249324ca78e2"
                           // "Authorization: Bearer:".env('CLEAR_OUT_TOKEN')
                        ),
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $resArray = json_decode($response,true);

                    if ($resArray['status'] == 'failed')
                    {
                        echo "Something went wrong";
                        print_r("<br>");
                        print_r($resArray);
                        exit;
                    }
                    if ($err)
                    {
                        $tOrd->verify_email = 'NO';
                        $tOrd->verify_email_reason = $response;
                        $tOrd->verify_email_date = date('Y-m-d H:i:s');
                        $tOrd->update();
                    }
                    else
                    {
                        if ($resArray['data']['sub_status']['code'] == 200)
                        {
                            $tOrd->verify_email = "YES";
                            $tOrd->verify_email_reason = $response;
                            $tOrd->verify_email_date = date('Y-m-d H:i:s');
                            $tOrd->update();                  
                        }
                        else
                        {
                            $tOrd->verify_email = "NO";
                            $tOrd->verify_email_reason = $response;
                            $tOrd->verify_email_date = date('Y-m-d H:i:s');
                            $tOrd->update();
                        }
                    }
                }
            }
        }
        //echo "Data updated for last 3 days.";
    }
}
