<?php

/**

 *	@author Dhru.com

 *	@APi kit version 2.0 March 01, 2012

 *	@Copyleft GPL 2001-2011, Dhru.com

 **/
require ('header.php');
include ('dhrufusionapi.class.php');
define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
define('DHRUFUSION_URL', "https://unlockresellers.com/");
define("USERNAME", "unlockninja");
define("API_ACCESS_KEY", "5DL-H8P-QKB-IUK-T5H-HGN-F52-5M5");
$api = new DhruFusion();

// Debug on
$api->debug = true;


$para['ID'] = "1"; // got from 'imeiservicelist' [SERVICEID]
$request = $api->action('modellist', $para);


echo '<PRE>';
print_r($request);
echo '</PRE>';

?>