<?php
	function networks_query($country_id = 0, $top="NO") //$priority = 0)
	{   
		//$network = \App\Models\Network::groupBy('network_name','network_id')
		$network = \App\Models\Network::groupBy('network_name')
			->orderBy('priority_number','desc')
			->orderBy('network_name','asc')
			->where('status',1);  
		if ($country_id > 0)
		{  // echo 'hello i am in code'; exit;
			$network = $network->where('country_id', $country_id);
		}
		//if ($priority > 0)
		if ($top == "YES")
		{
			//$network = $network->where('priority_number','>',0);
			$network = $network->join('top_nets','top_nets.network_id','=',"networks.network_id");
		}
		else
		{
			$network; //= $network->where('priority_number',0);
			//$network = $network->join('top_nets','top_nets.network_id','!=','networks.network_id');
		}
		$network = $network->get();
		return $network;


		$country = \App\Models\Network::groupBy('country_name','country_id')
			//->orderBy('country_priority_number','desc')
			->orderBy('country_name', 'asc')
			->where('status',1)
			->select('networks.country_id','networks.country_name');
		//if ($priority > 0)
		if ($top=="YES")
		{
			$country = $country->join('tbl_top_country','tbl_top_country.country_id','=','networks.country_id');
			//$country = $country->where('country_priority_number','>',0);
		}
		else
		{
			$country = $country->join('tbl_top_country',function($query){
				$query->on('tbl_top_country.country_id','!=','networks.country_id');
			});
			//$country = $country->where('country_priority_number',0);
		}
		$country = $country->get();
		return $country;
	}
?>