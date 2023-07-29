<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enabletool;
use App\Models\Manufacturer;
use App\Models\Models;
use App\Models\CountryRegion;
use App\Models\Network;
use App\Models\Tool;
use DB;

class ToolsSelectionsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tool-selections-list|tool-selections-create|tool-selections-edit|tool-selections-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tool-selections-create', ['only' => ['create','store']]);
         $this->middleware('permission:tool-selections-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tool-selections-delete', ['only' => ['destroy']]);
    }
	
    public function index(Request $request)
    {
        $enabletool = EnableTool::leftjoin('manufacturers', 'manufacturers.manu_id','=','enabletools.brand_id')
         ->leftjoin('tools', 'tools.tool_id', '=', 'enabletools.tool_id')
           // ->join('tools',DB::raw('tools.id = enabletools.tool_id)'))
            ->select('enabletools.id as toolID','manufacturers.manu_name as brandname as brandname', 'enabletools.auto_process as autoprocess','enabletools.created as createdate', 'tools.tool_name')
            ->groupby('toolID', 'brandname','autoprocess', 'createdate')
            ->orderBy('createdate','asc');
        
        $enabletool = $enabletool->paginate(50);

        return response()->json($enabletool);
        

    }

    public function search(Request $request){

		$enabletool = EnableTool::leftjoin('manufacturers', 'manufacturers.manu_id','=','enabletools.brand_id')
         ->leftjoin('tools', 'tools.tool_id', '=', 'enabletools.tool_id')
            ->select('enabletools.id as toolID','manufacturers.manu_name as brandname as brandname', 'enabletools.auto_process as autoprocess','enabletools.created as createdate', 'tools.tool_name')
            ->groupby('toolID', 'brandname','autoprocess', 'createdate')
            ->orderBy('createdate','desc');
        
        if ($request->get('search') && !empty($request->search))
        {
            
            $enabletool = $enabletool->where('tools.tool_name', 'like','%'.$request->search.'%')
                ->where('manufacturers.manu_name', 'like', '%'.$request->search.'%')->paginate(100);
                return response()->json($enabletool);
        }
        
        $enabletool = $enabletool->paginate(50);
        return response()->json($enabletool);

	}
    

    public function create()
    {
        $brand = Manufacturer::where('status',1)->orderBy('manu_name')->get();
        //$model = Models::where('status',1)->orderBy('model_num')->get();
        $country = CountryRegion::orderBy('country_name')->get();
        //$network = Network::where('status',1)->orderBy('network_name')->get();
        $tool = Tool::where('tool_name','<>', '')->orderBy('tool_name')->get();

        return response()->json(array(
        	'manufacturers' => $brand,
        	//'models' => $model,
        	'countries' => $country,
        	//'networks' => $network,
        	'tools' => $tool,
        ));
    }

    public function store(Request $request)
    {        
        $request->validate([
			'tool_id' => 'required',
			'brand_id' => 'required',
			'model_type' => 'required',
			'country_type' => 'required',
            'network_type' => 'required'
        ]);


        $toolID = json_encode($request->tool_id);
        $toolID = str_replace('"', '', $toolID);
        $toolID = str_replace('[','',$toolID);
        $toolID = str_replace(']','',$toolID);


        $modelID = json_encode($request->model_id);
        $modelID = str_replace('"', '', $modelID);
        $modelID = str_replace('[','',$modelID);
        $modelID = str_replace(']','',$modelID);


        $countryID = json_encode($request->country_id);
        $countryID = str_replace('"', '', $countryID);
        $countryID = str_replace('[','',$countryID);
        $countryID = str_replace(']','',$countryID);


        $networkID = json_encode($request->network_id);
        $networkID = str_replace('"', '', $networkID);
        $networkID = str_replace('[','',$networkID);
        $networkID = str_replace(']','',$networkID);


        $user = auth()->user();

        $enabletools = new Enabletool;
        $enabletools->brand_id = $request->brand_id;
        $enabletools->model_id = $modelID;
        $enabletools->country_id = $countryID;
        $enabletools->network_id = $networkID;
        $enabletools->model_type = $request->model_type;
        $enabletools->country_type = $request->country_type;
        $enabletools->network_type = $request->network_type;
        $enabletools->tool_id = $toolID;
        if ($request->auto_process == "1")
        {
            $enabletools->auto_process = 1    ;
        }
        else
        {
            $enabletools->auto_process = 0;
        }
        //  $enabletools->created_by = $user->id;
        //  $enabletools->modified_by = $user->id;
        $enabletools->status = $request->status;
        $enabletools->save();

        //return redirect('/admin/enable_tools')->with('success', 'Brand Rule Added Successfully!');
    }
    
    public function edit($id)
    {
        $tools = Enabletool::find($id);
        $brand = Manufacturer::where('status',1)->orderBy('manu_name')->get();
        $model = Models::where('status',1)
            ->where('manu_id',$tools->brand_id)
            ->orderBy('model_num')->get();
        $country = CountryRegion::orderBy('country_name')->get();
        //$network = Network::where('status',1)->orderBy('network_name')->get();
        $toollist = Tool::where('tool_name','<>', '')->orderBy('tool_name')->get();

        // $network = Network::where('status',1)
        //         // ->whereRaw("FIND_IN_SET(country_id,'.$tools->country_id.')")
        //         ->get();
        
        $network = Network::where('status',1)
            ->whereIn('country_id',explode(",",$tools->country_id))
            ->orderBy('network_name')->get();


        return response()->json(array(
        'tools' => $tools,
        'manufacturers' => $brand,
        'models' => $model,
        'countries' => $country,
        'networks' => $network,
        'toollist' => $toollist
        ));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'tool_id' => 'required',
            'brand_id' => 'required',
            'model_type' => 'required',
            'country_type' => 'required',
            'network_type' => 'required'
        ]);

        $toolID="";
        $modelID="";
        $countryID="";
        $networkID="";

        if (isset($request->tool_id) && !empty($request->tool_id))
        {
            $toolID = json_encode($request->tool_id);
            $toolID = str_replace('"', '', $toolID);
            $toolID = str_replace('[','',$toolID);
            $toolID = str_replace(']','',$toolID);
        }
        if (isset($request->model_id) && !empty($request->model_id))
        {
            $modelID = json_encode($request->model_id);
            $modelID = str_replace('"', '', $modelID);
            $modelID = str_replace('[','',$modelID);
            $modelID = str_replace(']','',$modelID);
        }
        if (isset($request->country_id) && !empty($request->country_id))
        {
            $countryID = json_encode($request->country_id);
            $countryID = str_replace('"', '', $countryID);
            $countryID = str_replace('[','',$countryID);
            $countryID = str_replace(']','',$countryID);
        }
        if (isset($request->network_id) && !empty($request->network_id))
        {
            $networkID = json_encode($request->network_id);
            $networkID = str_replace('"', '', $networkID);
            $networkID = str_replace('[','',$networkID);
            $networkID = str_replace(']','',$networkID);
        }

        //$user = auth()->user();

        $enabletools = Enabletool::find($id);
        $enabletools->brand_id = $request->brand_id;
        $enabletools->model_type = $request->model_type;
        $enabletools->country_type = $request->country_type;
        $enabletools->network_type = $request->network_type;
        if ($modelID != "") 
        {
            $enabletools->model_id = $modelID;
        }
        if ($countryID != "") 
        {
            $enabletools->country_id = $countryID;
        }
        if ($networkID != "") 
        {
            $enabletools->network_id = $networkID;
        }
        if ($toolID !="") 
        {
            $enabletools->tool_id = $toolID;
        }
        if ($request->auto_process == "1")
        {
            $enabletools->auto_process = 1    ;
        }
        else
        {
            $enabletools->auto_process = 0;
        }
        //$enabletools->modified_by = $user->id;
        $enabletools->status = $request->status;
        $enabletools->save();

        //return redirect('/admin/enable_tools')->with('update', 'Brand Rule detail updated successfully!');
    }
    
}
