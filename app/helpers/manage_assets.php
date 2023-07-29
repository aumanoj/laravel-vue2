<?php
	function manage_assets($slug)
	{
		$asset = \App\Models\Asset::where('slug',$slug)
			->where('status','active')->first();
			
		return $asset;
	}
?>