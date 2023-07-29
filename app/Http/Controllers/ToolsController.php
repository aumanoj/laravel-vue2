<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Tool;
use DB;
use Illuminate\Http\Request;
use App\Models\FunCredit;
use App\Events\SendMissingToolIDEmail;

class ToolsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         /*$this->middleware('permission:tool-list|tool-create|tool-edit|tool-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tool-create', ['only' => ['create','store']]);
         $this->middleware('permission:tool-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tool-delete', ['only' => ['destroy']]);*/
    }
    public function index()
    {
        $tools = Tool::leftJoin('fun_credits','fun_credits.fun_tool_id','tools.tool_id')
            ->select('tools.id as id','tools.tool_id as tool_id','tools.tool_name as tool_name','tools.api_price as api_price','tools.selling_price as selling_price','fun_credits.id as fun_credit_id')
            ->orderBy('tools.id','desc')
            ->paginate(50);
        return  response()->json($tools);
    }

    

    public function search(Request $request){

		// if (isset($request->search)){
      
			$tools=tool::orderBy('tool_name')
			->where('tool_name','like', '%'.$request->search.'%')
			->paginate(100);
			return response()->json($tools);
		//}

	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => ['required'],
            'provider_id' => ['required'],
            'tool_name' => ['required'],
            'api_price' => ['required'],
            'selling_price' => ['required'],
            'mrp' => ['required'],
            'summary' => ['required'],
            'estimated_time' => ['required'],
            'guaranted_time' => ['required'],
            
            
        ]);

        Tool::create([
            'tool_id' => $request->tool_id,
            'provider_id'=>$request->provider_id,
            'tool_name' => $request->tool_name,
            'api_price'=> $request->api_price,
            'selling_price'=>$request->selling_price,
            'mrp'=>$request->mrp,
            'summary'=>$request->summary,
            'detail_summary'=>$request->detail_summary,
            'estimated_time'=>$request->estimated_time,
            'guaranted_time'=>$request->guaranted_time,
            'instruction'=>$request->instruction,
            'is_sip'=>$request->is_sip,
            'is_imei'=>$request->is_imei,
            'unlock_type'=>$request->unlock_type
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tool = Tool::with('suppliers')->where('id', $id)->first();
      return response()->json($tool);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'tool_id' => ['required'],
            'provider_id' => ['required'],
            'tool_name' => ['required'],
            'api_price' => ['required'],
            'selling_price' => ['required'],
            'mrp' => ['required'],
            'summary' => ['required'],
            'estimated_time' => ['required'],
            'guaranted_time' => ['required'],
            
            
        ]);
        
        $tool = Tool::find($id);
      $tool->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        //
    }

    Public function missingToolsID()
    {
        event(new SendMissingToolIDEmail());
     
        echo "Check your Email !";

    }

    // public function getToolData($id)
    // {
        
    //     $vendors = DB::table('suppliers')->where('id',$id)->first();
    //     $funCredits = FunCredit::where('tool_type_name',$vendors->suppliar_name)->OrderBy('tool_type')
    //         ->orderBy('fun_tool_id')
    //         ->orderBy('fun_tool_name')
    //         ->get();
    //     $toolOptions = [];
    //     foreach ($funCredits as $funCred)
    //     {
    //         $toolOptions[] = ['id'=>$funCred->fun_tool_id,'text'=> $funCred->fun_tool_id.' - '.$funCred->tool_type.' - '.$funCred->fun_tool_name];
    //     }
    //     return response()->json(['vendors' => $vendors,'funCredits' => $funCredits,'toolOptions' => $toolOptions]);
    // }


    public function getVendors()
{
    $vendors = DB::table('suppliers')->get();
   $funCredits = FunCredit::OrderBy('tool_type')
           ->orderBy('fun_tool_id')
           ->orderBy('fun_tool_name')
           ->get();
       $toolOptions = [];
       foreach ($funCredits as $funCred)
       {
           $toolOptions[] = ['id'=>$funCred->fun_tool_id,'text'=> $funCred->fun_tool_id.' - '.$funCred->tool_type.' - '.$funCred->fun_tool_name];
       }
        //return response()->json(['vendors' => $vendors]);

        return response()->json(['vendors' => $vendors,'funCredits' => $funCredits,'toolOptions' => $toolOptions]);
    }

public function getToolData($vendorID)
{
    
    $funCredits = FunCredit::
	join('tools','tools.tool_id','fun_credits.fun_tool_id')
	->where('tools.provider_id',$vendorID)
	->OrderBy('fun_credits.tool_type')
   	->orderBy('fun_credits.fun_tool_id')
   	->orderBy('fun_credits.fun_tool_name')
      	->get();
$toolOptions = [];
        foreach ($funCredits as $funCred)
        {
            $toolOptions[] = ['id'=>$funCred->fun_tool_id,'text'=> $funCred->fun_tool_id.' - '.$funCred->tool_type.' - '.$funCred->fun_tool_name];
        }

        return response()->json(['funCredits' => $funCredits,'toolOptions' => $toolOptions]);
    }


    public function getApiPrice($toolID){
        $tool = Tool::where('tool_id',$toolID)
            ->where('api_price','>',0)
            ->where('provider_id','>',0)
            ->orderBy('id','desc')
            ->first();

            return response()->json($tool);
    }
}
