<?php  
require('config.inc.php');

$admin_session = @$_COOKIE['ADMIN_USERNAME'];
$admin_role = @$_SESSION['ADMIN_ROLE'];
$result = mysqli_query($con,"SELECT * FROM `admin` WHERE username='$admin_session' AND role='$admin_role' AND status='1'");
if($row = mysqli_fetch_array($result)) {
	$superid    = $row['ID']; 
	$superuser  = $row['username'];
	$supername  = $row['name'];
	$superemail = $row['email'];
	$superrole  = $row['role'];
	$skincolor  = ($row['skin_color']!="") ? $row['skin_color'] : "skin-blue";
}


//if session is blank then redirect it to login page. 
if(!isset($_COOKIE['ADMIN_USERNAME'])){
	echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=login$extn'>";  
	exit(0); 
} 


?>