<?php 
require('check.php');
$pageurl = "joinclass.php";
$tblname = "courses";
$pagename = "Join Class";
$id = @$_GET['id']; 

// Delete Query
if(@$_GET['mode']=="pause" && $id !=""){
  // $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  $sql="UPDATE `$tblname` SET liveclass_status ='0' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=courses.php?message=Class pause successfully'>";  exit(0);
} else {
 $sql="UPDATE `$tblname` SET liveclass_status ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=https://us02web.zoom.us/s/$_GET[zoomid]'>";  exit(0);
   
   }

?>