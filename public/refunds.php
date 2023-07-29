<?php ob_start();

 // print_r($_POST); exit();

require "mpgClasses.php";

$store_id='gwca001100';
$api_token='WjcV085ePSkM0A1Zawir';
$orderid= $_POST['orderid'];
$txnnumber= $_POST['txnnumber'];
$amount= $_POST['amount'];
$dynamic_descriptor='123';  

if (strpos($amount, ".") === false) {
    $amount= $_POST['amount'].'.00';
}else{
	$amount= $_POST['amount'];
}



/*
$store_id='store3';
$api_token='yesguy';
$orderid= 'ord-210917-9:42:52';
$txnnumber= '239130-0_11';
$amount= '1.00';
$dynamic_descriptor='123';*/

## step 1) create transaction array ###
$txnArray=array('type'=>'refund',
         'txn_number'=>$txnnumber,
         'order_id'=>$orderid,
         'amount'=>$amount,
         'crypt_type'=>'7',
         'cust_id'=> 'Customer ID',
         'dynamic_descriptor'=>$dynamic_descriptor
           );

## step 2) create a transaction  object passing the array created in
## step 1.

$mpgTxn = new mpgTransaction($txnArray);

## step 3) create a mpgRequest object passing the transaction object created
## in step 2
$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(false); //false or comment out this line for production transactions

## step 4) create mpgHttpsPost object which does an https post ##
$mpgHttpPost  =new mpgHttpsPost($store_id,$api_token,$mpgRequest);

## step 5) get an mpgResponse object ##
$mpgResponse=$mpgHttpPost->getMpgResponse();

ob_clean();

$result_pay_status = preg_replace("/[^a-zA-Z0-9]+/", "", $mpgResponse->getMessage());

echo $result_pay_status.'#'.$mpgResponse->getTxnNumber(); exit(); 

## step 6) retrieve data using get methods
/*
print ("\nCardType = " . $mpgResponse->getCardType());
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
print("\nTimedOut = " . $mpgResponse->getTimedOut()); */



?>
