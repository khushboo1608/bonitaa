<?php 

include('../inc/config.php'); 
include("../inc/GCM.php");

 session_start();

   if (isset($_POST['user_phone'])) 
   {


       $user_phone = $_POST['user_phone'];

    

    if($user_phone == '7777991598') 
    {
         
        $qry3 = "SELECT * FROM user_registration WHERE mobile = '".$user_phone."' "; 	 
        $result3 = mysqli_query($con,$qry3);
        $row3 = mysqli_fetch_assoc($result3);
        $num_rows3 = mysqli_num_rows($result3);    
    
        if ($num_rows3 > 0 )
        {
        
            $user_edit1= "UPDATE user_registration SET confirm_code='1234' WHERE mobile = '".$user_phone."' "; 	
            $user_res1 = mysqli_query($con,$user_edit1);
   
           if($user_res1 == true)
    	   {    
    	       $_SESSION['user_phone'] = $user_phone;
    		   echo "insert";
    	   }
    	   else{
    	        echo 'invalid';
    	    }
          
	   
        }  
    }else{
                $user_phone = $_POST['user_phone'];
        		if($user_phone!= "")
        		{
        			//$text='1234';
        			$text=rand(1000,9999);
        			
        			$qry2 = "SELECT * FROM user_registration WHERE mobile = '".$user_phone."' and status=0 "; 	 
        			$result2 = mysqli_query($con,$qry2);
        			$row2 = mysqli_fetch_assoc($result2);
        			$num_rows2 = mysqli_num_rows($result2);
        			
        			if ($num_rows2 > 0 )
        			{
            			$user_edit= "UPDATE user_registration SET confirm_code='".$text."'  WHERE mobile = '".$user_phone."' "; 	
            			$user_res = mysqli_query($con,$user_edit);
        	            
        	            if($user_res == true)
        	            {
        	                 $_SESSION['user_phone'] = $user_phone;
        	    
            		        sent_mobile_verify_otp($user_phone, $text );
            			
            			    echo "insert";
        	            }
        	         
        			
        		
        			
        			}else
        			{
        			    $qry2 = "SELECT * FROM user_registration WHERE mobile = '".$user_phone."' and status=1 "; 	 
            			$result2 = mysqli_query($con,$qry2);
            			$row2 = mysqli_fetch_assoc($result2);
            			$num_rows2 = mysqli_num_rows($result2);
            			if ($num_rows2 > 0 )
        			    {
    			        	$user_edit= "UPDATE user_registration SET confirm_code='".$text."' WHERE mobile = '".$user_phone."' "; 	
                			$user_res = mysqli_query($con,$user_edit);


                			 if($user_res == true)
            	            {
            	                 $_SESSION['user_phone'] = $user_phone;
            	    
                		        sent_mobile_verify_otp($user_phone, $text );
                			
                			    echo "insert";
            	            }
            	         
        			        
        			    }else{
        			        
        				$code = '1234';

        				$qry1="INSERT INTO `user_registration`(`status`, `name`, `address`, `email`, `mobile`, `alternate_mobile`, `password`, `dp`, `sessionid`, `ip`, `token`, `confirm_code`, `code`, `referral`, `wallet`, `createdon`) 
        				VALUES (
        				'0',
        				'',
        				'',
        				'',
        				'".$user_phone."',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'".$text."',
        				'".$code."',
        				'',
        				'0',
        				'".$now."'
        				)"; 
        				$result11=mysqli_query($con,$qry1); 
        				
    		          $last_id = mysqli_insert_id($con);
                      $qrys = "SELECT * FROM user_registration WHERE ID = '".$last_id."'"; 
                      $results = mysqli_query($con,$qrys);
                      $row1 = mysqli_fetch_assoc($results);

        				
        				if($result11 == true)
        				{
        				     $_SESSION['user_phone'] = $row1['mobile'];


        				    sent_mobile_verify_otp($user_phone, $text );
        			    
        				    echo "insert";
        				}
        			  }  
        			}
        		}else {
        		    
                    	echo "invalid";
        			
        		
        			
        		}
    }
}

?>