<?php  
require('check.php');

// topic dropdown code
if(@$_GET['mode']=="subsubcategory"){
	$cid      = $_POST['id'];
	$get_sscid = $_POST['get_sscid'];

	$sql1="SELECT ID,subsubcategory_name FROM subsubcategory WHERE subcategory='$cid'";
	$result1 = mysqli_query($con,$sql1);   
	while($row11 =mysqli_fetch_array($result1)){ 
		$arr1[] = $row11;
	}

	$html0='';
	foreach($arr1 as $topic){
		if($topic['ID']==$get_sscid){
	    $html0.="<option selected value=".$topic['ID']." style='background: grey; color:white;'>".$topic['subsubcategory_name']."</option>";
	  }else{
	  	$html0.='<option value='.$topic['ID'].'>'.$topic['subsubcategory_name'].'</option>';	
	  }
	}
	echo $html0;
}
?>

<!-- check for topic id when we edit  - still not working 6 pm -->