<?php



    function send_notification($tokens,$title,$body,$b_id,$notification_click) {
                $app_key = APP_SERVER_KEY;
                $url = "https://fcm.googleapis.com/fcm/send";
                $token = $tokens;
                $serverKey = $app_key ;
                 $type = $b_id ;
                 $notification_click1 = $notification_click;
  
      $notification = array(
                    'title' =>$title , 
                    'body' => $body, 
                      'type' => $type,
                    'sound' => 'default',
                    'badge' => '1'
                    );
            
                
            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data' => [ 'type' => $type ]);
              
        //   $notification = array(
        //             'title' =>$title , 
        //             'body' => $body,
        //              'type' => $type,
        //              'notification_click' => $notification_click1,
        //             );
                
        //         $arrayToSend = array(
        //             'to' => $token,
        //             'content_available'=> true,
        //             'priority'=> 'high',
        //              'data' => $notification
        //                 );
    
                        
                $json = json_encode($arrayToSend);
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: key='. $serverKey;
                $ch = curl_init();
             
               curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $json );
    
                 $result = curl_exec($ch);
                 curl_close($ch);
     }
     
     
      function send_notification_all($tokens,$body,$o_id) {
     
                $url = "https://fcm.googleapis.com/fcm/send";
                $token = $tokens;
             $serverKey = '';
                $title = "Bonitaa";
                 $type = $o_id ;
  
              /*  $notification = array(
                    'title' =>$title , 
                    'body' => $body, 
                    'sound' => 'default',
                    'badge' => '1'
                    );
                z
                $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data' => [ 'type' => $type ]);*/
    
             $token1 = json_decode(json_encode($token));
           $notification = array(
                    'title' =>$title , 
                    'body' => $body,
                     'type' => $type,
                    );
                
                $arrayToSend = array(
                    'to' => $token1,
                    'content_available'=> true,
                    'priority'=> 'high',
                     'data' => $notification
                        );
    
                        
                $json = json_encode($arrayToSend);
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Authorization: key='. $serverKey;
                $ch = curl_init();
             
               curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $json );
    
                 $result = curl_exec($ch);
                 curl_close($ch);
     }
    
   function   send_notification12($tokens) {
            $app_key = APP_SERVER_KEY;
            $url = "https://fcm.googleapis.com/fcm/send";
            $token = $tokens;
           $serverKey = $app_key;
              $title = "Notification title";
            $body=	"this is for testing purpose";
            $type="sent";
            
             $token1 = json_decode(json_encode($token));
 						
            $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
        
        
        $arrayToSend = array('to' => $token1, 'notification' => $notification,'priority'=>'high','type' => $type );
            
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        
       $result = curl_exec($ch );
	   $result = json_decode($result, true);
	   print_r($result);
	   if($result['success'] == 1){
			$response['status'][] = array( 
 								  'status'	=>'1',
 								  'title' =>$title , 
 								  'body' => $body
 								);
	   }
	   else{
			$response['status'][] = array( 
 								  'status'	=>'0'
 								);
	   }
        curl_close( $ch );
        echo json_encode($response);
 
    }
    
    function sent_mobile_verify_otp($mobile , $text)
{
      $api_key=API_KEY;
    $YourAPIKey = $api_key;
    $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    
     $url = "https://2factor.in/API/V1/$YourAPIKey/SMS/$mobile/$text/sentotp" ;
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    $result1= curl_exec($ch);
    $result = json_decode($result1, true);
    
    //	   print_r($result);
    
    curl_close($ch);
     
 
}

?>
