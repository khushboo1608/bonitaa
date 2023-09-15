<?php
include('../inc/config.php'); 

 session_start();

if(isset($_SESSION['user_id']) AND isset($_POST['service_id']))
{

		$qry_product_check = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."' and services_id='".$_POST['service_id']."'  "; 
        $result_product_check     = mysqli_query($con,$qry_product_check);
        $num_rows_product_check   = mysqli_num_rows($result_product_check);
        $row_product_check = mysqli_fetch_assoc($result_product_check);

       	if($num_rows_product_check>0){
       	    
       	    if($_POST['quantity']==0){

				$delete = "DELETE FROM cart WHERE user_id='".$_SESSION['user_id']."' and services_id='".$_POST['service_id']."'  ";
                $result1 = mysqli_query($con,$delete);

                if($result1 == 1)
                    echo 1;
                else
                   echo 0;

        	}else{
            	
             $user_edit="UPDATE `cart` SET
            `cart_services_qty`='".$_POST['quantity']."'  WHERE `user_id`='".$_SESSION['user_id']."' AND `services_id`='".$_POST['service_id']."'  ";  
                        
            $user_res = mysqli_query($con,$user_edit);  
			
			if($user_res == 1)
                echo 1;
            else
                echo 0;
                
        	}
	            	
            
        	

       	}else{
       		
            echo 0;
       	}

	            
	}
	else{
		echo 0;
	}	
?>

