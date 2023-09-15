<?php 

include('../inc/config.php'); 
session_start();

if (isset($_GET['date'])) {
    $jsonObj1= array();
    date_default_timezone_set("Asia/Calcutta");
    $my_date = date("Y-m-d");
    
    $o_date = $_GET['date'];
    
 

    $query="SELECT * FROM `timeslot` t
    ORDER BY t.ID ASC";
    $sql = mysqli_query($con,$query)or die(mysqli_error());
    
	while($data = mysqli_fetch_assoc($sql))
	{
	  
   if($_GET['recommended'] == 0)
   {
        $qry_check_booling = "SELECT * FROM orders
	 		WHERE orders.city_id ='".$_SESSION['city_id']."' AND orders.order_date='".$_GET['date']."' AND FIND_IN_SET('".$data['timeslot']."',orders.order_time) AND (orders.payment_type ='1' OR orders.payment_type = '2' OR orders.payment_type = '6' OR orders.payment_type = '7' ) ORDER BY orders.id DESC";
			$result_check_booking = mysqli_query($con,$qry_check_booling);
			$row_check_booking = mysqli_fetch_assoc($result_check_booking);
			$fetch_booking_check = mysqli_num_rows($result_check_booking);
   }else
   {
        $recommended = $_GET['recommended'];
        
          $qry_check_booling = "SELECT * FROM orders
	 		WHERE orders.city_id ='".$_SESSION['city_id']."' AND orders.staff_id='".$recommended."' AND orders.order_date='".$_GET['date']."' AND FIND_IN_SET('".$data['timeslot']."',orders.order_time) AND (orders.payment_type ='1' OR orders.payment_type = '2' OR orders.payment_type = '6' OR orders.payment_type = '7' ) ORDER BY orders.id DESC";
			$result_check_booking = mysqli_query($con,$qry_check_booling);
			$row_check_booking = mysqli_fetch_assoc($result_check_booking);
			$fetch_booking_check = mysqli_num_rows($result_check_booking);
   }
  
	
	      
	        
    	
            $row1['timezone_id'] = $data['ID'];
    		// $row1['timezone_name'] = $data['timeslot'];
    		//$row['timezone_price'] = $data['timezone_price'];
            
            if($fetch_booking_check >= $data['slot_max_book'] ){

            	$row1['timezone_name'] = $data['timeslot'];
                $row1['timezone_available']="0";
            }else{

            	$time = date('h:i A');
                $my_timeschedule_export=$data['timeslot'];
                $expload = (explode("to",$my_timeschedule_export));
                
                $ftime = $expload[0];
                $ltime = $expload[1];
                // $ltime="06:00 PM";
                // $timestamp = time();
                // 08:00 < 06:00
                 $hours = 2;
				 $timestamp = time() + ($hours * 60 * 60); 
				 
                 $row1['timezone_name'] = $data['timeslot'];
                if($my_date == $o_date){
                    if (strtotime($ftime) < $timestamp) {
                    	 
                    	$row1['timezone_available']="0";
                    }else{
                        
                    	$row1['timezone_available']="1";
                    }
                }else{
                    
                    	$row1['timezone_available']="1";
                    
                }
            }
            
            array_push($jsonObj1,$row1);   
    

	}
	//print_r($jsonObj1);
	
	
	foreach($jsonObj1 as $value)
	{
	   $data_values = $value["timezone_name"];
	     if($value['timezone_available'] == 0)
	     {
	         $active = '';
	         $active_class = 'btn btn-success';
	         $disabled = 'disabled';
	         $required = '';
	     }else{
	         $active = 'active';
	         $active_class = 'btn btn-primary';
	         $disabled = '';
	         $required = 'required';
	         
	     }
    	echo "<div class='col-xl-2 col-lg-2 col-sm-12 col-md-4'>";
        echo "<div class='normal-slot $active'>";
        echo "<button name='timeslot' data-id='$data_values' id='timeslot1' value='$data_values' ";
        echo "class='timeslot1 $active_class'>";
        echo "<input class='timezone ml-10' name='timezone' id='timezone' type='radio' value='";
        echo  $data_values;
        echo "'$required $disabled>";
        echo $value['timezone_name'];
        echo "</button>";
        echo "</div>";
        echo "</div>";
	}
	
// 	exit;
}
?>