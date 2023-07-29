<?php ob_start();
		require "mpgClasses.php";

		/*$store_id='store3';
        $api_token='yesguy'; */
        $store_id='gwca001100';
        $api_token='WjcV085ePSkM0A1Zawir'; 

            //$order_id = 'sdvdfgfghf234rtyrcvcffghfghfhf';
            /*$price = '5.00';
            $fname = 'yash';
            $lname = 'sharma';
            $card_number = '4242424242424242';
            $expdate = '2401';
            $cvd = '123';  */

            $order_id = trim($_POST['order_id']);
            $price = $_POST['price'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $card_number = $_POST['card_number'];
            $expdate = $_POST['expdate'];
            $cvd = $_POST['cvd']; 
            
            if (strpos($price, ".") === false) {
            $price = $_POST['price'].'.00';
            } 

        /********************* Transactional Variables ************************/

        $type='purchase';
        $order_id= $order_id;
        $cust_id='my cust id';
        $amount= $price;
        $pan= $card_number;
        $expiry_date= $expdate;     //December 2008
        $crypt='7'; 



        /************************** CVD Variables *****************************/

        $cvd_indicator = '1';
        $cvd_value = $cvd;



        /********************** CVD Associative Array *************************/

        $cvdTemplate = array(
                             'cvd_indicator' => $cvd_indicator,
                             'cvd_value' => $cvd_value
                            );



        /************************** CVD Object ********************************/

        $mpgCvdInfo = new mpgCvdInfo ($cvdTemplate);

        /***************** Transactional Associative Array ********************/

        $txnArray=array(
                        'type'=>$type,
                        'order_id'=>$order_id,
                        'cust_id'=>$cust_id,
                        'amount'=>$amount,
                        'pan'=>$pan,
                        'expdate'=>$expiry_date,
                        'crypt_type'=>$crypt
                        );

        /********************** Transaction Object ****************************/
        //echo '<pre>'; print_r($txnArray); exit;
        $mpgTxn = new mpgTransaction($txnArray);
        
        /************************ Set AVS and CVD *****************************/


        $mpgTxn->setCvdInfo($mpgCvdInfo);

        /************************ Request Object ******************************/

        $mpgRequest = new mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        $mpgRequest->setTestMode(false); //false or comment out this line for production transactions

        /*********************** HTTPS Post Object ****************************/

        $mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

        /*************************** Response *********************************/
        
        $mpgResponse=$mpgHttpPost->getMpgResponse();
        echo json_encode($mpgResponse->responseData); exit;
        echo '<pre>'; print_r($mpgResponse->responseData); 
        echo $mpgResponse->getMessage(); exit();





/************************ Request Variables ***************************/

/*$store_id='store3';
$api_token='yesguy'; */
$store_id='gwca001100';
$api_token='WjcV085ePSkM0A1Zawir';

	$order_id = trim($_POST['order_id']);
	$price = $_POST['price'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$card_number = $_POST['card_number'];
	$expdate = $_POST['expdate'];
	$cvd = $_POST['cvd']; 
	
	if (strpos($price, ".") === false) {
    $price = $_POST['price'].'.00';
	}

/********************* Transactional Variables ************************/

$type='purchase';
$order_id= $order_id;
$cust_id='my cust id';
$amount= $price;
$pan= $card_number;
$expiry_date= $expdate;		//December 2008
$crypt='7'; 



/************************** CVD Variables *****************************/

$cvd_indicator = '1';
$cvd_value = $cvd;



/********************** CVD Associative Array *************************/

$cvdTemplate = array(
					 'cvd_indicator' => $cvd_indicator,
                     'cvd_value' => $cvd_value
                    );



/************************** CVD Object ********************************/

$mpgCvdInfo = new mpgCvdInfo ($cvdTemplate);

/***************** Transactional Associative Array ********************/

$txnArray=array(
				'type'=>$type,
       			'order_id'=>$order_id,
       			'cust_id'=>$cust_id,
       			'amount'=>$amount,
       			'pan'=>$pan,
       			'expdate'=>$expiry_date,
       			'crypt_type'=>$crypt
          		);

/********************** Transaction Object ****************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Set AVS and CVD *****************************/


$mpgTxn->setCvdInfo($mpgCvdInfo);

/************************ Request Object ******************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(false); //false or comment out this line for production transactions

/*********************** HTTPS Post Object ****************************/

$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

/*************************** Response *********************************/

$mpgResponse=$mpgHttpPost->getMpgResponse();

//echo $mpgResponse->getMessage(); exit();



//$result = preg_replace("/[^a-zA-Z0-9]+/", "", $mpgResponse->getMessage());
//echo $result;exit();
/*
print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nISO = " . $mpgResponse->getISO());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
print("\nAVSResponse = " . $mpgResponse->getAvsResultCode());
print("\nCVDResponse = " . $mpgResponse->getCvdResultCode());
print("\nITDResponse = " . $mpgResponse->getITDResponse()); */
//print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
//print("\nReceiptId = " . $mpgResponse->getReceiptId());
//echo $mpgResponse->getMessage();

define('tbl_orders', 'tbl_orders');

define('TBL_ORDER_DETAIL', 'tbl_order_details');

$transdate = $mpgResponse->getTransDate();
$transtime = $mpgResponse->getTransTime();



//fileLogManager::getInstance()->paymentLog(print_r($_REQUEST, true), "Paypal response");




$orderId = trim($_POST['order_id']);
$paidAmount     = $_POST['price'];
$txn_id     	= $mpgResponse->getTxnNumber();
//$paydate     	= "$transdate $transtime";
$paydate     	= date("Y-m-d H:i:s");
//$pay_status     	= 'APPROVED';
$pay_status     	= 'Completed';
$payment_type = 'instant';
//$pay_status = '1';
$act = '1';

$result_pay_status = preg_replace("/[^a-zA-Z0-9]+/", "", $mpgResponse->getMessage());
// get order info by request

//$orderId = getOrderId();

$orderInfo = getOrderFromDb($orderId);


verify_mysql_connection();



$edata = $funObj->tbl_general_configuration();







if( isset($txn_id) && $result_pay_status == 'APPROVED' )

{

	
	$ordId       	= $orderId;
	
	
	
	$getarray = mysql_query("select email from tbl_orders where order_id = $ordId");
		$fetcharray = mysql_fetch_array($getarray);
		
		$delemail = strtolower($fetcharray['email']);
		$uemail = strtolower($fetcharray['email']);
		$payer_email = strtolower($fetcharray['email']);
		
		if(!empty($delemail)){
		 
		
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,"https://www.demoninja.com/customapi/v1/unpaid_users.php");
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS,"email=$delemail");

						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

						$server_output = curl_exec ($ch);
						curl_close ($ch); 
	
		}
	
	
	



    verify_mysql_connection();

    $uqry = mysql_query(" select * from order_users where email='$uemail' ");

    $enum = mysql_num_rows($uqry);




    if($enum > 0)

    {

	
			$udata = mysql_fetch_array($uqry);

			//send mail to customer.

			include_once("../include/mailcontent.php");

			$to      = $uemail;
			$subject = $subjectcontent;
			$message = $messagecontentdatabase;
			$headers  = 'MIME-Version: 1.0' . "\r\n";

			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers .= "From: info@demoninja.com" . "\r\n" .

			"Reply-To: ".$edata['gen_contact_email']."" . "\r\n" .

			'X-Mailer: PHP/' . phpversion();


			if($pay_status=='Completed' && $ordId!='')
			{
				
					if($edata['mail_option'] == 1)

                    {
						
						
					
					
                            $mailobject=new phpmailerClass();
                            $mailobject->sendMialSmtp(
                            array(
                            'to'=>$to,
                            'name'=>'',
                            'subject'=>$subject,
                            'message'=>$message
                            )
                            );  


                    }

                    else

                    {
					
                        mail($to, $subject, $message, $headers);



                    $orderMsg = array

                    (

                        "to" => $to,

                        "subject" => $subject,

                        "message" => $message,

                        "headers" => $headers

                    );

                    fileLogManager::getInstance()->mailLog(print_r($orderMsg, true), "Sent mail");

                    }

				if (isset($regId)) {

					include("GCM.php");

					$gcm_regid = $regId; // GCM Registration ID

					// Store user details in db

					$gcm = new GCM();

					$sql = "update order_users set gcm_regid='$gcm_regid' where email='$uemail'";

					$res = mysql_query($sql);

					$registatoin_ids = array($gcm_regid);

					$text="Your demoninja Order has been completed successfully.";

					$password_api=base64_decode($udata['password']);

					$message = array("message" => "$text","username" => "$uemail","pass" => "$password_api");

					$result = $gcm->send_notification($registatoin_ids, $message);

					$saaa=json_decode($result,true);

					mail($uemail,$gcm_regid,$saaa);

				}
			}
			
			//$custom      = explode('||', $_REQUEST['custom'] );
    }else{


       //$pass = base64_encode($txn_id);
		
		
		 function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');

	for ($i = 0; $i < 4; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 5;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
}

	 $pass = random_num(9); 

        $sql = " insert into order_users set email='$uemail', password='$pass', status='1' ";

        verify_mysql_connection();

        $uqry = mysql_query($sql);
		
		$udata['password']=$pass;
		include_once("../include/mailcontent.php");
        fileLogManager::getInstance()->dbLog($sql, "insert order_users in notify");



        //send mail to customer.

            $to      = $uemail;

			//$to      = "info@demoninja.com";

			$subject = $subjectcontent;

			$message = $messagecontentdatabase;

			$headers  = 'MIME-Version: 1.0' . "\r\n";

			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers .= "From: info@demoninja.com" . "\r\n" .

			"Reply-To: ".$edata['gen_contact_email']." " . "\r\n" .

			'X-Mailer: PHP/' . phpversion();
		if($pay_status=='Completed' && $ordId!=''){

			if($edata['mail_option'] == 1){

			//include_once("smtpmailtest.php"); //mail sent bt smtp

			//$fromname ='demoninja';

			//$c= $funObj->send_email_smtp($subject,$fromname,$edata['gen_contact_email'], $to, $toname,$edata['gen_contact_email'], $message);
				//sending mail my post mark smtp
				$mailobject=new phpmailerClass();
				$mailobject->sendMialSmtp(
				array(
				'to'=>$to,
				'name'=>'',
				'subject'=>$subject,
				'message'=>$message
				)
				);  
			}else{

                    mail($to, $subject, $message, $headers);

                    $orderMsg = array

                    (

                        "to" => $to,

                        "subject" => $subject,

                        "message" => $message,

                        "headers" => $headers

                    );

                    fileLogManager::getInstance()->mailLog(print_r($orderMsg, true), "Sent mail");

                    mtx_log('Mail Sent');

			}
			if (isset($regId)) {

				include("GCM.php");

				$gcm_regid = $regId; // GCM Registration ID

				// Store user details in db

				$gcm = new GCM();

				$sql = "update order_users set gcm_regid='$gcm_regid' where email='$uemail'";

				$res = mysql_query($sql);

				$registatoin_ids = array($gcm_regid);

				$text="Your demoninja Order has been completed successfully.";

				$password_api=base64_decode($udata['password']);

				$message = array("message" => "$text","username" => "$uemail","pass" => "$password_api");

				$result = $gcm->send_notification($registatoin_ids, $message);

				$saaa=json_decode($result,true);

				mail($uemail,$gcm_regid,$saaa);

			}
		}

		//$custom      = explode('||', $_REQUEST['custom'] );
    }

	
        if($ordId)

        {

          $act = md5($txn_id);

          $sql = " update " . tbl_orders . " set

          pay_status='1',

          paid_amount='".$paidAmount."',

          txn_id='".$txn_id."',

          active_code='".$act."',

          fname='".$_POST['fname']."',

          lname='".$_POST['lname']."',

          email='".$payer_email."',

          payer_email='".$payer_email."',

          payment_date='".$paydate."',

          payment_time='".date("Y-m-d H:i:s", strtotime($paydate))."',

          payment_status='".$pay_status."',

          payment_type='".$payment_type."',

          paymethod = 'Moneris'

          where order_id='".$ordId."' ";

		 
          verify_mysql_connection();

          $pqry = mysql_query($sql);

         $OrderRow = mysql_fetch_array(mysql_query("Select * from tbl_order_details where order_id = '".$ordId."'"));
           
              //  include("processOrder_new.php");
			  
			  

         mysql_query("insert into imei_reminders set order_id='$ordId', status='0' ");
           
         // fileLogManager::getInstance()->dbLog($sql, "update order in notify");

         // mtx_log($sql."\n\n".'Updated Order in notify. Result: ' . $pqry);

        }

        //mtx_log("-------------------------\n\n");


}





function verify_mysql_connection()

{

  global $dataServer, $dataUser, $dataPassword, $dataDBName;

  // make sure the connectioin to the server is open

  if(!mysql_ping())

  {

    mysql_close();

    mysql_connect($dataServer,$dataUser,$dataPassword) or die(mysql_error());

    mysql_select_db($dataDBName)or die("Error ! Database connection Failure");

  }

}



function mtx_log($text)

{

  $fh = fopen('mtx_notify_log.txt', 'a');

  fwrite($fh,$text."\n");

  fclose($fh);

}

ob_clean();
if(!empty($result_pay_status)){
echo $result_pay_status;	
} else {
echo 'Please try again';	
}
		

?>