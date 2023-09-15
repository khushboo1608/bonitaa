<?php 
require('config.inc.php');
$user = get_safe_value($con,$_POST['username']);
$pass = get_safe_value($con,$_POST['password']);

if($user !='' OR $pass !=''){
  $sql = "SELECT * FROM `admin` WHERE username='$user' OR email='$user'";
  $res = mysqli_query($con,$sql);

  if ($row = mysqli_fetch_array($res)){ 
    if ($row['password'] == "$pass" || $row['pw'] == "$pass") { 
      $_SESSION['ADMIN_USERNAME'] = $user;
      $_SESSION['ADMIN_ROLE']     = $row['role'];
      $year = time() + 31536000; //expiry time will be 2 days
      setcookie('ADMIN_USERNAME', $user, $year);
      header("Location: dashboard$extn");
      exit(0);
    }else if($row['password'] != "$pass"){
      header("Location: login$extn?msg=Invalid Password.");
    }else if($row['status'] != '1'){
      header("Location: login$extn?msg=Your account is Inactive.");
    }
  }else{
    header("Location: login$extn?msg=Invalid ID/Password.");
  }
}

?>