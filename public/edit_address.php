<?php

include('../inc/config.php'); 

 session_start();
    
    // echo 'hii';
    

    if (isset($_POST['address_name']) and isset($_POST['address']) and isset($_POST['address_id']) )
    {
    // echo 'Hello';
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
    
    $address_id = $_POST['address_id'];
    
    
    
    //address_type:address_type,address_name:address_name, address_number:address_number,address_houser_no:address_houser_no,address_lendmark:address_lendmark,state_id:state_id,city_id:city_id,
    //lattitude:lattitude,postal_code:postal_code,longitude:longitude,address:address
    
     $user_edit="UPDATE `address` SET `type`='".$address_type."',`name`='".$address_name."',`number`='".$address_number."',`houser_no`='".$address_houser_no."',
    `lendmark`='".$address_lendmark."',`adderss`='".$address."',`state_id`='".$state_id."',`city_id`='".$city_id."',`pincode`='".$postal_code."',
    `latitude`='".$lattitude."',`longitude`='".$longitude."' WHERE `ID`='".$address_id."' "; 

    $user_res = mysqli_query($con,$user_edit);
    
    if ($user_res) {
        echo 1;
    }else{
        echo 0;
    }   
}
  
 

?>

