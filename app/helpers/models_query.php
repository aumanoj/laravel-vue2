<?php
	function models_query($brand = 0, $priority = 0)
	{
		$model = \App\Models\Models::orderBy('priority_number','desc')
			->orderBy('model_num','asc')
			->where('status',1)
			->orderBy('model_num');

		if ($brand > 0)
		{
			$model = $model->where('manu_id', $brand);
		}
		if ($priority > 0)
		{
			 $model = $model->where('priority_number','>',0);
			//$model = $model->join('top_models','top_models.model_id','=',"models.model_id");
		}
		else
		{
			$model = $model->where('priority_number',0);
		}
		$model = $model->get();

		return $model;
	}
?>