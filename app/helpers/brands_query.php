<?php
	function brands_query($brandName = '')
	{
		$brand = \App\Models\Manufacturer::orderBy('priority_number','desc')
			->orderBy('manu_name')
			->where('status',1);
			
		if (strlen($brandName) > 0)
		{
			$brand = $brand->where('manu_name','=',$brandName);
		}
		$brand = $brand->get();
		return $brand;
	}
?>