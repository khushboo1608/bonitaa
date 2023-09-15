<?php
include('../inc/config.php'); 

 session_start();

if($_SESSION['user_id']!="" AND $_POST['address_id']!="" )
{

		$qry_product_check = "SELECT * FROM address WHERE user_id='".$_SESSION['user_id']."' and ID='".$_POST['address_id']."'  "; 
        
        $result_product_check     = mysqli_query($con,$qry_product_check);
        $num_rows_product_check   = mysqli_num_rows($result_product_check);
        $row_product_check = mysqli_fetch_assoc($result_product_check);

       	if($num_rows_product_check>0){
       	    
				$delete = "DELETE FROM address WHERE user_id='".$_SESSION['user_id']."' and ID='".$_POST['address_id']."'  ";
                $result1 = mysqli_query($con,$delete);

                if($result1 == 1)
                    echo 1;
                else
                   echo 0;


       	}else{
       		
            echo 0;
       	}

	            
	}
	else{
		echo 0;
	}	
?>

