<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Network;
use DB;
use App\Models\Country;

class AjaxController extends Controller
{


    // public function getModelAjax($brand_id=0){

    //     $models = Models::orderby("model_num","asc")
    //                 // ->select('id','name')
    //                 // ->where('brand_id',$brand_id)
    //                 ->where('status',1)
    //                 ->get();

    //     $model_options = '<option value="">Select Model First</option>';

    //     if(!empty($models)){
    //         foreach($models as $model){
    //             $model_options .= '<option value="'.$model->id.'">'.$model->model_num.'</option>';
    //         }
    //     }

    //     echo $model_options;
    //     die;            
  
    // }

    public function getModelAjax($brandID = 0)
    {
    	$modelGT = models_query($brandID,1);
    	$modelEQ = models_query($brandID,0);
        $model_options = '<select id="model_id" name="model_id" class="selectpicker" data-live-search="true" data-live-search-placeholder="Type Model Number">';
            $model_options .= '<option  value=""> Select Model </option>';
    	//$model_options .= '<option value="">Select Model</option>';
        if(count($modelGT) > 0)
        {
            $model_options .= '<option value="1" disabled="true" > ----Top Model---- </option>';
            foreach($modelGT as $model)
            {
                $model_options .= '<option value="'.$model->model_id.'">'.$model->model_num.'</option>';
            }
                  
        }

        if(!empty($modelEQ))
        {
            $model_options .= '<option value="0" disabled="true" > ------------------------ </option>';  
            foreach($modelEQ as $model)
            {
                $model_options .= '<option value="'.$model->model_id.'">'.$model->model_num.'</option>';
            }
        }
        $model_options .= '</select><div class="form-group " id="model-errors" role="alert" style="padding-left: 20px;"></div>';
        echo $model_options;
        die;
    }

    public function getModelList($brandID = 0)
    {
        //return response()->json($brandID);

        $model = Models::select('model_id','model_num')->where('status',1)
            ->where('manu_id',$brandID)
            ->orderBy('model_num')->get();
        return response()->json($model);    
        
    }

    public function getMultipleModelList($brandIds = 0)
    {
        $brandIds = explode(',',$brandIds);
        $model = Models::select('model_id','model_num')
            ->whereIn('manu_id',$brandIds)
            ->where('status',1)
            ->orderBy('model_num')
            ->get();

        return response()->json($model);
    }

    public function getNetworkList($CountryIds = 0)
    {   //..echo $CountryIds; exit
        $CountryIds = explode(',',$CountryIds);
        $network = Network::select('network_id','network_name')->whereIn('country_id', $CountryIds)->where('status',1)->orderBy('network_name')->get();
        return response()->json($network);    
    }

    public function getCountryList()
    {
        $country = Network::select('country_id','country_name')
            ->distinct()
            ->orderBy('country_name')
            ->get();

        return response()->json($country);
    }

    public function getUserCountryList()
    {
        $country = Country::select('id','country_code','country_name')
            ->orderBy('country_name')
            ->get();

        return response()->json($country);
    }

    public function getNetworkAjax($countryID = 0)
    {               
        $networkGT = networks_query($countryID,1);
        $networkEQ = networks_query($countryID,0);

        $network_options = '<select id="network_id" name="network_id" class="selectpicker" data-live-search="true" data-live-search-placeholder="Type Network Name">';
        $network_options .= '<option  value=""> Select Network </option>';

        // $network_options = '<option value="">Select Network</option>';
        //if(!empty($networkGT))
        if(count($networkEQ) > 0)
        {
            $network_options .= '<option value="1" disabled="true">----Top Network----</option>';
            foreach($networkEQ as $network)
            {
                $network_options .= '<option value="'.$network->network_id.'">'.$network->network_name.'</option>';
            }
            $network_options .= '<option value="0" disabled="true">-------------------</option>';
        }
        if(!empty($networkGT))
        {
            foreach($networkGT as $network)
            {
                $network_options .= '<option value="'.$network->network_id.'">'.$network->network_name.'</option>';
            }
        }

        $network_options .= '</select><div class="form-group" id="network-errors" role="alert"></div>';
        echo $network_options;
        die;
    }

    public function getCountryAjax($countryID = 0)
    {               
        $countryGT = countries_query(1);
        $countryEQ = countries_query(0);

        $country_options = '<select class="" id="country_id" onchange="getNetwork();" name="country_id" class="selectpicker" itemprop="name" data-live-search="true" data-live-search-placeholder="" >';
        $country_options .= '<option  value=""> Select Country </option>';

        // $network_options = '<option value="">Select Network</option>';
        //if(!empty($networkGT))
        if(count($countryGT) > 0)
        {
            $country_options .= '<option value="1" disabled="true" style="color: #000000;">----Top Country----</option>';
            foreach($countryGT as $country)
            {
                $country_options .= '<option value="'.$country->country_id.'">'.$country->country_name.'</option>';
            }
            $country_options .= '<option value="0" disabled="true">-------------------</option>';
        }
        if(!empty($countryEQ))
        {
            foreach($countryEQ as $country)
            {
                $country_options .= '<option value="'.$country->country_id.'">'.$country->country_name.'</option>';
            }
        }

        $country_options .= '</select><div class="form-group" id="country-errors" role="alert"></div>';
        echo $country_options;
        die;
    }


    

    public function getallmodeldata(Request $request){
        $term = $request->input('term');
        
        $sqlQuery = "SELECT models.manu_id, models.model_id, models.model_num, manufacturers.manu_name 
        FROM models 
        LEFT JOIN manufacturers 
            ON models.manu_id = manufacturers.manu_id 
        WHERE models.model_num LIKE '$term%'
        limit 10";

        $brandModels = DB::select(DB::raw($sqlQuery));

            $i = 0;
			foreach ($brandModels as $player) {
				$response[$i]['id'] = $player->manu_name . '-' . $player->model_num;
				$response[$i]['label'] = $player->model_num . ' - ' . $player->manu_name;
				$response[$i]['value'] = $player->model_num;                                      
				$i++;
	    }
	    
	    if(!empty($response)){

        echo json_encode($response);
        
        
        } else {
	        echo '-1';
	    }

        // return response()->json($brandModels);
	}
}
