<?php
ob_start();
set_time_limit(0);
ini_set("memory_limit","256M");

require ('dhrufusion/dbconn.php');
require ('dhrufusion/header.php');
include ('dhrufusion/dhrufusionapi.class.php');
   $sql = "SELECT * FROM suppliers where id = 1";
    $result = $conn->query($sql);
    $suppliers = $result->fetch_assoc(); 

//$gqry = mysql_query("select tbl_order_details.*,fun_credits.fun_tool_name from tbl_order_details where left join fun_credits on fun_credits.fun_tool_id = tbl_order_details.tool_id unlock_status='Waiting' and unlock_id <> ''  "); // Remove this while testing .

$waitingQuery = $conn->query("select orders.*,tools.tool_name from orders join tools on tools.tool_id = orders.tool_id where unlock_status='Waiting' and tools.supplier_id = 1"); 


//$gqry = $waitingQuery->fetch_assoc(); 
//echo '<pre>'; print_r($gqry); exit;

if( mysqli_num_rows($waitingQuery) > 0 )
{   
while($gdata = $waitingQuery->fetch_assoc()) {  
	echo $gdata['unlock_id'].'<br>';
	$ordId = $gdata['order_id']; 
	$toolPricee = $gdata['api_price'];
	$selling_price = $gdata['selling_price'];
	/* Call the API */
       
	    
       
        
	    
        define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
        define('DHRUFUSION_URL', $suppliers['url']);
    	define("USERNAME", $suppliers['username']);
    	define("API_ACCESS_KEY", $suppliers['api_key']); 
        $api = new DhruFusion();
        
        // Debug on
        $api->debug = true;

        $para['ID'] = $gdata['unlock_id'];
       // $para['ID'] = '28722'; // got REFERENCEID from placeimeiorder
        $Data = $api->action('getimeiorder', $para);
        
        /*if($ordId == '381738'){
            echo DHRUFUSION_URL.'<br>';
            echo '<pre>'; print_r($Data); exit;
        } */
        echo '<PRE>';
        print_r($Data);
        echo '</PRE>'; 
        //exit;  
	//$XML = UnlockBase::CallAPI('GetOrders', array('ID' => $gdata['unlock_id']));
	if (isset($Data['ERROR']) || isset($Data['SUCCESS']))
	{   
	    //echo 'hello i am in code'; exit;
		/* Parse the XML stream */
	//	$Data = UnlockBase::ParseXML($XML);
		if (is_array($Data))
		{
	
		/* Everything works fine */
			//print('<table>');
			//echo "<pre>";print_r($Data);echo "</pre>";
			/* We will print only these fields */
			//$Fields = array('ID', 'Date', 'IMEI', 'Credits', 'Tool', 'Status', 'Available', 'Delivery', 'Codes');


		/*	$size = count($Data['Order']);    
			for($i=0; $i<$size; $i++)
			{ */

				if(!empty($Data['ERROR'][0]['CODE']) || !empty($Data['SUCCESS'][0]['CODE']))
				{
				    if (isset($Data['ERROR'])){
				       $unlock_code = $Data['ERROR'][0]['CODE'];
				       $unlock_status = 'Failed';
				       
				    }
				    
				    if (isset($Data['SUCCESS']) && $Data['SUCCESS'][0]['STATUS'] == 4){
				        $unlock_code = $Data['SUCCESS'][0]['CODE'];
				        $unlock_status = 'Delivered';
				    }else {
				        $unlock_status = 'Unavailable';
				    }
				    
			
				$sqry = $conn->query("update orders set unlock_status='".addslashes($unlock_status)."', unlock_code='".addslashes($unlock_code)."', imei_code='".addslashes($Data['SUCCESS'][0]['IMEI'])."'  where unlock_id='".addslashes($Data['ID'])."'  ");
                
				
			//	$tool_available = 0;
					
					if($Data['SUCCESS'][0]['STATUS'] == 4){
						$tool_available = 'Yes';
					}else {
						$tool_available = 'No';
					}
                 $tool_ids = $gdata['tool_id'];
				 $toolName = $gdata['fun_tool_name'];;
				 $dataa = $unlock_status;
				 

				$manualprocess .= "Waiting Order <br>";
				$manualprocess .= "Used Tool - $tool_ids - $toolName <br>";
				$manualprocess .= "Response - $dataa <br>";
				$manualprocess .= "Tool Available - $tool_available <br>";
				
				//mysql_query("INSERT INTO  order_comments (`order_id`,`comment`,`created`)VALUES('".$ordId."','".$manualprocess."',NOW())"); 				
            
				if($sqry)
				{   
					$ub_id = $Data['ID'];

					/*$cqry = mysql_query(" select ors.email,ord.manu_id,ord.model_id,ord.order_id,ord.delivery_time from tbl_orders as ors, tbl_order_details as ord where ord.unlock_id='".$ub_id."' and ors.order_id=ord.order_id ");

					$cdata = mysql_fetch_array($cqry);
					
					
						if($Data['SUCCESS'][0]['STATUS'] != 4)
					{   
					    $order_id 	   = $cdata['order_id'];
						$brand_id 	   = $cdata['manu_id'];
						$delivery_time = $cdata['delivery_time'];
						$model_id 	   = $cdata['model_id'];
					    
					    $brandnamedata = mysql_fetch_array(mysql_query('select fun_manu_id,fun_manu_name from fun_manufacturers where fun_manu_id="'.$brand_id.'"'));
					    
					    $modelnamedata = mysql_fetch_array(mysql_query('select fun_model_id,fun_model_num from  fun_models where fun_model_id="'.$model_id.'"'));
					    $emailBrand = $brandnamedata['fun_manu_name'];
					    $emailModel = $modelnamedata['fun_model_num'];
					    
					    $subject = 'Order ID '. $order_id.' '.$unlock_status;
						$message .= 'Error Msg: '.$error_messgae.'<br>';
						$message .= 'Order ID: '.$order_id.'<br>'; 
						$message .= 'Brand: '.$emailBrand.'<br>'; 
                        $message .= 'Model: '.$emailModel.'<br>';
                        $message .= 'Tool Name: '.$toolName.'<br>';
                        $message .= 'API Price: '.$toolPricee.'<br>';
                        $message .= 'Our Price: '.$selling_price.'<br>';
											

						$fromemail="contact@demoninja.com";
						$replyto="info@demoninja.com";		   
						$fromname ='support';

						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";			
						$headers .= "From: $fromemail " . "\r\n" .
						"Reply-To: ".$replyto." " . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
											
											//sending mail my post mark smtp
						$mailobject=new phpmailerClass();
						$mailobject->sendMialSmtpAlert(
							array('to'=>'info@demoninja.com','name'=>'','subject'=>$subject,'message'=>$message));
					                        
					    
					    
					    
					}
                    
                    

					if($cdata['email'] != '' && $Data['SUCCESS'][0]['STATUS'] == 4)
					{
						$to=$cdata['email'];
						if($unlock_code != '')
						{	$order_id 	   = $cdata['order_id'];
							$brand_id 	   = $cdata['manu_id'];
							$delivery_time = $cdata['delivery_time'];
							$model_id 	   = $cdata['model_id'];
							$imei 		   = $Data['SUCCESS'][0]['IMEI'];
						
							
							
							
							$brandnamedata = mysql_fetch_array(mysql_query('select fun_manu_id,fun_manu_name from fun_manufacturers where fun_manu_id="'.$brand_id.'"'));

							$brandcontent = mysql_fetch_array(mysql_query('select instruction_url from brand_contents where fun_manu_id="'.$brand_id.'"'));
							$modelnamedata = mysql_fetch_array(mysql_query('select fun_model_id,fun_model_num from  fun_models where fun_model_id="'.$model_id.'"'));

							if(isset($brandcontent['instruction_url']) && !empty($brandcontent['instruction_url'])){
							$emaiSqlQuery = mysql_query('select * from email_templates where alias="deliveredinstruction" and status=1');

							$instruction_url = $brandcontent['instruction_url']; 

							} else {
							$emaiSqlQuery = mysql_query('select * from email_templates where alias="delivered" and status=1');
							$instruction_url = '';
  
							}

							$emailcontent = mysql_fetch_array($emaiSqlQuery);

							if(!empty($emailcontent)){			
								$subjectcontent = $emailcontent['subject'];
								$messagecontent = $emailcontent['content'];
								$subjectcontentdatabase = str_replace(array('<<Brand>>','<<Model>>','<<instruction>>'),array($brandnamedata['fun_manu_name'],$modelnamedata['fun_model_num'],$instruction_url),$subjectcontent); // subject
								$searcharray = array('&lt;&lt;Brand&gt;&gt;','&lt;&lt;Model&gt;&gt;','&lt;&lt;imei&gt;&gt;','&lt;&lt;unlock code&gt;&gt;','&lt;&lt;order_id&gt;&gt;','&lt;&lt;delivery_time&gt;&gt;','&lt;&lt;instruction&gt;&gt;');				
			
								$replacearray = array($brandnamedata['fun_manu_name'],$modelnamedata['fun_model_num'],$imei,$unlock_code,$order_id,$delivery_time,$instruction_url);

								$message = str_replace($searcharray,$replacearray,$messagecontent); 
								
							}
							
							
							
							
							
							
							$mailobject=new phpmailerClass();
							$mailobject->sendMialSmtp(
							array(
							'to'=>$to,
							'name'=>'',
							'subject'=>$subjectcontentdatabase,
							'message'=>$message
							)
							);
							
						
							
						}
						

					
				//	}
				}    */                                    
			}
		}
		}
	else
	{
	/* Parsing error */
	print('Could not parse the XML stream');
	}
	}
	else
	{
	/* Communication error */
	print('Could not communicate with the api');
	}
	}
}
//send the header to order page.
?>
<p><a href="./">Go back</a></p>
</body>
</html>
