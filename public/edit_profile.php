<?php 

include('../inc/config.php'); 

 session_start();


   if (isset($_POST['user_name']) and isset($_POST['user_email'])  and !empty($_POST['user_name']) ) 
   {
      // user_name,email,phone,password,imageurl

      $user_name = $_POST['user_name'];
      $email = $_POST['user_email'];
      $city_id = $_POST['city_id'];

      $user_id = $_SESSION['user_id'];
      
               $query_email  = "SELECT * FROM user_registration WHERE email = '$email' and ID!='$user_id'  ";  
               $result1_email=mysqli_query($con,$query_email);   
                // exit;
               if(mysqli_num_rows($result1_email) > 0)
               {
                  echo 5;
               }else{
                    $img_required ="";
                    
                    $user_edit= "UPDATE user_registration SET name ='".$user_name."' , email ='".$email."',city_id='".$city_id."',status=1
                    WHERE ID = '".$user_id."' ";   
                    $result_users = mysqli_query($con,$user_edit);

                    // exit;
                    
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
                    
                        $sqlx="UPDATE `user_registration` SET `dp`='$pic' WHERE ID = '".$user_id."' "; 
                        $result = mysqli_query($con,$sqlx);

                    }
                    
                    $query_phone_1  = "SELECT * FROM user_registration WHERE ID = '$user_id' ";  
                    $result1_phone_1=mysqli_query($con,$query_phone_1);   
                    $result1_phone1 = mysqli_fetch_assoc($result1_phone_1);
                    if($result)
                    {
                        $_SESSION['user_name'] = $result1_phone1['name'];
                        $_SESSION['city_id'] = $result1_phone1['city_id'];
                        // $_SESSION['user_phone'] = $result1_phone1['mobile'];
                        echo 1; 
                    }
                    else{
                        echo 2;
                    }
                    
               }
        
     
   }else{
       echo 0;
   }

?>