<?php
include('../inc/config.php'); 

 session_start();

if($_SESSION['user_id']!="" AND $_POST['service_id']!="" )
{
     $qry_cart = "SELECT * FROM cart WHERE services_id='".$_POST['service_id']."' and user_id='".$_SESSION['user_id']."' "; 
     // exit;   
    $result_cart     = mysqli_query($con,$qry_cart);
    $num_rows_cart   = mysqli_num_rows($result_cart);
    $row_cart = mysqli_fetch_assoc($result_cart);
        
    if($row_cart > 0)
    {
        echo 2;
    }else{
		$qry_product_check = "SELECT * FROM services WHERE ID='".$_POST['service_id']."'  "; 
        
        $result_product_check     = mysqli_query($con,$qry_product_check);
        $num_rows_product_check   = mysqli_num_rows($result_product_check);
        $row_product_check = mysqli_fetch_assoc($result_product_check);

        
        $original_amount = $row_product_check['original_amount'];
        $discount_amount = $row_product_check['discount_amount'];
        

       	if($num_rows_product_check>0){

        	$qry_insert="INSERT INTO `cart`(`status`, `user_id`, `services_id`, `cart_services_qty`, `cart_services_dis_amount`, `cart_services_ori_amount`)

			VALUES ('1','".$_SESSION['user_id']."','".$_POST['service_id']."','1','".$discount_amount."','".$original_amount."')"; 

			$result_insert=mysqli_query($con,$qry_insert);
			
			if($result_insert == 1)
                echo 1;
            else
                echo 0;

       	}else{
       		
            echo 0;
       	}
    }
	            
}
else{
	
	echo 0;
}	
?>

