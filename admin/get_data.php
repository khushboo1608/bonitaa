<?php  
require('check.php');

// topic dropdown code
if(@$_GET['mode']=="subcategory"){
	$cid      = $_POST['id'];
	$get_scid = $_POST['get_scid'];

	$sql1="SELECT ID,subcategory FROM subcategory WHERE category_id='$cid'";
	$result1 = mysqli_query($con,$sql1);   
	while($row11 =mysqli_fetch_array($result1)){ 
		$arr1[] = $row11;
	}

	$html0='';
	foreach($arr1 as $topic){
		if($topic['ID']==$get_scid){
	    $html0.="<option selected value=".$topic['ID']." style='background: grey; color:white;'>".$topic['subcategory']."</option>";
	  }else{
	  	$html0.='<option value='.$topic['ID'].'>'.$topic['subcategory'].'</option>';	
	  }
	}
	echo $html0;
}
?>

<!-- check for topic id when we edit  - still not working 6 pm -->