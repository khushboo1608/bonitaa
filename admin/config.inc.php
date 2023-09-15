<?php  
require("../inc/config.php");

	//Settings
	$setting_qry="SELECT * FROM settings where ID='1'";
    $setting_result=mysqli_query($con,$setting_qry);
    $settings_details=mysqli_fetch_assoc($setting_result);

    // define("ONESIGNAL_APP_ID",$settings_details['onesignal_app_id']);
    // define("ONESIGNAL_REST_KEY",$settings_details['onesignal_rest_key']);
    // define("APP_NAME",$settings_details['app_name']);
	// define("APP_EMAIL",$settings_details['app_email']);
	// define("APP_CONTACT",$settings_details['app_contact']);
    // define("APP_WEBSITE",$settings_details['app_website']);
	// define("APP_LOGO",$settings_details['app_logo']);
	// define("APP_FROM_EMAIL",$settings_details['email_from']);
    


?>