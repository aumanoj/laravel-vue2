<?php
	function countries_query($priority = 0)
	{
		$country = \App\Models\Network::groupBy('country_name','networks.country_id')
			//->orderBy('country_priority_number','desc')
			->orderBy('country_name', 'asc')
			->where('status',1)
			->select('networks.country_id','country_name');

		if ($priority > 0)
		{
			//$country = $country->where('country_priority_number','>',0);
			$country = $country->join('tbl_top_country','tbl_top_country.country_id','=','networks.country_id');
		}
		else
		{
			$country = $country->where('country_priority_number',0);
		}
		$country = $country->get();
		return $country;
	}
?>