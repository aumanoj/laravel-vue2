<?php
    function enabletools_query($brandID = 0,$modelID = 0,$countryID = 0,$networkID = 0)
    {
        /*$enabletool = \App\Models\Enabletool::join('tools',DB::raw('FIND_IN_SET(tools.tool_id, enabletools.tool_id)'),'>',DB::raw("'0'"))
            ->orderBy('created','desc')
            ->where('status',1);

        if ($brandID > 0)
        {
            $enabletool = $enabletool->whereRaw('FIND_IN_SET('.$brandID.',enabletools.brand_id)');
        }
        if ($modelID > 0)
        {
            $enabletool = $enabletool->whereRaw('FIND_IN_SET('.$modelID.',enabletools.model_id)');
        }
        if ($countryID > 0)
        {
            $enabletool = $enabletool->whereRaw('FIND_IN_SET('.$countryID.',enabletools.country_id)');
        }
        if ($networkID > 0)
        {
            $enabletool = $enabletool->whereRaw('FIND_IN_SET('.$networkID.',enabletools.network_id)');
        } */

        $enabletool = \App\Models\Enabletool::join('tools',DB::raw('FIND_IN_SET(tools.tool_id, enabletools.tool_id)'),'>',DB::raw("'0'"))
            ->orderBy('created','desc')
            ->where('status',1);

            if ($brandID > 0)
            {
                $enabletool = $enabletool->whereRaw('FIND_IN_SET('.$brandID.',enabletools.brand_id)');
            }
            if ($modelID > 0)
            {
                $enabletool = $enabletool->whereRaw('(( enabletools.model_type = 2 AND FIND_IN_SET('.$modelID.',enabletools.model_id) ) OR ( enabletools.model_type = 3 AND NOT FIND_IN_SET('.$modelID.',enabletools.model_id) ) OR ( enabletools.model_type = 1))');
            }
            if ($countryID > 0)
            {
                $enabletool = $enabletool->whereRaw('(( enabletools.country_type = 2 AND FIND_IN_SET('.$countryID.',enabletools.country_id) ) OR ( enabletools.country_type = 3 AND NOT FIND_IN_SET('.$countryID.',enabletools.country_id) ) OR ( enabletools.country_type = 1))');
            }
            if ($networkID > 0)
            {
                $enabletool = $enabletool->whereRaw('(( enabletools.network_type = 2 AND FIND_IN_SET('.$networkID.',enabletools.network_id) ) OR ( enabletools.network_type = 3 AND NOT FIND_IN_SET('.$networkID.',enabletools.network_id) ) OR ( enabletools.network_type = 1))');
            } 
           /* $enabletool = $enabletool->whereRaw('enabletools.brand_id = 113 and (( enabletools.model_type = 2 AND FIND_IN_SET(8303,enabletools.model_id) ) OR ( enabletools.model_type = 3 AND NOT FIND_IN_SET(8303,enabletools.model_id) ) OR ( enabletools.model_type = 1)) AND (( enabletools.country_type = 2 AND FIND_IN_SET(146,enabletools.country_id) ) OR ( enabletools.country_type = 3 AND NOT FIND_IN_SET(146,enabletools.country_id) ) OR ( enabletools.country_type = 1)) AND (( enabletools.network_type = 2 AND FIND_IN_SET(356,enabletools.network_id) ) OR ( enabletools.network_type = 3 AND NOT FIND_IN_SET(356,enabletools.network_id) ) OR ( enabletools.network_type = 1))'); */
        $enabletool = $enabletool->get();
        return $enabletool;
	}
?>