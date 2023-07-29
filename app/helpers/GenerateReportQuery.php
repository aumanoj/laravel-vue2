<?php
namespace App\helpers;

Class GenerateReportQuery
{
	public static function getGenerateReportQuery($manu_id=[],$model_id=[],$country_id=[],$network_id=[],$user_country_id=[],$order_status=[],$payment_status=[],$pay_status=[],$order_reference_status=[],$chk_brand=0,$chk_model=0,$chk_country=0,$chk_network=0,$start_date='',$end_date='')
	{
		$tblOrder = \DB::table('tbl_order_details');


		if ($chk_brand == 1 || $chk_model == 1 || $chk_network == 1 || $chk_country == 1)
		{
			$tblOrder = $tblOrder->select(
				'manufacturers.manu_name','models.model_num',
				'networks.country_name','networks.network_name',
				\DB::raw('sum(quantity) as qty'),
				\DB::raw('round(sum(if(paid_amount > 0,paid_amount,0)),2) as paid'),
				\DB::raw('round(sum(if(paid_amount < 0,paid_amount,0)),2) as refund'));
		}
		else
		{
			//$tblOrder = $tblOrder->select('tbl_orders.order_id','tbl_orders.email','tbl_order_details.imei_code','tools.tool_name','tbl_orders.insert_time','tbl_orders.user_ip_address','tbl_orders.country_code','paid_amount','tbl_orders.organization');
			$tblOrder = $tblOrder->select('tbl_order_details.id as id','tbl_orders.order_id','manufacturers.manu_name', 'models.model_num', 'networks.country_name', 'networks.network_name','paid_amount','tbl_orders.insert_time');
		}

		$tblOrder = $tblOrder->join('tbl_orders','tbl_orders.order_id','tbl_order_details.order_id')
			->leftJoin('manufacturers','tbl_order_details.manu_id','manufacturers.manu_id')
			->leftJoin('models','tbl_order_details.model_id','models.model_id')
			->leftJoin('networks','tbl_order_details.network_id','networks.network_id')
			->leftJoin('tools','tbl_order_details.tool_id','tools.tool_id')
			->where('tbl_orders.order_total','>',0);
		if (is_array($order_reference_status) && count($order_reference_status) > 0)
		{
			//$tblOrder = $tblOrder->whereIn('tbl_orders.source',$order_reference_status);
			//$tblOrder = $tblOrder->WhereIn('tbl_orders.medium',$order_reference_status);
		}

		$isSelDate = 0;
		$isGroup = 0;
		if (is_array($manu_id) && count($manu_id) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_order_details.manu_id',$manu_id);
		}

		if (is_array($model_id) && (count($model_id) > 0))
		{
			$tblOrder = $tblOrder->whereIn('tbl_order_details.model_id',$model_id);
		}
		if (is_array($network_id) && count($network_id) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_order_details.network_id',$network_id);
		}
		if (is_array($country_id) && count($country_id) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_order_details.country_id',$country_id);
		}
		if (is_array($user_country_id) && count($user_country_id) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_orders.country_code',$user_country_id);
		}
		if (is_array($order_status) && count($order_status) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_order_details.unlock_status',$order_status);
		}
		if (is_array($payment_status) && count($payment_status) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_orders.payment_status',$payment_status);
		}

		if (is_array($pay_status) && count($pay_status) > 0)
		{
			$tblOrder = $tblOrder->whereIn('tbl_orders.pay_status',$pay_status);
		}
		
		if (!empty($start_date) && strtotime($start_date))
		{
			$tblOrder = $tblOrder->whereDate('tbl_orders.insert_time','>=',date('Y-m-d',strtotime($start_date)));
			$isSelDate = 1;
		}

		if (!empty($end_date) && strtotime($end_date))
		{
			$tblOrder = $tblOrder->whereDate('tbl_orders.insert_time','<=',date('Y-m-d',strtotime($end_date)));
			$isSelDate = 1;
		}
		

		if ($chk_brand == 1)
		{
			$tblOrder = $tblOrder->groupBy('tbl_order_details.manu_id');
			$isGroup = 1;
		}
		if ($chk_model == 1)
		{
			$tblOrder = $tblOrder->groupBy('tbl_order_details.model_id');
			$isGroup = 1;
		}
		if ($chk_country == 1)
		{
			$tblOrder = $tblOrder->groupBy('tbl_order_details.country_id');
			$isGroup = 1;
		}
		if ($chk_network == 1)
		{
			$tblOrder = $tblOrder->groupBy('tbl_order_details.network_id');
			$isGroup = 1;
		}
		if ($isSelDate == 0)
		{
			if ($isGroup == 1)
			{
				$tblOrder = $tblOrder->latest()->take(200)->get();
			}
			else
			{
				$tblOrder = $tblOrder->orderBy('tbl_orders.insert_time','desc')->take(200)->get();	
			}
		}
		else
		{
			$tblOrder = $tblOrder->get();	
		}

		return [
			'tblOrder' => $tblOrder, 
			'isGroup' => $isGroup
		];
	}
}
?>