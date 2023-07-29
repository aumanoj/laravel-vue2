<?
//namespace App\UnLock;
  

  //define('UNLOCKBASE_API_KEY', '(D793-EDB4-D403-BA0A)');

  

  //define('UNLOCKBASE_API_DEBUG', false);


 // define('UNLOCKBASE_API_URL', 'http://www.unlockbase.com/xml/api/v3');


  //define('UNLOCKBASE_VARIABLE_ERROR',    '_UnlockBaseError'    );

  //define('UNLOCKBASE_VARIABLE_ARRAY',    '_UnlockBaseArray'    );

  //define('UNLOCKBASE_VARIABLE_POINTERS', '_UnlockBasePointers' );


  if (! extension_loaded('curl'))

  {

    trigger_error('cURL extension not installed', E_USER_ERROR);

  }

  

  /* Here comes the main class */

  

  class UnLock

  {

    /*

      mixed UnlockBase::CallAPI (string $Action, array $Parameters)

      Call the UnlockBase API.

      Returns the xml stream sent by the UnlockBase server

      Or false if an error occurs

    */



    
      public static function CallAPI ( $Action, $Parameters = array() )

    {

      if (is_string($Action))

      {

        if (is_array($Parameters))

        {

          /* Add the API Key and the Action to the parameters */

          $Parameters['Key'] = UNLOCKBASE_API_KEY;

          $Parameters['Action'] = $Action;



          /* Prepare the cURL session */

          $Ch = curl_init(UNLOCKBASE_API_URL);    

          curl_setopt($Ch, CURLOPT_CONNECTTIMEOUT, 10);

          curl_setopt($Ch, CURLOPT_TIMEOUT, 30);

          curl_setopt($Ch, CURLOPT_HEADER, false);

          curl_setopt($Ch, CURLOPT_RETURNTRANSFER, true);

          curl_setopt($Ch, CURLOPT_ENCODING, '');

          curl_setopt($Ch, CURLOPT_POST, true);

          curl_setopt($Ch, CURLOPT_POSTFIELDS, UnlockBase::BuildQuery($Parameters));

          

          /* Perform the session */

          $Data = curl_exec($Ch);

          

          if (UNLOCKBASE_API_DEBUG && curl_errno($Ch) != CURLE_OK)

          {

            /* If an error occurred, report it in debug mode */

            trigger_error(curl_error($Ch), E_USER_WARNING);

          }

          

          /* Close the session */

          curl_close($Ch);

          

          /* Return the data, or false if an error occurred */

          return $Data;

        }

        else trigger_error('Parameters must be an array', E_USER_WARNING);

      }

      else trigger_error('Action must be a string', E_USER_WARNING);

      

      return false;

    }



?>