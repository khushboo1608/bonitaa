<?php
function debug($str){
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}

function debugx($str){
	echo "<pre>";
	print_r($str);
	echo "</pre>";
	die();
}

function reverseDate($dd){
	$changeDate = date("d/m/Y", strtotime($dd));
	return $changeDate;
}

function reverseDate2($var){
	$changeDate = date("Y-m-d", strtotime($var));
	return $changeDate;
}


function dateString($date,$type=NULL){
	if($type!=""){
		return date($type, strtotime($date));
	}else{
		return date('d M Y', strtotime($date));
	}
}

// This function convert date from any format to any format
function reformatDate($date, $from_format = 'd/m/Y', $to_format = 'Y-m-d') {
    $date_aux = date_create_from_format($from_format, $date);
    return date_format($date_aux,$to_format);
}

function reformatDate2($date, $from, $to){
	// $date = str_replace('/', '-', $date);
	$date = str_replace($from, $to, $date);
	return date('Y-m-d', strtotime($date));
}

function formatDate($date){
	$date = str_replace('/', '-', $date);
	return date('F j, Y, g:i a',strtotime($date));
}

function displayMsg($str){
	if(@$_GET['msg']!=''){
		$msg = '<p class="login-box-msg text-green text-bold">' . $_GET['msg']. '</p>'; 
	}
	return @$msg;
}
function dangerMsg($str){
	if(@$_GET['msgdanger']!=''){
		$msg = '<p class="login-box-msg text-danger text-bold">' . $_GET['msgdanger']. '</p>'; 
	}
	return @$msg;
}
function dupl_msg($str){
	if(@$_GET['dupl_msg']!=''){
		$msg = '<p class="login-box-msg text-danger text-bold">' . $_GET['dupl_msg']. '</p>'; 
	}
	return @$msg;
}


// =========== Database Function ===========
function get_safe_value($con,$str){
	if($str!=''){
		$str = trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

//get Count of any tabel
function getCount($con,$tbl){
	$sql = mysqli_query($con,"SELECT * FROM `$tbl`"); 
  	echo $querycount = mysqli_num_rows($sql);
  	return $querycount;
}

function getCountWhere($con,$tbl,$where=""){
	$sql = mysqli_query($con,"SELECT * FROM `$tbl` $where"); 
  	echo $querycount = mysqli_num_rows($sql);
  	return $querycount;
}

// Create URL by title name 
function createUrl($title){
	$title = preg_replace('/[^A-Za-z0-9\-]/', ' ', $title);
	$url   = str_replace(" ","-", $title);
	$url   = preg_replace('~-+~', '-', $url);
	$url   = strtolower("$url");
	$url   = trim($url, "-");
	return $url;
}

// Get Any Page Name
function getPageName(){
	$page = str_replace("/", "",  $_SERVER['PHP_SELF']);
	$page = str_replace(".php", "", $page);
	return $page;
}


function getAllRecords($con,$tbl,$limit='',$sort=""){
	$sql = "SELECT * FROM `$tbl` WHERE status='1' AND hide='0'";
	
	$sql.= " ORDER BY ID $sort";	
	if($limit!=''){
		$sql.= " LIMIT $limit";
	}	
	$result = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	return $data;
}

function getSingleRecord($con,$tbl,$where=""){
	$sql = "SELECT * FROM `$tbl` WHERE status='1'";
	
	if($where!=""){
		$sql.= " AND $where";
	}
	$result = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	return $data;
}

function getAllRecordsWhere($con,$tbl, $fields, $limit='',$sort="",$where=""){
	$sql = "SELECT $fields FROM `$tbl` WHERE status='1' AND hide='0'";
	
	if($where!=""){
		$sql.= " AND $where";
	}

	$sql.= " ORDER BY ID $sort";	
	if($limit!=''){
		$sql.= " LIMIT $limit";
	}	
	$result = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	return $data;
}


// Insert Data Function
function insertData($con, $tbl, $cols, $values){
    $insertquery = "INSERT INTO `" . $tbl . "` (" . $cols . ") VALUES (" . $values . ")";
    $insertresult = mysqli_query($con, $insertquery) or die(mysqli_error($con));
    if($insertresult){
        return $insertresult;
    }else{
        echo "Getting Error while saving data.";
    }
}
?>