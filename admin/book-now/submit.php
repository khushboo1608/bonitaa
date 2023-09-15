<?php

require("class.phpmailer.php");

if( isset( $_POST['service_type'] ) ){
	$err_array = array();

	if( empty($_POST['mobile']) && empty($_POST['service_type'])  && empty($_POST['brand'])  && empty($_POST['city']) && empty($_POST['name']) ){
		$err_array['mobile']= 'Enter mobile no!';
		$err_array['name']= 'Enter your name!';
		$err_array['service_type']= 'Please select service type!';
// 		$err_array['brand']= 'Please select brand!';
		$err_array['city']= 'Enter your city name!';
	}
	if( empty($_POST['mobile']) ){
		$err_array['mobile']= 'Enter mobile no!';
	}
	if( empty($_POST['name']) ){
		$err_array['name']= 'Enter your name!';
	}
	if( empty($_POST['service_type']) ){
		$err_array['service_type']= 'Please select service type!';
	}
// 	if( empty($_POST['brand']) ){
// 		$err_array['service_type']= 'Please select brand!';
// 	}
	if( empty($_POST['city']) ){
		$err_array['city']= 'Enter your city name!';
	}


	if( $_POST['mobile'] ){
		$mobileregex = "/^[6-9][0-9]{9}$/" ;  
		if( !preg_match($mobileregex, $_POST['mobile']) ){
			$err_array['mobile'] = "Enter 10-digit mobile number";
		}
	}

	if(!empty($err_array)){
		echo json_encode( $err_array ); die();	
	}
	
	$service_type = isset($_POST['service_type']) ? $_POST['service_type'] : '';  
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
	$city =isset($_POST['city']) ? $_POST['city'] : '';
	$brand =isset($_POST['brand']) ? $_POST['brand'] : '';

	$mail = new PHPMailer();

	$mail->IsSMTP(); 
	                                     // set mailer to use SMTP
	$mail->Host = "88.99.99.104";  // specify main and backup server
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "info@bonitaa.in";  // SMTP username
	$mail->Password = "mJ&Rmh8F36]H"; // SMTP password

	$mail->From = "info@bonitaa.in";
	$mail->FromName = "Bonitaa - Salon at Home";
	$mail->AddAddress("mohit@techdost.com", "Bonitaa - Salon at Home");
	$mail->AddAddress("shanideshwal95@gmail.com", "Bonitaa - Salon at Home");
	$mail->AddAddress("bonitaaservices@gmail.com", "Bonitaa - Salon at Home");
	// $mail->addReplyTo($email, $name);


	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	///$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
	$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = "Query From ";
	$mail->Body = "Hi team,<br/><br/>You have received a new query from your website:<br/><br/><b>Name - </b>".$name."<br/><br/><b>Phone - </b>".$mobile."<br/><br/><b>Service Type - </b>".$service_type."<br/><br/><b>City - </b>".$city."<br/><br/>Note: This query was submitted through the website: https://techdost.in/bonitaa/";
	$mail->AltBody =date("Y-m-d H:i:s");

	if(!$mail->send()) {	
		    $array = array('err' => 'Something went wrong!');
		    echo json_encode( $array ); die();
		} 
		else 
		{
		    $array = array('msg' => 'We have received your query, our team will respond you shortly.');
		    echo json_encode( $array ); die();
		}

}



?>
