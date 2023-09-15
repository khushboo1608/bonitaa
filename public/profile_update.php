<?php 

include('../inc/config.php'); 

 session_start();


   if (isset($_POST['user_name']) OR isset($_POST['user_email'])  ) 
   {
      // user_name,email,phone,password,imageurl

      $user_name = $_POST['user_name'];
      $email = $_POST['user_email'];
      $password = $_POST['user_password'];
      $code = $_POST['user_code'];
      $city_id = $_POST['city_id'];

      $user_phone = $_SESSION['user_phone'];
      $user_id = $_SESSION['user_id'];
      
      $sql_users = "SELECT * FROM user_registration where mobile = '".$user_phone."' ";
      $res_users = mysqli_query($con,$sql_users);
      $row_users = mysqli_fetch_assoc($res_users);

      $num_rows2_users = mysqli_num_rows($res_users);

      if ($num_rows2_users > 0 )
      {

         $query_phone  = "SELECT * FROM user_registration WHERE mobile = '$user_phone' ";  
         $result1_phone=mysqli_query($con,$query_phone);   

         if(mysqli_num_rows($result1_phone) > 0)
         {
               $query_email  = "SELECT * FROM user_registration WHERE email = '$email'  ";  
               $result1_email=mysqli_query($con,$query_email);   

               if(mysqli_num_rows($result1_email) > 0)
               {
                  echo 5;
               }else{
                   
                   $referral=$code;
                    $sql_code_check = "SELECT * FROM user_registration where code='".$referral."' ";
                    $code_res = mysqli_query($con,$sql_code_check);
                    $code_row = mysqli_fetch_assoc($code_res);
                    $code_num = mysqli_num_rows($code_res);

                    $user_parent_amount = '10';
                    $user_child_amount = '20';

                    if($code_row >0){

                        $parent=$user_parent_amount;
                        $parent_user_name=$code_row['name'];
                        $parent_user_id = $code_row['ID'];
                        $parent_wallet=$row_users['wallet'];
                        $parent_final_wallet=$parent_wallet + $parent;
                        
                        $child_earn=$user_child_amount;

                        $childwallet_amt =$code_row['wallet'];
                        $add_wallet= $childwallet_amt + $child_earn ;
                        
                        $update_parent_wallet= "UPDATE user_registration SET wallet='".$add_wallet."' WHERE ID='".$code_row['ID']."'";
                        $user_parent_res = mysqli_query($con,$update_parent_wallet);
                        
                        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                        $cur_date = date("Y-m-d h:i:s");
                        $cur_date1 = date('Y-m-d');
                        
                        // INSERT INTO `wallet_history`(`wh_id`, `wh_user_id`, `wh_amount`, `description`, `wh_type`, `wallet_date`, `wallet_status`)

                        $parent_description=$user_name." uses your referral code";
                        $parentuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$parent_user_id."','".$child_earn."','".$parent_description."','1','1','".$cur_date."','1')";
                        $parentuser_res = mysqli_query($con,$parentuser_wallet);


                        $child_description=$user_name." uses referral code for ".$parent_user_name;
                        $childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$user_id."','".$parent."','".$child_description."','1','2','".$cur_date."','1')";
                        $childuser_res = mysqli_query($con,$childuser_wallet);

                        $update_child_wallet= "UPDATE user_registration SET wallet='".$parent_final_wallet."' WHERE ID='".$user_id."'";
                        $user_child_res = mysqli_query($con,$update_child_wallet);
                   
                   
                    $img_required ="";
                    
                    $user_edit= "UPDATE user_registration SET name ='".$user_name."' , email ='".$email."' ,referral ='".$code."' , password ='".$password."',city_id='".$city_id."',status=1
                    WHERE mobile = '".$user_phone."' ";   
               
                    $result = mysqli_query($con,$user_edit);
                    $row_users = mysqli_fetch_assoc($result);
                    
                    
                    $ext="";
                    if((!empty($_FILES["imageurl"])) && ($_FILES['imageurl']['error'] == 0)){
                      $filename    = strtolower(basename($_FILES['imageurl']['name']));
                      $ext         = substr($filename, strrpos($filename, '.') + 1);
                      $namefile    = str_replace(".$ext","", $filename);
                      $newfilename = "users-".date("ymdHis");
                      //Determine the path to which we want to save this file
                      $ext=".".$ext;
                      $newname = '../uploads/users/'.$newfilename.$ext;
                      move_uploaded_file($_FILES['imageurl']['tmp_name'],$newname);  
                    } 

                    if($ext!=""){$pic="$newfilename$ext";
                    
                        $sqlx="UPDATE `user_registration` SET `dp`='$pic' WHERE mobile = '".$user_phone."' "; 
                        $result = mysqli_query($con,$sqlx);

                    }
                    
                    $query_phone_1  = "SELECT * FROM user_registration WHERE mobile = '$user_phone' ";  
                    $result1_phone_1=mysqli_query($con,$query_phone_1);   
                    $result1_phone1 = mysqli_fetch_assoc($result1_phone_1);
                    if($result)
                    {
                        $_SESSION['user_name'] = $result1_phone1['name'];
                        $_SESSION['user_id'] = $result1_phone1['ID'];
                        $_SESSION['user_phone'] = $result1_phone1['mobile'];
                        echo 1; 
                    }
                    else{
                        echo 2;
                    }
                  }else{
                      
                       $img_required ="";
                    
                    $user_edit= "UPDATE user_registration SET name ='".$user_name."' , email ='".$email."' ,referral ='".$code."' , password ='".$password."',city_id='".$city_id."',status=1
                    WHERE mobile = '".$user_phone."' ";   
               
                    $result = mysqli_query($con,$user_edit);
                    $row_users = mysqli_fetch_assoc($result);
                    
                    
                    $ext="";
                    if((!empty($_FILES["imageurl"])) && ($_FILES['imageurl']['error'] == 0)){
                      $filename    = strtolower(basename($_FILES['imageurl']['name']));
                      $ext         = substr($filename, strrpos($filename, '.') + 1);
                      $namefile    = str_replace(".$ext","", $filename);
                      $newfilename = "users-".date("ymdHis");
                      //Determine the path to which we want to save this file
                      $ext=".".$ext;
                      $newname = '../uploads/users/'.$newfilename.$ext;
                      move_uploaded_file($_FILES['imageurl']['tmp_name'],$newname);  
                    } 

                    if($ext!=""){$pic="$newfilename$ext";
                    
                        $sqlx="UPDATE `user_registration` SET `dp`='$pic' WHERE mobile = '".$user_phone."' "; 
                        $result = mysqli_query($con,$sqlx);

                    }
                    
                    $query_phone_1  = "SELECT * FROM user_registration WHERE mobile = '$user_phone' ";  
                    $result1_phone_1=mysqli_query($con,$query_phone_1);   
                    $result1_phone1 = mysqli_fetch_assoc($result1_phone_1);
                    if($result)
                    {
                        $_SESSION['user_name'] = $result1_phone1['name'];
                        $_SESSION['user_id'] = $result1_phone1['ID'];
                        $_SESSION['user_phone'] = $result1_phone1['mobile'];
                        $_SESSION['city_id'] = $result1_phone1['city_id'];
                        echo 1; 
                    }
                    else{
                        echo 2;
                    }
                  }   
               }
         }else{
            echo 4;   
         }
      }else{ echo 3;  }
   }else{
       echo 0;
   }

?>