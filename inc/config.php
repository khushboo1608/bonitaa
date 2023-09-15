<?php
session_start();
require("functions.php");
require('add_to_cart.php');
date_default_timezone_set('Asia/Kolkata');
$dd       = date("d/m/Y");
$dt       = date("h:i:s A");
$rd       = date("Y/m/d");
$newrd    = date("Y-m-d"); 
$now      = date("d/m/Y, h:i:s A");
$snow     = date("Y/m/d H:i:s");
$sd       = date("Y/m/d H:i");
$ipa      = $_SERVER['REMOTE_ADDR'];
$dpt      = date("d M Y");
$newrdate = "2021-07-01";

// API Keys
$tinyeditor = "jniyiy9uuvwbxtwwlrndoo9voapth41xslabs0fn5cadv63v";

// DB Connectivety
if($_SERVER['HTTP_HOST']=="localhost"){
	$con = mysqli_connect("localhost","root","");
	if (!$con){
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"vb_2023_bonitaa"); 
	$baseurl = "http://localhost/vb_website/2023/bonitaa";
	$mainurl = "http://localhost/vb_website/2023/bonitaa";
}else if($_SERVER['HTTP_HOST']==""){
	$con = mysqli_connect("localhost","vbinfggt_khushbu","3!6#gQzq(pp0");
	if (!$con){
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"vbinfggt_bonitaa"); 
	$baseurl = "https://codeocean.co.in/app/bonitaa";
	$mainurl = "https://codeocean.co.in/app/bonitaa";

}else if($_SERVER['HTTP_HOST']=="localhost"){

	$con = mysqli_connect("localhost","root","");
	if (!$con){
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"vb_2022_bonitaa_new"); 
	$baseurl = "http://192.168.0.10/vb/2022/android/bonitaa";
	$mainurl = "http://192.168.0.10/vb/2022/android/bonitaa";
}
else{
	$con = mysqli_connect("localhost","bonitoww_bonitaa","Ecd3jrDSLJnj");
	if (!$con){
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"bonitoww_bonitaa"); 	
	$baseurl = "https://bonitaa.in";
	$mainurl = "https://bonitaa.in";
}
	

mysqli_query($con,"SET SESSION sql_mode = ''");
mysqli_query($con,'SET character_set_results=utf8mb4');        
// mysqli_query($con,'SET names=utf8');
mysqli_query($con,'SET character_set_client=utf8mb4');        
mysqli_query($con,'SET character_set_connection=utf8mb4');
mysqli_query($con,'SET collation_connection=utf8mb4_unicode_ci');

// $baseurl = ($_SERVER['HTTP_HOST']=="localhost") ? "http://localhost/personal/bonitaa.in" : "https://bonitaa.samytech.in";

define('RS', '&#8377; '); 
define("SITE_PATH","$baseurl");
define("IMG_PATH","$baseurl/images/");
define("UPLOAD_PATH","$baseurl/uploads/");

$admintitle       = "Bonitaa";
$webtitle         = "Bonitaa - Salon at Home";
$extn             = "";
$call_no          = "+91-6397695174";
$whatsapp 		  = "https://wa.me/916397695174";
$info_email       = "info@bonitaa.in";
$address          = "FF-7 Shiv Plaza Near Indraprastha Colony Meerut Roorkee Road, Meerut , Uttar Pardesh 250001";
$gmap = '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13954.198022617024!2d77.7086296!3d29.030324!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdbf71c8b304b7da9!2sBonitaA%20-%20Beauty%20%26%20Wellness!5e0!3m2!1sen!2sin!4v1651412662598!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';


$header_logo      = UPLOAD_PATH."web-logo.webp";
$footer_logo      = UPLOAD_PATH."foot-logo.webp";
$admin_small_logo = UPLOAD_PATH."admin-small-logo.png";
$admin_logo       = UPLOAD_PATH."head-logo.webp";

// Social Links
$fb = "https://www.facebook.com/bonitaAservices/";
$tw = "https://twitter.com/BonitaaServices";
$ln = "";
$yt = "";
$ig = "https://www.instagram.com/bonitaabeauty_/";
$app = "https://play.google.com/store/apps/details?id=com.bonitaa";

$setting_qry="SELECT * FROM settings where ID='1'";
$setting_result=mysqli_query($con,$setting_qry);
$settings_details=mysqli_fetch_assoc($setting_result);

define("APP_conveyance",$settings_details['text2']);
define("APP_safety_hygiene",$settings_details['text1']);

define("APP_SERVER_KEY",$settings_details['firebase_server_key']);
define("ONESIGNAL_APP_ID",$settings_details['onesignal_app_id']);
define("ONESIGNAL_REST_KEY",$settings_details['onesignal_rest_key']);
define("API_KEY",$settings_details['factor_apikey']);
define("MINI_ORDER_AMOUNT",$settings_details['text12']);

require('checkSession.php');
?>