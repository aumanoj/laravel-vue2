<?php

require_once('API.php');

		$dataArray['pid']   = 2515;
        $dataArray['IMEI']  = '6788777878hhgv';
        $dataArray['Tool']  = '738';
        $OrderRow['model_id'] = 45;
        $dataArray["Network"] = 23;
        $dataArray["Mobile"] =  7;
        $dataArray["Email"] = 'info@unlockninja.com';
        //$apii = new UnlockBase();
       // exit;
        $XML = UnlockBase::CallAPI('PlaceOrder', $dataArray);
