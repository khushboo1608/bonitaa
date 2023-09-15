<?php  
require('check.php');

// topic dropdown code
if(@$_GET['mode']=="staff"){
	$cid      = $_POST['id'];
	$get_sid = $_POST['get_sid'];

	$sql1="SELECT ID,name FROM staff WHERE city_id='$cid'";
	$result1 = mysqli_query($con,$sql1);   
	while($row11 =mysqli_fetch_array($result1)){ 
		$arr1[] = $row11;
	}

	$html0='';
	foreach($arr1 as $topic){
		if($topic['ID']==$get_sid){
	    $html0.="<option selected value=".$topic['ID']." style='background: grey; color:white;'>".$topic['name']."</option>";
	  }else{
	  	$html0.='<option value='.$topic['ID'].'>'.$topic['name'].'</option>';	
	  }
	}
	echo $html0;
}
?>

<!-- check for topic id when we edit  - still not working 6 pm -->