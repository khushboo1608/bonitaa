<?php

include('../inc/config.php'); 

 session_start();
    
    // echo 'hii';
    

    if (isset($_POST['address_name']) and isset($_POST['address']) )
    {
    // echo 'Hello';
    $user_id = $_SESSION['user_id'];
    $address_type = $_POST['address_type'];
    $address_name = $_POST['address_name'];
    $address_number = $_POST['address_number'];
    $address_houser_no = $_POST['address_houser_no'];
    $address_lendmark = $_POST['address_lendmark'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    $postal_code = $_POST['postal_code'];
    $lattitude = $_POST['lattitude'];
    $longitude = $_POST['longitude'];
    $address = $_POST['address'];
    
    //address_type:address_type,address_name:address_name, address_number:address_number,address_houser_no:address_houser_no,address_lendmark:address_lendmark,state_id:state_id,city_id:city_id,
    //lattitude:lattitude,postal_code:postal_code,longitude:longitude,address:address
    
     $qry1="INSERT INTO `address`(`status`, `user_id`, `type`, `name`, `number`, `houser_no`, `lendmark`, `adderss`, `state_id`,`city_id`, `pincode`, `latitude`, `longitude`) 
      VALUES ('1','".$user_id."','".$address_type."','".$address_name."','".$address_number."','".$address_houser_no."','".$address_lendmark."','".$address."','".$state_id."','".$city_id."','".$postal_code."','".$lattitude."','".$longitude."')"; 

    $user_res = mysqli_query($con,$qry1);
    
    if ($user_res) {
        echo 1;
    }else{
        echo 0;
    }   
}
  
 

?>

