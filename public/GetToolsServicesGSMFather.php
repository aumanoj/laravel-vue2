<?php 
   require ('dhrufusion/dbconn.php');
   $sql = "SELECT * FROM suppliers where id = 1";
    $result = $conn->query($sql);
    $suppliers = $result->fetch_assoc(); 
   //echo $suppliers['url'];
   /* print_r($suppliers); exit;
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
    } else {
      echo "0 results";
    }
    $conn->close(); */

	require ('dhrufusion/header.php');
  include ('dhrufusion/dhrufusionapi.class.php');
  define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
   define('DHRUFUSION_URL', $suppliers['url']);
    define("USERNAME", $suppliers['username']);
    define("API_ACCESS_KEY", $suppliers['api_key']); 
    //define('DHRUFUSION_URL', 'https://www.gsmfather.com');
    //define("USERNAME", 'Accounts86');
    //define("API_ACCESS_KEY", 'J3V-QQJ-MA0-C68-1QU-4T3-RM2-MB4');
	  $api = new DhruFusion();
    $api->debug = true;
    $request = $api->action('imeiservicelist');


    echo '<PRE>';
    print_r($request);
    echo '</PRE>'; exit;
    
    //exit;  

    
    foreach($request['SUCCESS'][0]['LIST']  as $key=>$value){
      //echo '<pre>'; print_r($value); 
        //echo 'i am in code'; exit;
         $fun_group_name = $value['GROUPNAME'];
        //echo '<pre>'; print_r($value); 
       // echo $value['GROUPNAME'].'<br>';
          $fun_group_name = $value['GROUPNAME']; 
            foreach($value['SERVICES'] as $keyy=>$valuee){
                $fun_tool_id = $valuee['SERVICEID']; 
                $fun_tool_name = $valuee['SERVICENAME']; 
                $fun_tool_credits = $valuee['CREDIT']; 
                $fun_tool_DeliveryUnit = $valuee['TIME']; 
                echo $fun_tool_id.'<br>';
                
                //echo $fun_tool_id.'<br>';
                //$dataArray = array();
                
                $resultt = $conn->query("SELECT * FROM tools where tool_id = '".$fun_tool_id."' and supplier_id = 1");
                $dataArray = $resultt->fetch_assoc(); 
                
                //print_r($dataArray); exit;
                if(!empty($dataArray)){

                    $conn->query("UPDATE tools SET `tool_name` = '".$fun_tool_name."', `api_price` = '".$fun_tool_credits."',  `delivery_time` = '".$fun_tool_DeliveryUnit."' where `fun_tool_id` = '".$fun_tool_id."'");
                }else {

                 // echo 'hello i am in codee'; exit;
                     $conn->query("INSERT INTO tools( `tool_id`,`supplier_id`,`tool_name`, `api_price`,  `delivery_time` ) values('".$fun_tool_id."','1','".$fun_tool_name."','".$fun_tool_credits."','".$fun_tool_DeliveryUnit."')");
                } 
               
               
                echo $keyy; 
            } 
       
        //$fun_group_name = $value;
        
     // echo 'hello i am in code <br>'; 
    }
	
	exit;
	


