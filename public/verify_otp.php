<?php

include('../inc/config.php'); 


 session_start();

  // Send OTP to email Form post
  // if (isset($_POST['text1']) and isset($_POST['text2']) and isset($_POST['text3']) and isset($_POST['text4']) ) {
  if (isset($_POST['user_otp'])) {
        
    // $text1 = $_POST['text1'];
    // $text2 = $_POST['text2'];
    // $text3 = $_POST['text3'];
    // $text4 = $_POST['text4'];

    // $postOtp = $text1.$text2.$text3.$text4;
    $postOtp = $_POST['user_otp'];
    //exit();


    $phone  = $_SESSION['user_phone'];

    $query  = "SELECT * FROM user_registration WHERE confirm_code = '$postOtp' AND mobile = '$phone'";
   
    $result = $con->query($query);
    $row1 = mysqli_fetch_assoc($result);
    $num_rows2 = mysqli_num_rows($result);
          
    if ($num_rows2 > 0 )
    {
        if($row1['name'] == "" or $row1['email']=="" )
        {
            $_SESSION['user_name'] = $row1['name'];
            $_SESSION['user_phone'] = $phone;
            $_SESSION['user_email'] = $row1['email'];
            $_SESSION['user_id'] = $row1['ID'];
            
            echo 1;
        }else{
            $_SESSION['user_name'] = $row1['name'];
            $_SESSION['user_phone'] = $phone;
            $_SESSION['user_email'] = $row1['email'];
            $_SESSION['user_id'] = $row1['ID'];
            
            echo 2;
        }
      
         

    }else{
        echo 3;
    } 
                 
  }else{
      echo 0;
  }  
  

?>