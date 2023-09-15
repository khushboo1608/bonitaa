<?php

include('../inc/config.php'); 
include("../inc/GCM.php");

session_start();

if($_POST['order_id']!="" AND $_POST['cancel_reason']!="" )
{ 
    $qry = "SELECT * FROM `orders` ord
	LEFT JOIN user_registration u ON u.ID = ord.user_id
	WHERE ord.id='".$_POST['order_id']."' and ord.user_id='".$_SESSION['user_id']."' ";

	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row1 = mysqli_fetch_assoc($result);
		
         if ($num_rows > 0)
		{
		    
    	    $user_edit= "UPDATE orders SET payment_type='5' , cancel_reason = '".$_POST['cancel_reason']."' 

    	    WHERE orders.id='".$_POST['order_id']."' and orders.user_id='".$_SESSION['user_id']."' ";	 
    	    
            $result = mysqli_query($con,$user_edit);

            if($result == true)
            {
                $qry1 = "SELECT * FROM `orders`
                WHERE orders.id='".$_POST['order_id']."' ";        
        		$result1 = mysqli_query($con,$qry1);
        		$row2 = mysqli_fetch_assoc($result1);
    
    			$qry2 = "SELECT * FROM `staff`
                WHERE staff.ID ='".$_POST['staff_id']."' ";        
        		$result2 = mysqli_query($con,$qry2);
        		$row3 = mysqli_fetch_assoc($result2);    
        		
        		
        		if($row2['payment_type'] == 5)
                {
                    $tokens = $row3['token'];
                    $name = $row3['name'];
                    $restro_name = $row3['name'];
                    $o_date = $row2['order_date'];
                    $b_id = $_POST['order_id'];
                    
                    $notification_click = 1;
                    $title="BOOK CANCELLED";
                  			
                  	$body = "Hello " .$name. ",  unfortunately order has CANCELLED because of ".$_POST['cancel_reason']." your Booking with ID " .$_POST['order_id'];
        					 
        					   
                    send_notification($tokens,$title,$body,$b_id,$notification_click);
                    
                     $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `date`, `msg`, `image`) 
    
    				 VALUES(1,'1','1','".$row3['ID']."','".$b_id."','".$title."','".$now."','".$body."','')"; 
    
    	   			$notifi_res = mysqli_query($con,$notifi_insert);
                    
                }
            
    		
                echo 1;
            }else{
                echo 2;
            }
    	 
			
		}
		else
		{
			echo 2;	 
				
		}

}
?>