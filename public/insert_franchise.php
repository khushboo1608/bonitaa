<?php

include('../inc/config.php'); 

 session_start();
    
    // echo 'hii';
    

    if (isset($_POST['franchise_type']) and isset($_POST['franchise_name']) and isset($_POST['franchise_occupation']) and isset($_POST['franchise_age']) and isset($_POST['franchise_experience']) and isset($_POST['franchise_query']) )
    {
        
    // echo 'Hello';
    $user_id = $_SESSION['user_id'];
    $franchise_type = $_POST['franchise_type'];
    $franchise_number = $_POST['franchise_number'];
    $franchise_name = $_POST['franchise_name'];
    $franchise_email = $_POST['franchise_email'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    $franchise_occupation = $_POST['franchise_occupation'];
    $franchise_age = $_POST['franchise_age'];
    $franchise_experience = $_POST['franchise_experience'];
    $franchise_query = $_POST['franchise_query'];
  
    //INSERT INTO `franchise`(`ID`, `status`, `user_id`, `name`, `email`, `phone`, `state`, `city`, `occupation`, `age`, `experience`, `owner_space`, `query`) 

    //{franchise_type:franchise_type,franchise_name:franchise_name, franchise_email:franchise_email,state_id:state_id,city_id:city_id,franchise_occupation:franchise_occupation,franchise_age:franchise_age,
    // franchise_experience:franchise_experience,franchise_query:franchise_query },
        
        if( !empty($franchise_number) ) 
        {
            $pattern = '/^[0-9]{10}+$/';
            if(!preg_match($pattern, $franchise_number)){
                echo '3';
        }else if( !empty($franchise_email) ) {
        
         $pattern1 = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
            if(!preg_match($pattern1, $franchise_email)){
                echo '4';
        }else {
        
      $qry1="INSERT INTO `franchise`(`status`, `user_id`, `name`, `email`, `phone`, `state`, `city`, `occupation`, `age`, `experience`, `owner_space`, `query`,`date`) 
      VALUES ('1','".$user_id."','".$franchise_name."','".$franchise_email."','".$franchise_number."','".$state_id."','".$city_id."','".$franchise_occupation."',
      '".$franchise_age."','".$franchise_experience."','".$franchise_type."','".$franchise_query."','".$snow."')"; 

    $user_res = mysqli_query($con,$qry1);
    
    if ($user_res) {
        echo 1;
    }else{
        echo 0;
    }
        }
        
        }
        }
}else{
    echo 0;
}
  
 

?>

