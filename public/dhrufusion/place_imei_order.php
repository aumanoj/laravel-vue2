<?php 
echo 'hello wer'; exit;
//ob_start(); 
error_reporting(0);
require ('dbconn.php');
echo 'hello wer'; exit;

 	$sql = "SELECT * FROM suppliers where id = 1";
    $result = $conn->query($sql);
    $suppliers = $result->fetch_assoc(); 
/**

 *	@author Dhru.com

 *	@APi kit version 2.0 March 01, 2012

 *	@Copyleft GPL 2001-2011, Dhru.com

 **/
require ('header.php');
include ('dhrufusionapi.class.php');
define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
/*define('DHRUFUSION_URL', "https://unlockresellers.com/");
define("USERNAME", "unlockninja");
define("API_ACCESS_KEY", "5DL-H8P-QKB-IUK-T5H-HGN-F52-5M5"); */
define('DHRUFUSION_URL', $suppliers['url']);
define("USERNAME", $suppliers['username']);
define("API_ACCESS_KEY", $suppliers['api_key']);
$api = new DhruFusion();

// Debug on
$api->debug = true;

$para['IMEI'] = $_POST['imei'];
$para['ID'] = $_POST['tool_id'];
//$para['IMEI'] = "354255093044206";
//$para['ID'] = "1220"; // got from 'imeiservicelist' [SERVICEID]
// PARAMETRES IS REQUIRED
// $para['MODELID'] = "";
// $para['PROVIDERID'] = "";
// $para['MEP'] = "";
// $para['PIN'] = "";
// $para['KBH'] = "";
// $para['PRD'] = "";
// $para['TYPE'] = "";
// $para['REFERENCE'] = "";
// $para['LOCKS'] = "";


$request = $api->action('placeimeiorder', $para);
ob_flush();
//echo json_encode($request); exit;
//echo 'fgh'; exit;
//ob_end_clean();
/*echo '<PRE>';
print_r($request);
echo '</PRE>';  */

?>