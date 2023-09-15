<?php

include('inc/config.php'); 
	
$cid = $_GET['state_id'];


echo $cat_qry1="SELECT *,city.name,city.ID FROM city WHERE city.state_id = '".$cid."' AND city.status='1' ";

$cat_result1=mysqli_query($con,$cat_qry1); 
	 echo	"<option value=''>----Select City---</option>";
    echo 'Hii';
while($row1=mysqli_fetch_assoc($cat_result1))
{
     echo 'Hello';
    echo	"<option value='".$row1['ID']."'>".$row1['name']."</option>";
}

exit;