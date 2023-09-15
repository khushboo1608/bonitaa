<?php 

include('../inc/config.php'); 
include("../inc/GCM.php");
session_start();

if(isset($_GET['book_id']) and isset($_GET['date']) and isset($_GET['timezone']) )
{

    $order_id = $_GET['book_id'];
    $order_date = $_GET['date'];
    $order_time = $_GET['timezone'];

    $qry = "SELECT * FROM orders WHERE id = '".$order_id."' "; 
    $result = mysqli_query($con,$qry);
    $row1 = mysqli_fetch_assoc($result);

    $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0)
        {
          
            
            $times = 0;
            
            $query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
            LEFT JOIN services s on s.ID = orderdetails.service_id
            WHERE orderdetails.order_id='".$order_id."'
            ORDER BY orderdetails.id ASC";
            
            $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

            while($data_order_details = mysqli_fetch_array($sql_order_details))
            {
                
                $times += $data_order_details['duration']*$data_order_details['qty'];
        
            }           
            
            //echo $times;
            //exit;
            $total_time_slot = $times / 30;
            
            $total_time_slot_round = round($total_time_slot);
            
            
            $all_timeslot = array();
            
            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
            $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
            while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
            {
            
            $row2 = $data_timeslot['timeslot'];
            
            array_push($all_timeslot,$row2);
            
            }
            
            // print_r($all_timeslot);
            $new = array();
            foreach ($all_timeslot as $key => $value) {
                    //echo $value;
                if ($value === $order_time) {
                    // echo  $key;
                    // $search = $key;
                    //      $times1 = $_POST['order_time'];
                    //   array_push($new,$times1); 
                
                    for ($x = 0; $x < $total_time_slot_round-1; $x++) {
                    
                        $new[$key] = $all_timeslot[$key];
                        
                        if($new[$key] == "")
                        {
                            break;
                        }
                            $key++;
                    }
            
                }
            }
            
            $string_version = implode(',', $new);
            
            $object1 = json_encode($string_version);
                            
           $qry11="UPDATE `orders` SET `order_date` = '".$order_date."' , `order_time` = $object1
           WHERE id = '".$order_id."'";
           
           $result1 = mysqli_query($con,$qry11);
            
           if($result1 == true)
           {    
                $qry1 = "SELECT * FROM `orders`
                WHERE orders.id='".$order_id."' ";        
        		$result1 = mysqli_query($con,$qry1);
        		$row2 = mysqli_fetch_assoc($result1);
    
    			$qry2 = "SELECT * FROM `staff`
                WHERE staff.ID ='".$row2['staff_id']."' ";        
        		$result2 = mysqli_query($con,$qry2);
        		$row3 = mysqli_fetch_assoc($result2);    
        		
                $qry3 = "SELECT * FROM `user_registration`
                WHERE user_registration.ID='".$_SESSION['user_id']."' ";        
                $result3 = mysqli_query($con,$qry3);
                $row4 = mysqli_fetch_assoc($result3); 
        		

                    $tokens = $row3['token'];
                    $name = $row4['name'];
                    $restro_name = $row3['name'];
                    $o_date = $row2['order_date'];

                    $notification_click = 1;
                    $title="BOOK RESCHEDULE";
                  			
                  	$body = "Hello " .$restro_name. ",  unfortunately order has reschedule because of some reason your ID " .$order_id." At ".$o_date." and ".$order_time;
        					 
        					   
                    send_notification($tokens,$title,$body,$order_id,$notification_click);
                    
                     $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `date`, `msg`, `image`) 
    
    				 VALUES(1,'1','1','".$row3['ID']."','".$order_id."','".$title."','".$now."','".$body."','')"; 
    
    	   			$notifi_res = mysqli_query($con,$notifi_insert);
                    
                
                echo 1;
           }else{
                echo 0;
           }
    
    }else
    {
        echo 0;
    }
    
}
?>