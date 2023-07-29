<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportTopOrder;
use App\Models\TblOrderDetail;
use App\Models\EnableTool;
use DB;
use Excel;
use App\Exports\GenerateReportExport;
use Session;

class ReportController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:report-list|report-create|report-edit|report-delete', ['only' => ['topOrdersView','orderDetailReport','orderDetailReportExcel','orderDetailReportData','orderDetailReportContents','getReportData']]);
         $this->middleware('permission:report-create', ['only' => ['create','topOrdersSave']]);
         $this->middleware('permission:report-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:report-delete', ['only' => ['destroy']]);
    }

    public function topOrdersSave(Request $request)
    {
        $query = DB::table('report_top_orders')->delete();
        $max = DB::table('tbl_order_details')->max('id');
        $getRecord = $max-10000;
        
        $query = DB::table('tbl_order_details')
            ->select('tbl_order_details.manu_id as manu_id','tbl_order_details.model_id as model_id','tbl_order_details.network_id as network_id',
                'tbl_order_details.country_id as country_id',
                'manu_name','model_num','network_name',
                'country_name')
            ->selectRaw('COUNT(tbl_order_details.manu_id) as qty')
            ->selectRaw('max(order_dt_tm) as orderDtTm')
            ->leftJoin('manufacturers','tbl_order_details.manu_id','=','manufacturers.manu_id')
            ->leftJoin('models','tbl_order_details.model_id','=','models.model_id')
            ->leftJoin('networks','tbl_order_details.network_id','=','networks.network_id')
            ->where('tbl_order_details.id','>=',$getRecord)
            ->groupBy('manu_id','model_id','network_id','tbl_order_details.country_id')     
            ->orderBy('qty','desc')
            ->get();
        $i = 0;
        foreach($query as $q)
        {
            if (empty($q->manu_id))
            {
                $manuID = 0;
            }
            else
            {
                    $manuID = $q->manu_id;    
            }
            if (empty($q->model_id))
            {
                $modelID  = 0;
            }
            else
            {
                $modelID  = $q->model_id;
            }
            if (empty($q->network_id))
            {
                $networkID = 0;
            }
            else
            {
                $networkID = $q->network_id;
            }
            if (empty($q->country_id))
            {
                $countryID = 0;
            }
            else
            {
                $countryID = $q->country_id;
            }
            if (empty($q->orderDtTm))
            {
                $lp = '';
            }
            else
            {
                $lp = $q->orderDtTm;
            }
                
            $manuName = $q->manu_name;
            $modelName =  $q->model_num;
            $networkName = $q->network_name;
            $countryName = $q->country_name;
            $qty = $q->qty;
                
            $manuName = str_replace("'","''",$manuName);
            $modelName = str_replace("'","''",$modelName);
            $networkName = str_replace("'","''",$networkName);
            $countryName = str_replace("'","''",$countryName);
                
            $queryTool = DB::table('enabletools')
                ->select('enabletools.tool_id as toolID',
                    'tool_name','selling_price','api_price', 'mrp') 
                ->leftJoin('tools','tools.tool_id','=','enabletools.tool_id')
                ->whereRAW('FIND_IN_SET('.$manuID.',brand_id)')
                ->whereRaw('FIND_IN_SET('.$modelID.',model_id)')
                ->whereRaw('FIND_IN_SET('.$networkID.', network_id)')
                ->first();

            $toolID = 'x';
            $toolName = 'x';
            $apiPrice = 0;
            $unitPrice = 0;
            $mrp = 0;
            if ($queryTool)
            {
                $toolID = $queryTool->toolID;
                $toolName = $queryTool->tool_name;
                $apiPrice = $queryTool->api_price;
                $unitPrice = $queryTool->selling_price;
                $mrp = $queryTool->mrp;
            }
                
            $topOrder = new ReportTopOrder();
            $topOrder->top_manu_id = $manuID;
            $topOrder->top_manu_name = $manuName;
            $topOrder->top_model_id = $modelID; 
            $topOrder->top_model_name = $modelName;
            $topOrder->top_network_id = $networkID;
            $topOrder->top_network_name = $networkName;
            $topOrder->top_country_id = $countryID;
            $topOrder->top_country_name = $countryName;
            $topOrder->top_qty = $qty;
            $topOrder->top_tool_id = $toolID;
            $topOrder->service_provider = $toolName;
            $topOrder->unit_price = $unitPrice;
            $topOrder->api_price = $apiPrice;
            $topOrder->mrp = $mrp;
            $topOrder->last_updated_on = $lp;
            $topOrder->save();
            
            set_time_limit(30);
        }
    }

    public function topOrdersView(Request $request)
    {
        $topOrder = ReportTopOrder::OrderBy('top_qty','desc')
            ->paginate(100);

        return response()->json($topOrder);
    }

    
    public function getReportData(Request $request)
    {
        $getdata = 0;

        return response()->json($getdata);
    }

    public function orderDetailReport(Request $request)
    {
        $request->session()->forget('report.manu_id');
        $request->session()->forget('report.model_id');
        $request->session()->forget('report.country_id');
        $request->session()->forget('report.network_id');
        $request->session()->forget('report.user_country_id');
        $request->session()->forget('report.order_status');
        $request->session()->forget('report.payment_status');
        $request->session()->forget('report.order_reference_status');
        $request->session()->forget('report.chk_brand');
        $request->session()->forget('report.chk_model');
        $request->session()->forget('report.chk_country');
        $request->session()->forget('report.chk_network');
        $request->session()->forget('report.start_date');
        $request->session()->forget('report.end_date');
        $request->session()->forget('report.exl');
     
        
        
        if (empty($request->start_date) || empty($request->end_date))
        {
            $start_date = \Carbon\Carbon::today()->subDays(60);
            $end_date = \Carbon\Carbon::today();
        }
        else
        {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }
        $request->session()->put('report.manu_id',$request->manu_id);
        $request->session()->put('report.model_id',$request->model_id);
        $request->session()->put('report.country_id',$request->country_id);
        $request->session()->put('report.network_id',$request->network_id);
        $request->session()->put('report.user_country_id',$request->user_country_id);
        $request->session()->put('report.order_status',$request->order_status);
        $request->session()->put('report.payment_status',$request->payment_status);
        $request->session()->put('report.order_reference_status',$request->order_reference_status);
        $request->session()->put('report.chk_brand',$request->chk_brand);
        $request->session()->put('report.chk_model',$request->chk_model);
        $request->session()->put('report.chk_country',$request->chk_country);
        $request->session()->put('report.chk_network',$request->chk_network);
        //$request->session()->put('report.start_date',$request->start_date);
        //$request->session()->put('report.end_date',$request->end_date);
        $request->session()->put('report.start_date',$start_date);
        $request->session()->put('report.end_date',$end_date);
        $request->session()->put('report.exl',$request->exl);
        Session::save();
        return response()->json($request->all());
        //print_r($request->toArray()); exit;
    }

    public function orderDetailReportExcel(Request $request)
    {
        $manu_id = $request->manu_id;
        $model_id = $request->model_id;
        $country_id = $request->country_id;
        $network_id = $request->network_id;
        $user_country_id = $request->user_country_id;
        $order_status = $request->order_status;
        $payment_statusA = $request->payment_status;
        $order_reference_status = $request->order_reference_status;
        $chk_brand = $request->chk_brand;
        $chk_model = $request->chk_model;
        $chk_country = $request->chk_country;
        $chk_network = $request->chk_network;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $exl = $request->exl;

        $payment_status = [];
        $pay_status = [];       
        foreach ($payment_statusA as $pay)
        {
            if ($pay == 0 || $pay == 1)
            {
                $pay_status[] = $pay;
            }
            else
            {
                $payment_status[] = $pay; 
            }
        }
        
        $data['manu_id'] = $manu_id;
        $data['model_id'] = $model_id;
        $data['country_id'] = $country_id;
        $data['network_id'] = $network_id;
        $data['user_country_id'] = $user_country_id;
        $data['order_status'] = $order_status;
        $data['payment_status'] = $payment_status;
        $data['pay_status'] = $pay_status;
        $data['order_reference_status'] = $order_reference_status;
        $data['chk_brand'] = $chk_brand;
        $data['chk_model'] = $chk_model;
        $data['chk_country'] = $chk_country;
        $data['chk_network'] = $chk_network;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['exl'] = $exl;
            
        Excel::download(new GenerateReportExport($data),'OrderDetail.xlsx');        
    }
    
    public function orderDetailReportData(Request $request)
    {
        $manu_id = $request->session()->get('report.manu_id');
        $model_id = $request->session()->get('report.model_id');
        $country_id = $request->session()->get('report.country_id');
        $network_id = $request->session()->get('report.network_id');
        $user_country_id = $request->session()->get('report.user_country_id');
        $order_status = $request->session()->get('report.order_status');
        $payment_statusA = $request->session()->get('report.payment_status');

        $payment_status = [];
        $pay_status = [];
        
        foreach ($payment_statusA as $pay)
        {
            if ($pay == 0 || $pay == 1)
            {
                $pay_status[] = $pay;
            }
            else
            {
                $payment_status[] = $pay; 
            }
        }
        
        $order_reference_status = $request->session()->get('report.order_reference_status');
        $chk_brand = $request->session()->get('report.chk_brand');
        $chk_model = $request->session()->get('report.chk_model');
        $chk_country = $request->session()->get('report.chk_country');
        $chk_network = $request->session()->get('report.chk_network');
        $start_date = $request->session()->get('report.start_date');
        $end_date = $request->session()->get('report.end_date');
        $exl = $request->session()->get('report.exl');
        
        if ($exl == 'YES')
        {
            $data['manu_id'] = $manu_id;
            $data['model_id'] = $model_id;
            $data['country_id'] = $country_id;
            $data['network_id'] = $network_id;
            $data['user_country_id'] = $user_country_id;
            $data['order_status'] = $order_status;
            $data['payment_status'] = $payment_status;
            $data['pay_status'] = $pay_status;
            $data['order_reference_status'] = $order_reference_status;
            $data['chk_brand'] = $chk_brand;
            $data['chk_model'] = $chk_model;
            $data['chk_country'] = $chk_country;
            $data['chk_network'] = $chk_network;
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['exl'] = $exl;

            return Excel::download(new GenerateReportExport($data),'OrderDetail.xlsx');
        }
        else
        {
            $tblOrder = \App\helpers\GenerateReportQuery::getGenerateReportQuery($manu_id,$model_id,$country_id,$network_id,$user_country_id,$order_status,$payment_status,$pay_status,$order_reference_status,$chk_brand,$chk_model,$chk_country,$chk_network,$start_date,$end_date);
            
            $isGroup = $tblOrder['isGroup'];
            $tblOrder = $tblOrder['tblOrder'];
            if (empty($start_date) || empty($end_date))
            {
                $isDateEnter = 'NO';
            }
            else
            {
                $isDateEnter = 'YES';
            }

            return view('report.generate-report',[
                'tblOrder' => $tblOrder,
                'is_group' => $isGroup,
                'isDateEnter' => $isDateEnter,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
        }
    }

    public function orderDetailReportContents(Request $request)
    {
        $manu_id = $request->session()->get('report.manu_id');
        $model_id = $request->session()->get('report.model_id');
        $country_id = $request->session()->get('report.country_id');
        $network_id = $request->session()->get('report.network_id');
        $user_country_id = $request->session()->get('report.user_country_id');
        $order_status = $request->session()->get('report.order_status');
        $payment_statusA = $request->session()->get('report.payment_status');

        $payment_status = [];
        $pay_status = [];
        
        foreach ($payment_statusA as $pay)
        {
            if ($pay == 0 || $pay == 1)
            {
                $pay_status[] = $pay;
            }
            else
            {
                $payment_status[] = $pay; 
            }
        }
        
        $order_reference_status = $request->session()->get('report.order_reference_status');
        $chk_brand = $request->session()->get('report.chk_brand');
        $chk_model = $request->session()->get('report.chk_model');
        $chk_country = $request->session()->get('report.chk_country');
        $chk_network = $request->session()->get('report.chk_network');
        $start_date = $request->session()->get('report.start_date');
        $end_date = $request->session()->get('report.end_date');
        $exl = $request->session()->get('report.exl');
        
        
        $tblOrder = \App\helpers\GenerateReportQuery::getGenerateReportQuery($manu_id,$model_id,$country_id,$network_id,$user_country_id,$order_status,$payment_status,$pay_status,$order_reference_status,$chk_brand,$chk_model,$chk_country,$chk_network,$start_date,$end_date);
            
        $isGroup = $tblOrder['isGroup'];
        $tblOrder = $tblOrder['tblOrder'];

        return response()->json([
            'isGroup' => $isGroup,
            'tblOrder' => json_decode($tblOrder,true),
        ]);
    }
}