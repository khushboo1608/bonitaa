<?php 
include('../inc/config.php'); 

session_start();

if(isset($_POST['id']))
{
	$city_id = $_POST['id'];
	$user_id = $_SESSION['user_id'];
	
	$user_edit= "UPDATE user_registration SET city_id='".$city_id."'
    WHERE ID = '".$user_id."' ";   
    $result_users = mysqli_query($con,$user_edit);
                    

	$query_city="SELECT *,c.ID as cityid,c.status as citystatus,c.name as cityname,s.name as statename,s.ID as stateid,s.status as statestatus FROM `city` c
	LEFT JOIN state s ON s.ID = c.state_id
	WHERE c.ID='".$_POST['id']."'
	ORDER BY c.ID DESC";

	$sql_city = mysqli_query($con,$query_city)or die(mysqli_error());

	$num_rows   = mysqli_num_rows($sql_city);

    $data_city = mysqli_fetch_assoc($sql_city);
    if($num_rows > 0){
        
    	$_SESSION['city_id'] = $data_city['cityid'];
    	$_SESSION['city_name'] = $data_city['cityname'];
    	$_SESSION['state_name'] = $data_city['statename'];	 
    	
    	$qry3 = "DELETE FROM cart WHERE user_id = '".$_SESSION['user_id']."' "; 	 
        $result3 = mysqli_query($con,$qry3);
    	
    	echo 1;
    }else{
    	echo 0;
    }

	
}else{
	echo 0;
}


?>