<?php 
// Get Cookies values in SEssion 



if(!empty($_COOKIE['USER_EMAIL'])){
  $userSession = @$_COOKIE['USER_EMAIL'];
}else{
  $userSession = @$_COOKIE['USER_CONTACT'];
}


//if session is blank then redirect it to login page. 
// if(!isset($userSession)){
//   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=login$extn?msg=Login to Start your Session'>";  
//   exit(0); 
// } 

// Get Current User Details by Cookies
$result = mysqli_query($con,"SELECT * FROM `user_registration` WHERE (email='$userSession' OR mobile='$userSession')");
if($row = mysqli_fetch_assoc($result)) {
  $CLU_id        = $row['ID']; 
  $CLU_name      = $row['name'];
  $CLU_mobile    = $row['mobile'];
  $CLU_altmobile = $row['alternate_mobile'];
  $CLU_address   = $row['address'];
  $CLU_dp        = $row['dp'];
  $CLU_sessionid = $row['sessionid'];

}


/*
NOTE : CLU : Current Login User
*/
 ?>