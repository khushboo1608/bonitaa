<?php 

include('../inc/config.php'); 

session_start();


if(isset($_POST['id']) )
{
	$book_id = $_POST['id'];
	$radio1 = $_POST['radio1'];
	$radio2 = $_POST['radio2'];
	$radio3 = $_POST['radio3'];
	$review = $_POST['review'];

	$user_id = $_SESSION['user_id'];

	$query_order="SELECT * FROM `orders` ord
    WHERE ord.id = '".$book_id."' ";
            
    $sql_order = mysqli_query($con,$query_order)or die(mysqli_error());
        
    $row_order = mysqli_fetch_assoc($sql_order);
    
    $num_rows = mysqli_num_rows($sql_order);

    if ($num_rows > 0)
    {

    	$rate_count = $radio1 + $radio2 + $radio3;
    	$final_rate_count = $rate_count/3;
    	$floor_count = floor($final_rate_count);

	    $address_city_id = $row_order['city_id'];
	            
		$qry11="INSERT INTO `review`(`user_id`, `order_id`, `city`, `rate`, `comment`, `date`, `feature`, `status`) 
		VALUES('".$user_id."','".$book_id."','".$address_city_id."','".$floor_count."','".$review."','".$now."',0,1) ";
			  
		$result1 = mysqli_query($con,$qry11);

		if($result1 == true)
		{
			echo 1;
		}else{
			echo 0;
		}
	}else{
		echo 0;
	}
}

?>