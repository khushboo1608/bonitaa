<?php 

require('config.inc.php');
include("../inc/GCM.php");

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d h:i:s");

$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';

// ****************************    Common LOGIN REGISTER API  *************************************

function hoursandmins($time)
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    
    if( $hours == 0 )
        return "{$minutes} minutes";
    else
        return "{$hours} hours {$minutes} minutes";
        
    // return sprintf($format, $hours, $minutes);
}


//demo details details
if(isset($_GET['pages_settings']))
{
	  
	$jsonObj= array();	

	$sql = "SELECT p.ID,p.status,p.page_name,p.page_url,p.details FROM pages p
	ORDER BY p.ID DESC";
	$result = mysqli_query($con,$sql);   

	while($data=mysqli_fetch_array($result))
	{
		// INSERT INTO `pages`(`ID`, `status`, `page_name`, `page_url`, `details`, `img`, `meta_title`, `meta_description`, `meta_keyword`, `createdon`, `modifiedon`) 
        
        $row1['ID'] = $data['ID'];
        $row1['status'] = $data['status'];
        $row1['page_name'] = $data['page_name'];
        $row1['page_url'] = $data['page_url'];
        $row1['details'] = $data['details'];
    

		array_push($jsonObj,$row1);
	
	}

	$set['JSON_DATA'] = $jsonObj;


	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	
}

else if(isset($_GET['settings']))
{
	  
	$jsonObj= array();	

	$sql = "SELECT * FROM settings s
	ORDER BY s.ID DESC";
	$result = mysqli_query($con,$sql);   

	while($data=mysqli_fetch_array($result))
	{
		if($data['app_logo'] != "")
	    {
	        $image = UPLOAD_PATH.''.$data['app_logo'];
	    }else
	    {
	        $image = ""; 
	        
	    }
	    
	    if($data['text3'] != "")
	    {
	        $qr_image = UPLOAD_PATH.''.$data['text3'];
	    }else
	    {
	        $qr_image = ""; 
	        
	    }
        
        $row1['ID'] = $data['ID'];
        $row1['email_from'] = $data['email_from'];
        $row1['firebase_server_key'] = $data['firebase_server_key'];
        $row1['onesignal_app_id'] = $data['onesignal_app_id'];
        $row1['onesignal_rest_key'] = $data['onesignal_rest_key'];
        $row1['app_name'] = $data['app_name'];
        $row1['app_logo'] = $image;
        $row1['app_email'] = $data['app_email'];
        $row1['app_author'] = $data['app_author'];
        $row1['app_contact'] = $data['app_contact'];
        $row1['app_website'] = $data['app_website'];
        $row1['app_description'] = $data['app_description'];
        $row1['app_developed_by'] = $data['app_developed_by'];
        $row1['app_version'] = $data['app_version'];
        $row1['app_update_status'] = $data['app_update_status'];
        $row1['app_maintenance_status'] = $data['app_maintenance_status'];
        $row1['app_maintenance_description'] = $data['app_maintenance_description'];
        $row1['app_update_description'] = $data['app_update_description'];
        $row1['app_update_cancel_button'] = $data['app_update_cancel_button'];
        $row1['app_update_factor_button'] = $data['app_update_factor_button'];
        $row1['factor_apikey'] = $data['factor_apikey'];
        $row1['payment_type'] = $data['payment_type'];
        $row1['payment_test_id'] = $data['payment_test_id'];
        $row1['payment_live_id'] = $data['payment_live_id'];
        $row1['payment_mode'] = $data['payment_mode'];
        $row1['map_api_key'] = $data['map_api_key'];
        $row1['razorpay_key'] = $data['razorpay_key'];
        $row1['text1'] = $data['text1'];
        $row1['text2'] = $data['text2'];
        $row1['qr_code_image'] = $qr_image;
        $row1['app_about_us'] = $data['text4'];
        $row1['app_contact_us'] = $data['text5'];
        $row1['app_privacy_policy'] = $data['text6'];
        $row1['app_terms_condition'] = $data['text7'];
        $row1['app_cancellation_refund'] = $data['text8'];
        $row1['app_comapny_info'] = $data['text9'];
        $row1['app_bb_agrement'] = $data['text10'];
        $row1['app_fee_fine'] = $data['text11'];
        $row1['status'] = $data['status'];
    

		array_push($jsonObj,$row1);
	
	}

	$set['JSON_DATA'] = $jsonObj;


	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	
}


// Normal Registration
else if(isset($_GET['user_register']))
{
    	
    	if(isset($_POST['user_name']) && !empty($_POST['user_name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && 
    	!empty($_POST['password']) && isset($_POST['phone']) && !empty($_POST['phone'])){
		    	
		    	$qry = "SELECT * FROM user_registration WHERE email = '".$_POST['email']."' and status=1 "; 
				$result = mysqli_query($con,$qry);
				$row = mysqli_fetch_assoc($result);
				$fetch_email = mysqli_num_rows($result);

		 	 	if($fetch_email >=1){
					$set['JSON_DATA'][]=array('msg' => "The mobile number you entered already exists. Please try with another number.",'success'=>'0');
		           
				}else{
						$ext="";
						if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
						  $filename    = strtolower(basename($_FILES['dp']['name']));
						  $ext         = substr($filename, strrpos($filename, '.') + 1);
						  $namefile    = str_replace(".$ext","", $filename);
						  $newfilename = "users-".date("ymdHis");
						  //Determine the path to which we want to save this file
						  $ext=".".$ext;
						  $newname = '../uploads/users/'.$newfilename.$ext;
						  move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
						} 
						if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  
				 		
				 		$text = '1234';

				 		$code = '1234';
				 		 

				     	$user_insert= "INSERT INTO `user_registration`(`status`, `name`, `address`, `email`, `mobile`, `alternate_mobile`, `password`, `dp`, `sessionid`, `ip`, `token`, `confirm_code`, `code`, `referral`, `wallet`, `createdon`)

				 		VALUES(1,'".$_POST['user_name']."','','".$_POST['email']."','".$_POST['phone']."','".$_POST['alternate_mobile']."','".$_POST['password']."','".$pic."','','','".$_POST['token']."','".$text."','".$code."','".$_POST['referral_code']."','0','".$now."')"; 

	   			    	$user_res = mysqli_query($con,$user_insert);
				 		// if (!mysqli_query($con,$user_insert)){}

	   			    	$last_id = mysqli_insert_id($con); 
                
                        $qrys = "SELECT *,r.ID FROM user_registration r WHERE r.ID = '".$last_id."'"; 
            			$results = mysqli_query($con,$qrys);
            			$row1 = mysqli_fetch_assoc($results);
    			
            			if($row1['dp'] != "")
					    {
					        $image = UPLOAD_PATH.'users/'.$row1['dp'];
					    }else
					    {
					        $image = ""; 
					        
					    }
					    //INSERT INTO `user_registration`(`ID`, `status`, `name`, `address`, `email`, `mobile`, `alternate_mobile`, `password`, `dp`, `sessionid`, `ip`, `token`, `confirm_code`, `code`, `referral`, `wallet`, `createdon`)
						if($user_res == TRUE)
	   					{
				    		$set['JSON_DATA'][]	= array(  
					            'msg'	=>	'Your registration successfully done.',
					            'success'=>'1',
					            'user_id'	=>	$row1['ID'],
								'user_name' =>	$row1['name'],
								'address'	=>	$row1['address'],
								'email'	=>	$row1['email'],
								'mobile'	=>	$row1['mobile'],
								'alternate_mobile'	=>	$row1['alternate_mobile'],
								'dp'	=>	$image,
								'password'	=>	$row1['password'],
								'sessionid'	=>	$row1['sessionid'],
								'ip'	=>	$row1['ip'],
								'token'	=>	$row1['token'],
								'confirm_code'	=>	$row1['confirm_code'],
								'code'	=>	$row1['code'],
								'referral'	=>	$row1['referral'],
								'wallet'	=>	$row1['wallet'],
								'createdon'	=>	$row1['createdon'],
								'status'	=>	$row1['status']
							);
	     								
	     								
	   					}else{
	   						$set['JSON_DATA'][]=array('msg' => "Sorry ! Your registration not done successfully. Please try again. ",'success'=>'0');
	   					}
		            
		    	}
		}else{
				$set['JSON_DATA'][]=array('msg' => "All fields are required.",'success'=>'0');
		        
		}  
		
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//OTP registration - sent otp
else if(isset($_GET['user_mobile_register'])) 
{   
// 	$qry = "SELECT * FROM user_registration WHERE mobile = '".$_POST['phone']."' and status=1 "; 
// 	$result = mysqli_query($con,$qry);
// 	$row = mysqli_fetch_assoc($result);
// 	$fetch_mobile = mysqli_num_rows($result);

// 	if($fetch_mobile >=1)
// 	{
	    
// 		$set['JSON_DATA'][]=array('msg' => "Your phone number is already registered. Please Login to continue.",'success'=>'0');
		
// 		header( 'Content-Type: application/json; charset=utf-8' );
// 		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
// 		die();
	
	    
// 	}else {
	    
        if($_POST['phone'] == '7777991598') 
        {
             
            $qry3 = "SELECT * FROM user_registration WHERE mobile = '".$_POST['phone']."' "; 	 
            $result3 = mysqli_query($con,$qry3);
            $row3 = mysqli_fetch_assoc($result3);
            $num_rows3 = mysqli_num_rows($result3);    
        
            if ($num_rows3 > 0 )
            {
            
                $user_edit1= "UPDATE user_registration SET confirm_code='1234' , token='".$_POST['token']."' WHERE mobile = '".$_POST['phone']."' "; 	
                $user_res1 = mysqli_query($con,$user_edit1);
       
               if($user_res1 == true)
        	   {
        		   $set['JSON_DATA'][]=array('msg' => "OTP sent your mobile number successfully.",'success'=>'1');
        	   }
        	   else{
        	    	$set['JSON_DATA'][]=array('msg' => "The OTP you've entered is incorrect. Please enter correct OTP.",'success'=>'0');
        	    }
                
                header( 'Content-Type: application/json; charset=utf-8' );
                echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                die();
    	   
            }  
        }else{
        
        	    
        	    $mobile = $_POST['phone'];
        		if($mobile!= "")
        		{
        			//$text='1234';
        			$text=rand(1000,9999);
        			
        			$qry2 = "SELECT * FROM user_registration WHERE mobile = '".$mobile."' and status=0 "; 	 
        			$result2 = mysqli_query($con,$qry2);
        			$row2 = mysqli_fetch_assoc($result2);
        			$num_rows2 = mysqli_num_rows($result2);
        			
        			if ($num_rows2 > 0 )
        			{
            			$user_edit= "UPDATE user_registration SET confirm_code='".$text."' , token='".$_POST['token']."' WHERE mobile = '".$mobile."' "; 	
            			$user_res = mysqli_query($con,$user_edit);
        	
        	
        		        sent_mobile_verify_otp($mobile, $text );
        			
        				$set['JSON_DATA'][]=array('msg' => "OTP sent your mobile number successfully.",'success'=>'1');
        			
        				header( 'Content-Type: application/json; charset=utf-8' );
        				echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        				die();
        			
        			}else
        			{
            			$qry2 = "SELECT * FROM user_registration WHERE mobile = '".$mobile."' and status=1 "; 	 
            			$result2 = mysqli_query($con,$qry2);
            			$row2 = mysqli_fetch_assoc($result2);
            			$num_rows2 = mysqli_num_rows($result2);
            			if ($num_rows2 > 0 )
        			    {
    			        	$user_edit= "UPDATE user_registration SET confirm_code='".$text."' , token='".$_POST['token']."' WHERE mobile = '".$mobile."' "; 	
                			$user_res = mysqli_query($con,$user_edit);
            	
            	
            		        sent_mobile_verify_otp($mobile, $text );
            			
            				$set['JSON_DATA'][]=array('msg' => "OTP sent your mobile number successfully.",'success'=>'1');
            			
            				header( 'Content-Type: application/json; charset=utf-8' );
            				echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            				die();
        			        
        			    }else{
        				$code = '1234';

        				$qry1="INSERT INTO `user_registration`(`status`, `name`, `address`, `email`, `mobile`, `alternate_mobile`, `password`, `dp`, `sessionid`, `ip`, `token`, `confirm_code`, `code`, `referral`, `wallet`, `createdon`) 
        				VALUES (
        				'0',
        				'',
        				'',
        				'',
        				'".$_POST['phone']."',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'".$_POST['token']."',
        				'".$text."',
        				'".$code."',
        				'',
        				'0',
        				'".$now."'
        				)"; 
        				$result11=mysqli_query($con,$qry1); 
        				
        				sent_mobile_verify_otp($mobile, $text );
        			    
        				
        				$set['JSON_DATA'][]=array('msg' => "OTP sent your mobile number successfully.",'success'=>'1');
        				
        				header( 'Content-Type: application/json; charset=utf-8' );
        				echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        				die();
        			}    
        			}
        		}else {
        		    
        		    $set['JSON_DATA'][]=array('msg' => "Please enter mobile number. It is compulsory.",'success'=>'0');
        			
        			header( 'Content-Type: application/json; charset=utf-8' );
        			echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        			die();
        			
        		}
        	//}
        }

	    
	//}

}


//after Register varify otp 
else if(isset($_GET['user_verify_otp']))
{
    if($_POST['phone']!="" and $_POST['confirm_code']!="")
    {
    	
        $mobile = $_POST['phone'];
        $confirm_code = $_POST['confirm_code'];
 
        $qry = "SELECT * FROM user_registration WHERE mobile = '".$mobile."' and confirm_code = '".$confirm_code."' "; 
        
        $result = mysqli_query($con,$qry);
        $num_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
    	

    	if ($num_rows > 0)
		{ 
// 			$user_update_status= "UPDATE user_registration SET status='1' WHERE ID='".$row['ID']."' "; 	
//         	$user_status = mysqli_query($con,$user_update_status);

		    $qry1 = "SELECT * FROM user_registration WHERE mobile = '".$mobile."' and confirm_code = '".$confirm_code."' "; 
        
            $result1 = mysqli_query($con,$qry1);
            $num_rows1 = mysqli_num_rows($result);
            $row1 = mysqli_fetch_assoc($result1);
    		
    		if($row1['dp'] != "")
		    {
		      $image = UPLOAD_PATH.'users/'.$row1['dp'];
		    }else
		    {
		        $image = ""; 
		        
		    }
		    $query1_address_get = "SELECT COUNT(*) as num FROM address WHERE user_id ='".$row1['ID']."' ";  
            $total_pages1 = mysqli_fetch_array(mysqli_query($con,$query1_address_get));
            $total_order = $total_pages1['num'];
            
            $set['JSON_DATA'][]	= array(  
            'msg' =>	"Your OTP has been verified successfully.",
            'success'=>'1',
           	'user_id'	=>	$row1['ID'],
			'user_name' =>	$row1['name'],
			'address'	=>	$row1['address'],
			'email'	=>	$row1['email'],
			'mobile'	=>	$row1['mobile'],
			'alternate_mobile'	=>	$row1['alternate_mobile'],
			'dp'	=>	$image,
			'password'	=>	$row1['password'],
			'sessionid'	=>	$row1['sessionid'],
			'ip'	=>	$row1['ip'],
			'token'	=>	$row1['token'],
			'confirm_code'	=>	$row1['confirm_code'],
			'code'	=>	$row1['code'],
			'referral'	=>	$row1['referral'],
			'wallet'	=>	$row1['wallet'],
			'createdon'	=>	$row1['createdon'],
			'address_count'	=>	$total_order,
			'status'	=>	$row1['status']
            );
    		  
    	}		 
    	else
    	{
    		$set['JSON_DATA'][]=array('msg' =>'The OTP you have entered is incorrect. Please enter correct OTP.','success'=>'0');
    	}
    }else{
    		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!   ",'success'=>'0');
    }
    
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


// Normal login 
else if(isset($_GET['user_login'])) 
{
    	
    	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
		    	
		    	$qry = "SELECT * FROM user_registration WHERE (email = '".$_POST['email']."' OR mobile='".$_POST['email']."') AND password='".$_POST['password']."'";
				$result = mysqli_query($con,$qry);
				$row = mysqli_fetch_assoc($result);
				$fetch_email = mysqli_num_rows($result);
				
		 	 	if($fetch_email ==1)
				{	

					if($row['status']==1){

						$user_update_token= "UPDATE user_registration SET token='".$_POST['token']."' WHERE ID='".$row['ID']."' "; 	
        				$user_token = mysqli_query($con,$user_update_token);
                        
                        $qry1 = "SELECT * FROM user_registration WHERE (email = '".$_POST['email']."' OR mobile='".$_POST['email']."') AND password='".$_POST['password']."'";
        				$result1 = mysqli_query($con,$qry1);
        				$row1 = mysqli_fetch_assoc($result1);
                        
						if(!empty($row1['dp'])){
							$imageurl = UPLOAD_PATH.'users/'.$row1['dp'];
						}else{
							$imageurl ="";
						}
						$set['JSON_DATA'][]	= array(  
									            'msg'	=>	'Login Successfully.',
									            'success'=>'1',
									            'user_id'	=>	$row1['ID'],
												'user_name' =>	$row1['name'],
												'address'	=>	$row1['address'],
												'email'	=>	$row1['email'],
												'mobile'	=>	$row1['mobile'],
												'alternate_mobile'	=>	$row1['alternate_mobile'],
												'dp'	=>	$imageurl,
												'password'	=>	$row1['password'],
												'sessionid'	=>	$row1['sessionid'],
												'ip'	=>	$row1['ip'],
												'token'	=>	$row1['token'],
												'confirm_code'	=>	$row1['confirm_code'],
												'code'	=>	$row1['code'],
												'referral'	=>	$row1['referral'],
												'wallet'	=>	$row1['wallet'],
												'createdon'	=>	$row1['createdon'],
												'status'	=>	$row1['status']
	     								);
					}else{
						$set['JSON_DATA'][]=array('msg' => "Your account has been disabled. Please contact administrator.",'success'=>'0');
					}
					
		            
				}else if($fetch_email >=1){
					$set['JSON_DATA'][]=array('msg' => "Your account is incorrupt, More than one user is used this mobile no ...!",'success'=>'0');
		           
				}else{
					$set['JSON_DATA'][]=array('msg' => "Please enter a correct username or password.",'success'=>'0');
		    	}
		}else{
				$set['JSON_DATA'][]=array('msg' => "Phone and password fields are require",'success'=>'0');
		        
		}  
		
		        header( 'Content-Type: application/json; charset=utf-8' );
		        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

// user profile
// else if(isset($_GET['user_profile']))
// {
    	
// 	if(isset($_POST['user_id']) && !empty($_POST['user_id']) )
// 	{
	    	
// 	    	$qry = "SELECT * FROM user_registration WHERE ID='".$_POST['user_id']."'"; 
// 			$result = mysqli_query($con,$qry);
// 			$row1 = mysqli_fetch_assoc($result);
// 			$fetch_email = mysqli_num_rows($result);
			
// 	 	 	if($fetch_email ==1)
// 			{
// 				if(!empty($row1['dp'])){
// 					$imageurl = UPLOAD_PATH.'users/'.$row1['dp'];
// 				}else{
// 					$imageurl ="";
// 				}
// 				$set['JSON_DATA'][]	= array(
// 							            'msg'	=>	'Successfully Logged in',
// 							            'success'=>'1',
// 										'user_id'	=>	$row1['ID'],
// 										'user_name' =>	$row1['name'],
// 										'address'	=>	$row1['address'],
// 										'email'	=>	$row1['email'],
// 										'mobile'	=>	$row1['mobile'],
// 										'alternate_mobile'	=>	$row1['alternate_mobile'],
// 										'dp'	=>	$imageurl,
// 										'password'	=>	$row1['password'],
// 										'sessionid'	=>	$row1['sessionid'],
// 										'ip'	=>	$row1['ip'],
// 										'token'	=>	$row1['token'],
// 										'confirm_code'	=>	$row1['confirm_code'],
// 										'code'	=>	$row1['code'],
// 										'referral'	=>	$row1['referral'],
// 										'wallet'	=>	$row1['wallet'],
// 										'createdon'	=>	$row1['createdon'],
// 										'status'	=>	$row1['status']
// 								);
// 			}else{
// 				$set['JSON_DATA'][]=array('msg' => "Client account disable...!",'success'=>'0');
// 	    	}
// 	}else{
// 			$set['JSON_DATA'][]=array('msg' => "Something want wrong",'success'=>'0');
	        
// 	}  

//     header( 'Content-Type: application/json; charset=utf-8' );
//     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
// 	die();
// }

// user profile
else if(isset($_GET['user_profile']))
{
    	
	if(isset($_POST['user_id']) && !empty($_POST['user_id']) )
	{
	    	
	    	$qry = "SELECT *,user_registration.city_id as cityid, city.name as cityname,user_registration.ID as userid, user_registration.name as username FROM user_registration 
			left join city on city.ID = user_registration.city_id
			WHERE user_registration.ID='".$_POST['user_id']."'"; 
			$result = mysqli_query($con,$qry);
			$row1 = mysqli_fetch_assoc($result);
			$fetch_email = mysqli_num_rows($result);
			
	 	 	if($fetch_email ==1)
			{
				if(!empty($row1['dp'])){
					$imageurl = UPLOAD_PATH.'users/'.$row1['dp'];
				}else{
					$imageurl ="";
				}
				$set['JSON_DATA'][]	= array(
							            'msg'	=>	'Successfully Logged in',
							            'success'=>'1',
										'user_id'	=>	$row1['userid'],
										'user_name' =>	$row1['username'],
										'address'	=>	$row1['address'],
										'email'	=>	$row1['email'],
										'mobile'	=>	$row1['mobile'],
										'alternate_mobile'	=>	$row1['alternate_mobile'],
										'dp'	=>	$imageurl,
										'city_id'	=>	$row1['cityid'],
										'city_name'	=>	$row1['cityname'],
										'password'	=>	$row1['password'],
										'sessionid'	=>	$row1['sessionid'],
										'ip'	=>	$row1['ip'],
										'token'	=>	$row1['token'],
										'confirm_code'	=>	$row1['confirm_code'],
										'code'	=>	$row1['code'],
										'referral'	=>	$row1['referral'],
										'wallet'	=>	$row1['wallet'],
										'createdon'	=>	$row1['createdon'],
										'status'	=>	$row1['status']
								);
			}else{
				$set['JSON_DATA'][]=array('msg' => "Client account disable...!",'success'=>'0');
	    	}
	}else{
			$set['JSON_DATA'][]=array('msg' => "Something want wrong",'success'=>'0');
	        
	}  

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


// user update profile
else if(isset($_GET['user_profile_update']))
{
		if(isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['user_name']) && !empty($_POST['user_name']) )
		{
		
			$sql = "SELECT * FROM user_registration where ID = '".$_POST['user_id']."' ";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_assoc($res);
			
			$num_rows2 = mysqli_num_rows($res);
	    		
	        if ($num_rows2 > 0 )
	        {	
	   //     	$sql_email = "SELECT * FROM user_registration where email='".$_POST['email']."' AND ID != '".$_POST['user_id']."'";
				// $email_res = mysqli_query($con,$sql_email);
				// $email_row = mysqli_fetch_assoc($email_res);
				// $email_num = mysqli_num_rows($email_res);
				// if($email_num > 0){
				// 	$set['JSON_DATA'][]=array('msg'=>'The email address you have entered is already registered. Please use another email address.','success'=>'0');
				// }else{


					$referral=$_POST['referral'];
			        $sql_code_check = "SELECT * FROM user_registration where code='".$referral."' ";
			        $code_res = mysqli_query($con,$sql_code_check);
			        $code_row = mysqli_fetch_assoc($code_res);
			        $code_num = mysqli_num_rows($code_res);

			        $user_parent_amount = '10';
			        $user_child_amount = '20';

			        if($code_row >0){

			        	$parent=$user_parent_amount;
			        	$parent_user_name=$code_row['name'];
			        	$parent_user_id = $code_row['ID'];
			        	$parent_wallet=$row['wallet'];
			        	$parent_final_wallet=$parent_wallet + $parent;
			        	
			        	$child_earn=$user_child_amount;

			        	$childwallet_amt =$code_row['wallet'];
			        	$add_wallet= $childwallet_amt + $child_earn ;
			        	
			        	$update_parent_wallet= "UPDATE user_registration SET wallet='".$add_wallet."' WHERE ID='".$code_row['ID']."'";
			            $user_parent_res = mysqli_query($con,$update_parent_wallet);
			            
			            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
				        $cur_date = date("Y-m-d h:i:s");
			        	$cur_date1 = date('Y-m-d');
			        	
			        	// INSERT INTO `wallet_history`(`wh_id`, `wh_user_id`, `wh_amount`, `description`, `wh_type`, `wallet_date`, `wallet_status`)

			            $parent_description=$_POST['user_name']." uses your referral code";
			            $parentuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$parent_user_id."','".$child_earn."','".$parent_description."','1','1','".$cur_date."','1')";
			            $parentuser_res = mysqli_query($con,$parentuser_wallet);


			            $child_description=$_POST['user_name']." uses referral code for ".$parent_user_name;
			            $childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$_POST['user_id']."','".$parent."','".$child_description."','1','2','".$cur_date."','1')";
			            $childuser_res = mysqli_query($con,$childuser_wallet);

			            $update_child_wallet= "UPDATE user_registration SET wallet='".$parent_final_wallet."' WHERE ID='".$_POST['user_id']."'";
			            $user_child_res = mysqli_query($con,$update_child_wallet);


                        
                         
                        $user_edit= "UPDATE user_registration SET name='".$_POST['user_name']."', email='".$_POST['email']."', password='".$_POST['password']."',referral='".$_POST['referral']."',city_id='".$_POST['city_id']."',status = 1 WHERE ID = '".$_POST['user_id']."'";	 
		   			
		   			    $user_res = mysqli_query($con,$user_edit);
                            
                        
				
		   			
		   			

					$ext="";
					if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
					  $filename    = strtolower(basename($_FILES['dp']['name']));
					  $ext         = substr($filename, strrpos($filename, '.') + 1);
					  $namefile    = str_replace(".$ext","", $filename);
					  $newfilename = "users-".date("ymdHis");
					  //Determine the path to which we want to save this file
					  $ext=".".$ext;
					  $newname = '../uploads/users/'.$newfilename.$ext;
					  move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
					} 

					if($ext!=""){$pic="$newfilename$ext";

					 $user_image_edit= "UPDATE user_registration SET `dp`='$pic' WHERE ID='".$_POST['user_id']."'";	 
		   			
		   			$user_res = mysqli_query($con,$user_image_edit);	
					}
				 
                    $qrys = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."'"; 
        			$results = mysqli_query($con,$qrys);
        			$row1 = mysqli_fetch_assoc($results);
			
        			if($row1['dp'] != "")
				    {
				        $image = UPLOAD_PATH.'users/'.$row1['dp'];
				    }else
				    {
				        $image = ""; 
				        
				    }
					    
					    
   					if($user_res==true)
   					{

			    		$set['JSON_DATA'][]	= array(  
			            'msg'	=>	'Your profile is updated successfully.',
			            'success'=>'1',
			            'user_id'	=>	$row1['ID'],
						'user_name' =>	$row1['name'],
						'address'	=>	$row1['address'],
						'email'	=>	$row1['email'],
						'mobile'	=>	$row1['mobile'],
						'alternate_mobile'	=>	$row1['alternate_mobile'],
						'dp'	=>	$image,
						'password'	=>	$row1['password'],
						'sessionid'	=>	$row1['sessionid'],
						'ip'	=>	$row1['ip'],
						'token'	=>	$row1['token'],
						'confirm_code'	=>	$row1['confirm_code'],
						'code'	=>	$row1['code'],
						'referral'	=>	$row1['referral'],
						'wallet'	=>	$row1['wallet'],
						'createdon'	=>	$row1['createdon'],
						'status'	=>	$row1['status']
						);
     								
     								
   					}else{
        	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
        	        }
					
				}else{
				    
				    
				      $user_edit= "UPDATE user_registration SET name='".$_POST['user_name']."', email='".$_POST['email']."', password='".$_POST['password']."',referral='',city_id='".$_POST['city_id']."',status = 1 WHERE ID = '".$_POST['user_id']."'";	 
		   			
		   			  $user_res = mysqli_query($con,$user_edit);
                            

					$ext="";
					if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
					  $filename    = strtolower(basename($_FILES['dp']['name']));
					  $ext         = substr($filename, strrpos($filename, '.') + 1);
					  $namefile    = str_replace(".$ext","", $filename);
					  $newfilename = "users-".date("ymdHis");
					  //Determine the path to which we want to save this file
					  $ext=".".$ext;
					  $newname = '../uploads/users/'.$newfilename.$ext;
					  move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
					} 

					if($ext!=""){$pic="$newfilename$ext";

					 $user_image_edit= "UPDATE user_registration SET `dp`='$pic' WHERE ID='".$_POST['user_id']."'";	 
		   			
		   			$user_res = mysqli_query($con,$user_image_edit);	
					}
				 
                    $qrys = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."'"; 
        			$results = mysqli_query($con,$qrys);
        			$row1 = mysqli_fetch_assoc($results);
			
        			if($row1['dp'] != "")
				    {
				        $image = UPLOAD_PATH.'users/'.$row1['dp'];
				    }else
				    {
				        $image = ""; 
				        
				    }
					    
					    
   					if($user_res==true)
   					{

			    		$set['JSON_DATA'][]	= array(  
			            'msg'	=>	'Your profile is updated successfully.',
			            'success'=>'1',
			            'user_id'	=>	$row1['ID'],
						'user_name' =>	$row1['name'],
						'address'	=>	$row1['address'],
						'email'	=>	$row1['email'],
						'mobile'	=>	$row1['mobile'],
						'alternate_mobile'	=>	$row1['alternate_mobile'],
						'dp'	=>	$image,
						'password'	=>	$row1['password'],
						'sessionid'	=>	$row1['sessionid'],
						'ip'	=>	$row1['ip'],
						'token'	=>	$row1['token'],
						'confirm_code'	=>	$row1['confirm_code'],
						'code'	=>	$row1['code'],
						'referral'	=>	$row1['referral'],
						'wallet'	=>	$row1['wallet'],
						'createdon'	=>	$row1['createdon'],
						'status'	=>	$row1['status']
						);
     								
     								
   					}else{
        	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
        	        }
				}
			//}
	        }else{
	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
	        }
			
		}else{
				$set['JSON_DATA'][]=array('msg' => "Username,email,password,mobile no fields are require ",'success'=>'0');
		}
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

//logout users
else if(isset($_GET['user_logout']))
{
	if($_POST['user_id']!="" )
	{
	
		$user_id = $_POST['user_id'];

		$user_edit= "UPDATE user_registration SET token = '' WHERE ID = '".$user_id."'  "; 
        $user_res = mysqli_query($con,$user_edit);

			$set['JSON_DATA'][]	= array(  
			'msg' =>	"Successfully Logout.",
			'success'=>'1'
	     	);	  
    
    }else {
		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
	}

	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

//get all banner
else if(isset($_GET['get_banner']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,c.ID as catid,c.category as catname,b.ID as bannerid,b.title as bannertitle,b.subtitle as bannersubtitle,b.pic as bannerimage,b.status as bannerstatus FROM banner b
		LEFT JOIN category c ON c.ID = b.category_id
        where b.hide = 0 and b.type = '".$_POST['type']."' and b.category_id = '".$_POST['category_id']."'
        ORDER BY b.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['bannerimage'])){
          	    $image = UPLOAD_PATH.'banner/'.$data['bannerimage'];
          	}else{
          	    $image='';
          	}
            $row1['banner_id'] = $data['bannerid'];
            if($data['catid'] == null or $data['catname'] == null)
            {
            	$row1['category_id'] = '0';
            	$row1['category_name'] = '';
            }else{
            	$row1['category_id'] = $data['catid'];
            	$row1['category_name'] = $data['catname'];
            }
           
            $row1['banner_name'] = $data['bannertitle'];
            $row1['banner_image'] = $image;
            $row1['banner_status'] = $data['bannerstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

// ------------------------------ ADDRESS API -----------------------------------

//get all state
else if(isset($_GET['get_state']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,s.name as statename,s.ID as stateid,s.status as statestatus FROM `state` s
        WHERE s.status=1
        ORDER BY s.ID  DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			
            $row1['state_id'] = $data['stateid'];
            $row1['state_name'] = $data['statename'];
            $row1['state_status'] = $data['statestatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all city state wise
else if(isset($_GET['get_city']))
{
  		$jsonObj4= array();
        
  		if($_POST['state_id'] == 0)
  		{
  			$query="SELECT *,c.ID as cityid,c.status as citystatus,c.name as cityname,s.name as statename,s.ID as stateid,s.status as statestatus FROM `city` c
			LEFT JOIN state s ON s.ID = c.state_id
			ORDER BY c.ID DESC";

  		}else{

  			$query="SELECT *,c.ID as cityid,c.status as citystatus,c.name as cityname,s.name as statename,s.ID as stateid,s.status as statestatus FROM `city` c
			LEFT JOIN state s ON s.ID = c.state_id
			WHERE c.state_id='".$_POST['state_id']."'
			ORDER BY c.ID DESC";

  		}

        
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			$row1['city_id'] = $data['cityid'];
            $row1['state_id'] = $data['stateid'];
            $row1['state_name'] = $data['statename'];
            $row1['city_name'] = $data['cityname'];
            $row1['city_status'] = $data['citystatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all city state wise
else if(isset($_GET['get_pincode']))
{
  		$jsonObj4= array();

  		$query="SELECT *,p.ID as pincodeid,c.ID as cityid,c.status as citystatus,c.name as cityname,s.name as statename,s.ID as stateid,p.status as pincodestatus,p.name as pincodename FROM `pincode` p
		LEFT JOIN state s ON s.ID = p.state_id
		LEFT JOIN city c ON c.ID = p.city_id
		WHERE p.state_id='".$_POST['state_id']."' and p.city_id='".$_POST['city_id']."'
		ORDER BY c.ID DESC";

		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{
		    $row1['pincode_id'] = $data['pincodeid'];
			$row1['city_id'] = $data['cityid'];
            $row1['state_id'] = $data['stateid'];
            $row1['state_name'] = $data['statename'];
            $row1['city_name'] = $data['cityname'];
            $row1['pincode_code'] = $data['pincodename'];
            $row1['pincode_status'] = $data['pincodestatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//add Adderss Details
else if(isset($_GET['user_add_address']))
{

  	if($_POST['user_id']!="" AND $_POST['a_type']!="" AND $_POST['a_name']!="" AND $_POST['a_number']!="" AND $_POST['a_house_no']!="" AND $_POST['a_lendmark']!="" AND $_POST['a_address']!="")
  	{
  			$qry1="INSERT INTO `address`(`status`, `user_id`, `type`, `name`, `number`, `houser_no`, `lendmark`, `adderss`, `state_id`,`city_id`, `pincode`, `latitude`, `longitude`) 
  				VALUES ('1','".$_POST['user_id']."','".$_POST['a_type']."','".$_POST['a_name']."','".$_POST['a_number']."','".$_POST['a_house_no']."','".$_POST['a_lendmark']."','".$_POST['a_address']."','".$_POST['state_id']."','".$_POST['city_id']."','".$_POST['pincode']."','".$_POST['a_lat']."','".$_POST['a_long']."')"; 
	  		
           
            $result1=mysqli_query($con,$qry1);  									 
		
			$last_id = mysqli_insert_id($con); 
 

			$qrys = "SELECT * FROM address WHERE ID = '".$last_id."'"; 
			$results = mysqli_query($con,$qrys);
			$row1 = mysqli_fetch_assoc($results);
			
				$set['JSON_DATA'][]	=	array( 
				'msg' =>	" Successfully",
				'success'=>'1',
				'a_id'	=>	$row1['ID'],
				'user_id' =>	$row1['user_id'],
				'a_type'	=>	$row1['type'],
				'a_name'	=>	$row1['name'],
				'a_number'	=>	$row1['number'],
				'a_house_no'	=>	$row1['houser_no'],
				'a_lendmark'	=>	$row1['lendmark'],
				'a_address'	=>	$row1['adderss'],
				'state_id'	=>	$row1['state_id'],
				'city_id'	=>	$row1['city_id'],
				'pincode'	=>	$row1['pincode'],
				'a_lat'	=>	$row1['latitude'],
				'a_long'	=>	$row1['longitude'],
				'a_status'	=>	$row1['status']

				);
			
			
				
		}
		else{
			$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
		}	
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
}


//get all adderss with user wise
else if(isset($_GET['user_get_address']))
{

		$jsonObj1= array();


		$query="SELECT *,u.ID as userid,u.name as username,s.ID as stateid,s.name as statename,c.ID as cityid,c.name as cityname,a.ID as adderssid,a.status as adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as addersses,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as adderssnumber,a.lendmark as addersslendmark,p.ID as pincodeid,p.name as pincodename  FROM `address` a
			LEFT JOIN user_registration u ON u.ID = a.user_id
			LEFT JOIN state s ON s.ID = a.state_id
			LEFT JOIN city c ON c.ID = a.city_id
			LEFT JOIN pincode p ON p.ID = a.pincode
			WHERE a.user_id = '".$_POST['user_id']."' and a.status = 1
			ORDER BY a.ID DESC";

		$sql = mysqli_query($con,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{

				$row1['a_id'] = $data['adderssid'];
				$row1['user_id'] = $data['userid'];
				$row1['user_name'] = $data['username'];
				$row1['a_type'] = $data['addersstype'];
				$row1['a_name'] = $data['adderssname'];
				$row1['a_number'] = $data['adderssnumber'];
				$row1['a_house_no'] = $data['addersshouserno'];
				$row1['a_lendmark'] = $data['addersslendmark'];
				$row1['a_address'] = $data['addersses'];
				

				if($data['stateid']== null or $data['statename']==null )
				{
				    $row1['state_id'] = "0";
					$row1['state_name'] = "0";
				}else{
				    $row1['state_id'] = $data['stateid'];
					$row1['state_name'] = $data['statename'];
				}

				if($data['cityid']== null or $data['cityname']==null )
				{
				    $row1['city_id'] = "0";
					$row1['city_name'] = "";
				}else{
				    $row1['city_id'] = $data['cityid'];
					$row1['city_name'] = $data['cityname'];
				}
				
				if($data['pincodeid']== null or $data['pincodename']==null )
				{
				    $row1['pincode_id'] = "0";
					$row1['pincode_code'] = "";
				}else{
				    $row1['pincode_id'] = $data['pincodeid'];
					$row1['pincode_code'] = $data['pincodename'];
				}
				
				// $row1['a_pincode'] = $data['addersspincode'];
				$row1['a_lat'] = $data['addersslatitude'];
				$row1['a_long'] = $data['addersslongitude'];
				$row1['a_status'] = $data['adderssstatus'];

				array_push($jsonObj1,$row1);

		
		}
		
		$set['JSON_DATA'] = $jsonObj1;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//edit address details
else if(isset($_GET['user_update_address']))
{

  if($_POST['user_id']!="" and $_POST['a_type']!="" and $_POST['a_name']!="" and $_POST['a_number']!="" and $_POST['a_house_no']!="" and $_POST['a_lendmark']!="" and $_POST['a_address']!=""  )
		{
		    //INSERT INTO `address`(`ID`, `status`, `user_id`, `type`, `name`, `number`, `houser_no`, `lendmark`, `adderss`, `state_id`, `city_id`, `pincode`, `latitude`, `longitude`)
			    
				$user_edit="UPDATE `address` SET `user_id`='".$_POST['user_id']."',`type`='".$_POST['a_type']."',`name`='".$_POST['a_name']."',`number`='".$_POST['a_number']."',`houser_no`='".$_POST['a_house_no']."',`lendmark`='".$_POST['a_lendmark']."',`adderss`='".$_POST['a_address']."',`state_id`='".$_POST['state_id']."',`city_id`='".$_POST['city_id']."',`pincode`='".$_POST['pincode']."',`latitude`='".$_POST['a_lat']."',`longitude`='".$_POST['a_long']."' WHERE `ID`='".$_POST['a_id']."'";
					
				$user_res = mysqli_query($con,$user_edit);	
	
	  			$set['JSON_DATA'][]=array('msg'=>'Updated','success'=>'1');
			
		
		}else{
		    	$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
		}
		
   		
   		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//delete address
else if(isset($_GET['user_delete_address']))
{

		$jsonObj= array();
 		$a_id=$_POST['a_id'];

		if($_POST['a_id'] != "") 
		{

		$qry = "SELECT * FROM address WHERE ID='".$a_id."'"; 
			
		$result 	= mysqli_query($con,$qry);
		$num_rows 	= mysqli_num_rows($result);
			//$row = mysqli_fetch_array($result);
			
			if($num_rows > 0)
			{
			
				// $delete = "DELETE FROM tbl_address where a_id = '".$a_id."'";
				// $result1 = mysqli_query($mysqli,$delete);
				
				$delete="UPDATE `address` SET `status`= 0 WHERE `ID`='".$a_id."'";
	  			$result1 = mysqli_query($con,$delete);

				if($result1 == 1)
					$set['JSON_DATA'][]=array('msg' => "Address deleted successfully...!",'success'=>'1');
				else
					$set['JSON_DATA'][]=array('msg' => "Some error occured",'success'=>'0');
				

			}
			else
			{	
				$set['JSON_DATA'][]=array('msg' => "Address Not  found",'success'=>'0');
			} 
		 	
		}
		else
		{
			$set['JSON_DATA'][]=array('msg' => "Please enter address id",'success'=>'0');
		}	 

		header( 'Content-Type: application/json; charset=utf-8' );
   		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
		
}


// ****************************    MAIN API  *************************************

//get all category
else if(isset($_GET['get_category']))
{
  		$jsonObj4= array();
        
        $query="SELECT * FROM category c
        where c.status = 1
        ORDER BY c.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `category`(`ID`, `status`, `category`, `categoryurl`, `description`, `pic`, `createdon`, `modifiedon`, `rd`, `date`, `time`, `sort`, `hide`)

          	if(!empty($data['pic'])){
          	    $image = UPLOAD_PATH.'category/'.$data['pic'];
          	}else{
          	    $image='';
          	}
            $row1['category_id'] = $data['ID'];
            $row1['category_name'] = $data['category'];
            $row1['category_url'] = $data['categoryurl'];
            $row1['category_image'] = $image;
            $row1['category_description'] = $data['description'];
            $row1['category_status'] = $data['status'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get sub category category wise 
else if(isset($_GET['get_sub_category']))
{
  		$jsonObj4= array();
        
        if(!empty($_POST['category_id'])){
            $query="SELECT *,s.ID as subid, c.ID as catid,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.category_id = '".$_POST['category_id']."' and s.status = 1 
    		ORDER BY s.sort ASC";
        }else{
            $query="SELECT *,s.ID as subid, c.ID as catid,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.status = 1 
    		ORDER BY s.sort ASC";
        }
        
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `subcategory`(`ID`, `status`, `category_id`, `subcategory`, `description`, `subcategoryurl`, `pic`, `createdon`, `modifiedon`, `rd`, `date`, `time`, `sort`, `hide`)

          	if(!empty($data['subimage'])){
          	    $image = UPLOAD_PATH.'subcategory/'.$data['subimage'];
          	}else{
          	    $image='';
          	}
          	$row1['sub_category_id'] = $data['subid'];
            $row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category'];
            $row1['sub_category_name'] = $data['subcategory'];
            $row1['sub_category_url'] = $data['subcategoryurl'];
            
            $row1['sub_category_image'] = $image;
            $row1['sub_category_description'] = $data['description'];
            $row1['sub_category_status'] = $data['substatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get sub sub category  category and sub category wise
else if(isset($_GET['get_sub_sub_category']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
		LEFT JOIN category c ON c.ID = subsubcat.category
		LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
		WHERE subsubcat.category = '".$_POST['category_id']."' and subsubcat.subcategory = '".$_POST['sub_category_id']."' and subsubcat.status = 1
		ORDER BY subsubcat.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['subsubimage'])){
          	    $image = UPLOAD_PATH.'subsubcategory/'.$data['subsubimage'];
          	}else{
          	    $image='';
          	}
          	$row1['sub_sub_category_id'] = $data['subsubid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];

            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['sub_sub_category_url'] = $data['subsubcategoryurl'];
            $row1['sub_sub_category_image'] = $image;
            $row1['sub_sub_category_description'] = $data['subsubdescription'];
            $row1['sub_sub_category_status'] = $data['subsubstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get services list category, sub category and sub sub category wise
else if(isset($_GET['get_services']))
{
  		$jsonObj4= array();
  		
        $tableName="services";   
        $limit = 10; 

        $query = "SELECT COUNT(*) as num FROM `services` s 
		LEFT JOIN category c ON c.ID = s.category
		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
		WHERE s.category = '".$_POST['category_id']."' AND s.subcategory = '".$_POST['sub_category_id']."' AND s.subsubcategory = '".$_POST['sub_sub_category_id']."' and s.status = 1
		ORDER BY s.sort ASC
        ";
	      
	      $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
	      $total_pages = $total_pages['num'];
	      
	      $stages = 3;
	      $page=0;
	      if(isset($_POST['page'])){
	      $page = mysqli_real_escape_string($con,$_POST['page']);
	      }
	      if($page){
	        $start = ($page - 1) * $limit; 
	      }else{
	        $start = 0; 
	        } 
	        
         $query="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
		LEFT JOIN category c ON c.ID = s.category
		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
		WHERE s.category = '".$_POST['category_id']."' AND s.subcategory = '".$_POST['sub_category_id']."' AND s.subsubcategory = '".$_POST['sub_sub_category_id']."' and s.status = 1
		ORDER BY s.sort ASC LIMIT $start, $limit";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['serviceimage'])){
          	    $image = UPLOAD_PATH.'service/'.$data['serviceimage'];
          	}else{
          	    $image='';
          	}
          	
          	$row1['service_id'] = $data['serviceid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];
            $row1['sub_sub_category_id'] = $data['subsubid'];
            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['service_type'] = $data['type'];
            $row1['service_title'] = $data['title'];
            $row1['service_url'] = $data['url'];
            $row1['service_original_price'] = $data['original_amount'];
            $row1['service_discount_price'] = $data['discount_amount'];
            $row1['service_skucode'] = $data['skucode'];
            $row1['service_short_description'] = $data['short_description'];
            $row1['service_long_description'] = $data['long_description'];
            $row1['service_duration'] = hoursandmins($data['duration']);
            $row1['service_discount'] = $data['discount'];
             
            $row1['service_image'] = $image;
            $row1['service_status'] = $data['servicestatus'];

            $qrys1 = "SELECT * FROM fav
		    WHERE fav.user_id = '".$_POST['user_id']."' and fav.service_id = '".$data['serviceid']."'  "; 
			$results1 = mysqli_query($con,$qrys1);
			$row11 = mysqli_fetch_assoc($results1);
		    $num_rows_fav   = mysqli_num_rows($results1);
	            
	        if($num_rows_fav > 0)
	        {	
	            $row1['fav_id'] = $row11['ID'];
	            $row1['fav_user'] = "1";
		         
		    }else{

	            $row1['fav_id'] = "0"; 
	            $row1['fav_user'] = "0";
		    }  

		    $qrys_cart = "SELECT * FROM cart
		    WHERE cart.user_id = '".$_POST['user_id']."' and cart.services_id = '".$data['serviceid']."'  "; 
			$results_cart = mysqli_query($con,$qrys_cart);
			$row_cart = mysqli_fetch_assoc($results_cart);
		    $num_rows_cart   = mysqli_num_rows($results_cart);
	            
	        if($num_rows_cart > 0)
	        {	
	            $row1['cart_quantity'] = $row_cart['cart_services_qty'];
	            $row1['cart_id'] = $row_cart['ID'];
	            $row1['cart_user'] = "1";
		         
		    }else{
		    	$row1['cart_quantity'] = "0"; 
	            $row1['cart_id'] = "0"; 
	            $row1['cart_user'] = "0";
		    }   
 	 
 	
			array_push($jsonObj4,$row1); 
		}
		
		$set['page'] = $_POST['page'];
		$set['totalimage'] = $total_pages;
		$set['limit'] = $limit;
		$set['success'] = '1';  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get single services details
else if(isset($_GET['single_services']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
		LEFT JOIN category c ON c.ID = s.category
		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
		WHERE s.ID = '".$_POST['service_id']."'
		ORDER BY s.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['serviceimage'])){
          	    $image = UPLOAD_PATH.'service/'.$data['serviceimage'];
          	}else{
          	    $image='';
          	}
          	
          	$row1['service_id'] = $data['serviceid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];
            $row1['sub_sub_category_id'] = $data['subsubid'];
            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['service_type'] = $data['type'];
            $row1['service_title'] = $data['title'];
            $row1['service_url'] = $data['url'];
            $row1['service_original_price'] = $data['original_amount'];
            $row1['service_discount_price'] = $data['discount_amount'];
            $row1['service_skucode'] = $data['skucode'];
            $row1['service_short_description'] = $data['short_description'];
            $row1['service_long_description'] = $data['long_description'];
            // $row1['service_duration'] = $data['duration'];
            $row1['service_duration'] = hoursandmins($data['duration']);
            $row1['service_discount'] = $data['discount'];
            $row1['service_image'] = $image;
            $row1['service_status'] = $data['servicestatus'];


            $qrys1 = "SELECT * FROM fav
		    WHERE fav.user_id = '".$_POST['user_id']."' and fav.service_id = '".$data['serviceid']."'  "; 
			$results1 = mysqli_query($con,$qrys1);
			$row11 = mysqli_fetch_assoc($results1);
		    $num_rows_fav   = mysqli_num_rows($results1);
	            
	        if($num_rows_fav > 0)
	        {	
	            $row1['fav_id'] = $row11['ID'];
	            $row1['fav_user'] = "1";
		         
		    }else{

	            $row1['fav_id'] = "0"; 
	            $row1['fav_user'] = "0";
		    }  

		    $qrys_cart = "SELECT * FROM cart
		    WHERE cart.user_id = '".$_POST['user_id']."' and cart.services_id = '".$data['serviceid']."'  "; 
			$results_cart = mysqli_query($con,$qrys_cart);
			$row_cart = mysqli_fetch_assoc($results_cart);
		    $num_rows_cart   = mysqli_num_rows($results_cart);
	            
	        if($num_rows_cart > 0)
	        {	
	            $row1['cart_id'] = $row_cart['ID'];
	            $row1['cart_user'] = "1";
		         
		    }else{
		    	
	            $row1['cart_id'] = "0"; 
	            $row1['cart_user'] = "0";
		    }   
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}



//user add to cart
else if(isset($_GET['add_cart']))
{
	
	if($_POST['user_id']!="" AND $_POST['service_id']!="" )
	{

		$qry_product_check = "SELECT * FROM services WHERE ID='".$_POST['service_id']."'  "; 
        
        $result_product_check     = mysqli_query($con,$qry_product_check);
        $num_rows_product_check   = mysqli_num_rows($result_product_check);
        $row_product_check = mysqli_fetch_assoc($result_product_check);

        
        $original_amount = $row_product_check['original_amount'];
        $discount_amount = $row_product_check['discount_amount'];
        

       	if($num_rows_product_check>0){

       	// 		$qry_fav_check = "SELECT * FROM cart WHERE user_id='".$_POST['user_id']."' and services_id != '".$_POST['service_id']."' "; 
	       //     // and product_id='".$_POST['p_id']."'
	       //     $result_fav     = mysqli_query($con,$qry_fav_check);
	       //     $num_rows_fav   = mysqli_num_rows($result_fav);
	       //     $row1 = mysqli_fetch_assoc($result_fav);
	            
	       //     if($num_rows_fav > 0)
	       //     {
	       //         $delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' AND services_id !='".$_POST['service_id']."' ";
	       //         $result1 = mysqli_query($con,$delete);
	       //     }
                

	            $qry_product_check_cart = "SELECT * FROM cart WHERE user_id='".$_POST['user_id']."' AND services_id='".$_POST['service_id']."'  "; 
        		
	            $result_product_check_cart     = mysqli_query($con,$qry_product_check_cart);
	            $num_rows_product_check_cart   = mysqli_num_rows($result_product_check_cart);
	            $row_product_check_cart = mysqli_fetch_assoc($result_product_check_cart);
	            if($num_rows_product_check_cart > 0){

	            	if($_POST['cart_services_qty']==0){

						$delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' and services_id='".$_POST['service_id']."'  ";
                        $result1 = mysqli_query($con,$delete);
        
                        if($result1 == 1)
                            $set['JSON_DATA'][]=array('msg' => "cart deleted successfully...!",'success'=>'1','cart_id'=> 0);
                        else
                            $set['JSON_DATA'][]=array('msg' => "Some error occured",'success  '=>'0','cart_id'=> 0);


	            	}else{
		            	 $user_edit="UPDATE `cart` SET
                        `cart_services_qty`='".$_POST['cart_services_qty']."'  WHERE `user_id`='".$_POST['user_id']."' AND `services_id`='".$_POST['service_id']."'  ";  
                        
                        $user_res = mysqli_query($con,$user_edit);  
                        
                        
                        $set['JSON_DATA'][]=array('msg'=>'Updated','success'=>'1','cart_id'=> $row_product_check_cart['ID']);
	            	}

	            	

	            }else{
	            	$qry_insert="INSERT INTO `cart`(`status`, `user_id`, `services_id`, `cart_services_qty`, `cart_services_dis_amount`, `cart_services_ori_amount`)

					VALUES ('1','".$_POST['user_id']."','".$_POST['service_id']."','".$_POST['cart_services_qty']."','".$discount_amount."','".$original_amount."')"; 

					$result_insert=mysqli_query($con,$qry_insert);
					
                    
                    $last_id = mysqli_insert_id($con); 
         
                    $set['JSON_DATA'][] =   array( 
                    'msg' =>    "Add Successfully",
                    'success'=>'1',
                    'cart_id'=> "$last_id"
                    );
	            }


       	}else{
       		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!   ",'success'=>'0');
       	}

	            
	}
	else{
		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!   ",'success'=>'0');
	}	
	
	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	

}


//all delete service in user cart
else if(isset($_GET['all_delete_cart']))
{

        $jsonObj= array();
        $u_id=$_POST['user_id'];
       

        if($u_id != "") 
        {
        
                $qry = "SELECT * FROM cart WHERE user_id='".$u_id."'  "; 
                    
                $result     = mysqli_query($con,$qry);
                $num_rows   = mysqli_num_rows($result);
                //$row = mysqli_fetch_array($result);
                
                if($num_rows > 0)
                {
                     
                    $delete = "DELETE FROM cart WHERE user_id='".$u_id."' ";
                    $result1 = mysqli_query($con,$delete);
    
                    if($result1 == 1)
                        $set['JSON_DATA'][]=array('msg' => "cart deleted successfully...!",'success'=>'1');
                    else
                        $set['JSON_DATA'][]=array('msg' => "Some error occured",'success  '=>'0');
                    
    
                }
                else
                {   
                    $set['JSON_DATA'][]=array('msg' => "cart Not  found  ",'success'=>'0');
                } 
          
       }else
       {
            $set['JSON_DATA'][]=array('msg' => "Please enter cart id",'success'=>'0');
       }    
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            die();
}

//user delete cart item
else if(isset($_GET['delete_cart']))
{

        $jsonObj= array();
        $cart_id=$_POST['cart_id'];
       

        if($cart_id != "") 
        {
        
                $qry = "SELECT * FROM cart WHERE ID='".$cart_id."'  "; 
                    
                $result     = mysqli_query($con,$qry);
                $num_rows   = mysqli_num_rows($result);
                //$row = mysqli_fetch_array($result);
                
                if($num_rows > 0)
                {
                     
                    $delete = "DELETE FROM cart WHERE ID='".$cart_id."' ";
                    $result1 = mysqli_query($con,$delete);
    
                    if($result1 == 1)
                        $set['JSON_DATA'][]=array('msg' => "cart deleted successfully...!",'success'=>'1');
                    else
                        $set['JSON_DATA'][]=array('msg' => "Some error occured",'success  '=>'0');
                    
    
                }
                else
                {   
                    $set['JSON_DATA'][]=array('msg' => "cart Not  found  ",'success'=>'0');
                } 
          
       }else
       {
            $set['JSON_DATA'][]=array('msg' => "Please enter cart id",'success'=>'0');
       }    
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            die();
}




//user get cart items
else if(isset($_GET['get_cart']))
{


   		$jsonObj1= array();
    
   		
	    $query="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
	    LEFT JOIN user_registration u ON u.ID = cart.user_id 
	    LEFT JOIN services s ON s.ID = cart.services_id 
	    LEFT JOIN category c ON c.ID = s.category 
	    LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
	    LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
		WHERE cart.user_id='".$_POST['user_id']."'
		ORDER BY cart.ID DESC ";

	   	$total = 0;
		$totals_is_various = 0;

	    $sql = mysqli_query($con,$query)or die(mysqli_error());


	    while($data = mysqli_fetch_assoc($sql))
	    { 

	    	if(!empty($data['serviceimage'])){
          	    $image = UPLOAD_PATH.'service/'.$data['serviceimage'];
          	}else{
          	    $image='';
          	}
          	

			$row1['cart_id'] = $data['cartid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];
            $row1['sub_sub_category_id'] = $data['subsubid'];
            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['service_id'] = $data['serviceid'];
            $row1['service_type'] = $data['type'];
            $row1['service_title'] = $data['title'];
            $row1['service_url'] = $data['url'];
            
            $row1['service_original_price'] = $data['original_amount'];
            $row1['service_discount_price'] = $data['discount_amount'];
            $row1['service_skucode'] = $data['skucode'];
            $row1['service_description'] = $data['servicedesc'];
            $row1['service_duration'] = hoursandmins($data['duration']);
            $row1['service_discount'] = $data['discount'];
            $row1['service_image'] = $image;
            $row1['service_status'] = $data['servicestatus'];

            $row1['cart_services_qty'] = $data['cart_services_qty'];
            $row1['cart_services_dis_amount'] = $data['cart_services_dis_amount'];
            $row1['cart_services_ori_amount'] = $data['cart_services_ori_amount'];

            $row1['cart_status'] = $data['cartstatus'];

		    $totals_is_various1 =  $data["cart_services_qty"] * $data["cart_services_ori_amount"];
	        $totals_is_various += $totals_is_various1;

	        $totals =  $data["cart_services_qty"] * $data["cart_services_dis_amount"];
	        $total += $totals;
		
			array_push($jsonObj1,$row1);
				
		}
		
		
		
		
    	// echo 'restro_id'.$data_gst['resto_id'];

	
		if($total == "")
		{
			$total1 = '0';
		}else{
			$total1 = $total; 
		}

		if($totals_is_various == "")
		{
			$totals_is_various1 = '0';
		}else{
			$totals_is_various1 = $totals_is_various; 
		}
		
	    $final_amount = $total1 + APP_conveyance + APP_safety_hygiene;
		
		$set['min_amount'] = "0";
		$set['total_dis_amount'] = "$total1";
		$set['total_ori_amount'] = "$totals_is_various1";
		$set['conveyance_charges'] = APP_conveyance;
		$set['safety_hygiene_charges'] = APP_safety_hygiene;
		$set['final_amount'] = "$final_amount";
		$set['JSON_DATA'] = $jsonObj1;	


		header( 'Content-Type: application/json; charset=utf-8' );
		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all timezone
else if(isset($_GET['get_timezone_old']))
{


    $jsonObj1= array();
    
    date_default_timezone_set("Asia/Calcutta");
    $my_date = date("Y-m-d");
    $o_date = $_POST['date'];
    
    $query="SELECT * FROM `timeslot` t
    ORDER BY t.ID ASC";
    $sql = mysqli_query($con,$query)or die(mysqli_error());
    
	while($data = mysqli_fetch_assoc($sql))
	{
	        $qry_check_booling = "SELECT * FROM orders
	 		WHERE orders.order_date='".$_POST['date']."' AND FIND_IN_SET('".$data['timeslot']."',orders.order_time) AND (orders.payment_status ='1' OR orders.payment_status = '2' ) ORDER BY orders.id DESC";
			$result_check_booking = mysqli_query($con,$qry_check_booling);
			$row_check_booking = mysqli_fetch_assoc($result_check_booking);
			$fetch_booking_check = mysqli_num_rows($result_check_booking);
			
	        
    		$row1['timezone_id'] = $data['ID'];
    		$row1['timezone_name'] = $data['timeslot'];
    // 		$row['timezone_price'] = $data['timezone_price'];
            if($fetch_booking_check == 0){
                $time = date('h:i A');
                $my_timeschedule_export=$data['timeslot'];
                $expload = (explode("to",$my_timeschedule_export));
                
                $ftime = $expload[0];
                $ltime = $expload[1];
                // $ltime="06:00 PM";
                $timestamp = time() + 60*60;
                // 08:00 < 06:00
                if($my_date == $o_date){
                    if (strtotime($ftime) < $timestamp) {
                    	 
                    	$row1['timezone_available']="0";
                    }else{
                        
                    	$row1['timezone_available']="1";
                    }
                }else{
                    $row1['timezone_available']="1";
                }
            }
            else{
                $row1['timezone_available']="0";
            }
    
    		array_push($jsonObj1,$row1);
	
	}
	
	$set['JSON_DATA'] = $jsonObj1;	

	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

//get all timezone
else if(isset($_GET['get_timezone']))
{


    $jsonObj1= array();
    
    date_default_timezone_set("Asia/Calcutta");
    $my_date = date("Y-m-d");
    $o_date = $_POST['date'];
    $s_id = $_POST['staff_id'];
    
    $query="SELECT * FROM `timeslot` t
    ORDER BY t.ID ASC";
    $sql = mysqli_query($con,$query)or die(mysqli_error());
    
	while($data = mysqli_fetch_assoc($sql))
	{
    	    if(!empty($s_id)){
    	        
    	        $qry_check_booling = "SELECT * FROM orders
    	 		WHERE orders.staff_id='".$s_id."' AND orders.city_id='".$_POST['city_id']."' and orders.order_date='".$_POST['date']."' AND FIND_IN_SET('".$data['timeslot']."',orders.order_time) AND (orders.payment_type ='1' OR orders.payment_type = '2' OR orders.payment_type ='6' OR orders.payment_type = '7'  ) ORDER BY orders.id DESC";
    	    }else{
    	        $qry_check_booling = "SELECT * FROM orders
    	 		WHERE orders.city_id='".$_POST['city_id']."' and orders.order_date='".$_POST['date']."' AND FIND_IN_SET('".$data['timeslot']."',orders.order_time) AND (orders.payment_type ='1' OR orders.payment_type = '2' OR orders.payment_type ='6' OR orders.payment_type = '7'  ) ORDER BY orders.id DESC";
    	    }
	        
			$result_check_booking = mysqli_query($con,$qry_check_booling);
			$row_check_booking = mysqli_fetch_assoc($result_check_booking);
			$fetch_booking_check = mysqli_num_rows($result_check_booking);
			
	        
    		$row1['timezone_id'] = $data['ID'];
    		// $row1['timezone_name'] = $data['timeslot'];
    		//$row['timezone_price'] = $data['timezone_price'];
            
            if($fetch_booking_check >= $data['slot_max_book'] ){

            	$row1['timezone_name'] = $data['timeslot'];
                $row1['timezone_available']="0";
            }else{

            	$time = date('h:i A');
                $my_timeschedule_export=$data['timeslot'];
                $expload = (explode("to",$my_timeschedule_export));
                
                $ftime = $expload[0];
                $ltime = $expload[1];
                // $ltime="06:00 PM";
                //$timestamp = time();
                 $hours = 2;
				 $timestamp = time() + ($hours * 60 * 60); // hours; 60 mins; 60secs
                // 08:00 < 06:00
                 $row1['timezone_name'] = $data['timeslot'];
                if($my_date == $o_date){
                    if (strtotime($ftime) < $timestamp) {
                    	 
                    	$row1['timezone_available']="0";
                    }else{
                        
                    	$row1['timezone_available']="1";
                    }
                }else{
                    
                    	$row1['timezone_available']="1";
                    
                }
            }
               
    
    		array_push($jsonObj1,$row1);
	
	}
	
	$set['JSON_DATA'] = $jsonObj1;	

	header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//get all coupon with category wise
else if(isset($_GET['get_coupon']))
{
 		

 		$jsonObj4= array();


        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $date = date('Y-m-d');
             

 	 	$query="SELECT *,coupon.ID as couponid,cat.category as categoryname,cat.ID as catid,coupon.status as couponstatus FROM coupon_master coupon 
 		left join category cat on cat.ID = coupon.category_id
 		WHERE coupon.status = 1 and coupon.coupon_start_date <= '".$date."' and coupon.coupon_end_date >= '".$date."' 
 		ORDER BY coupon.ID ASC";
 		
        
 		
		$sql = mysqli_query($con,$query)or die(mysqli_error());
        
		while($data = mysqli_fetch_assoc($sql))
		{
		    $qry = "SELECT * FROM orders
            WHERE orders.user_id  = '".$_POST['user_id']."' and orders.coupon_id  = '".$data['couponid']."' "; 
		    $result = mysqli_query($con,$qry);

		    $num_rows = mysqli_num_rows($result);
		    
		    if ($num_rows < $data['coupon_peruser'] )
		    {
		    	          // SELECT `ID`, `status`, `category_id`, `coupon_name`, `coupon_promocode`, `coupon_minamount`, `coupon_maxamount`, `coupon_type`, `coupon_peruser`, `coupon_price`, `coupon_start_date`, `coupon_end_date` FROM `coupon_master` 



				 	$row1['coupon_id'] = $data['couponid'];
				 	$row1['coupon_name'] = $data['coupon_name'];
					$row1['coupon_promocode'] = $data['coupon_promocode'];
					$row1['coupon_minamount'] = $data['coupon_minamount']; 
					$row1['coupon_maxamount'] = $data['coupon_maxamount']; 
					$row1['coupon_type'] = $data['coupon_type']; 
					$row1['coupon_price'] = $data['coupon_price'];
					$row1['coupon_peruser'] = $data['coupon_peruser']; 
					$row1['coupon_start_date'] = $data['coupon_start_date'];
					$row1['coupon_end_date'] = $data['coupon_end_date'];
		 			$row1['coupon_status'] = $data['couponstatus'];

		  		 			
		 			array_push($jsonObj4,$row1); 

		    }else{
		        
		    }	
 		}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//add to book the services
else if(isset($_GET['add_book_old']))
{

 			$jsonObj1= array();

 			if($_POST['user_id']!='' && $_POST['payment_type']!=''  )
 			{
 			    
				date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
				$date = date('Y-m-d H:i:s');
				$date1 = date('Y-m-d');
				$date2 = date('H:i:s');

					if($_POST['payment_type'] == 3)
					{
						$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
						$wallet_result = mysqli_query($con,$wallet_check);
						$wallet_row = mysqli_fetch_assoc($wallet_result);
						$wallet_amt = $wallet_row['wallet'];
						$wallet_num = mysqli_num_rows($wallet_result);
					

						if(($wallet_num > 0 && $wallet_amt >= $_POST['final_price'] ))
						{
							$qry1="INSERT INTO `orders`(`user_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)
	        				VALUES (
	        			    	'".$_POST['user_id']."',
	        			    	'".$_POST['a_id']."',
	        			    	'".$_POST['payment_type']."',
	        			    	'".$_POST['message']."',
	        					'".$_POST['dis_price']."',
	        					'".$_POST['ori_price']."',
	        					'".$_POST['final_price']."',
	        					'1',
	        					'1',
	        					'".$_POST['txnid']."',
	        					'".$_POST['mihpayid']."',
	        					'".$_POST['payu_status']."',
	        					'".$_POST['coupon_id']."',
	        					'".$_POST['coupon_value']."',
	        					'".$_POST['coupon_code']."',
	        					'".$now."',
	        				    '".$_POST['order_date']."',
	        				    '".$_POST['order_time']."'
	        				)"; 
		                        
	        				$result1 = mysqli_query($con,$qry1);

	        				$last_id = mysqli_insert_id($con);  

	                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
	            			$results = mysqli_query($con,$qrys);
	            			$row = mysqli_fetch_assoc($results);
	    
	                    
		                    // $delete = "DELETE FROM tbl_cart WHERE user_id='".$_POST['u_id']."' ";
		                    // $result1 = mysqli_query($mysqli,$delete);
		            		if(!empty($last_id))
		            		{
			            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$_POST['user_id']."'
								ORDER BY cart.ID ASC";


							    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
							    $index = 1;
							    while($data1 = mysqli_fetch_array($sql1))
							   	{

						            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

						            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

									$index++;
						  		}                           

		        			}



		                	 //wallet payment
				  		if($_POST['payment_type'] == 3)
				  		{
				  			$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
							$wallet_result = mysqli_query($con,$wallet_check);

							$wallet_row = mysqli_fetch_assoc($wallet_result);
							$wallet_amt = $wallet_row['wallet'];
							$wallet_num = mysqli_num_rows($wallet_result);
							// echo "hello";
							if($wallet_num > 0)
							{ 
						
								$final_amount = $wallet_amt - $_POST['final_price'];
								
								$user_edit= "UPDATE user_registration SET wallet='".$final_amount."' WHERE ID = '".$_POST['user_id']."'";

								$user_res = mysqli_query($con,$user_edit);

								$description = 'Wallet payment debited';

								$childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$_POST['user_id']."','".$_POST['final_price']."','".$description."','2','3','".$date."','1')";
			            		$childuser_res = mysqli_query($con,$childuser_wallet);

							}
				  		}

				  		$order_details = array(); 

                		$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
						WHERE orderdetails.order_id='".$last_id."'
						ORDER BY orderdetails.id ASC";

					    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

					    while($data_order_details = mysqli_fetch_array($sql_order_details))
					   	{
					   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
					   		$row1['order_id'] = $data_order_details['order_id'];
					   		$row1['category_id'] = $data_order_details['category_id'];
					   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
					   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
					   		$row1['service_id'] = $data_order_details['service_id'];
					   		$row1['qty'] = $data_order_details['qty'];
					   		$row1['ori_price'] = $data_order_details['ori_price'];
					   		$row1['dis_price'] = $data_order_details['dis_price'];
		  		 			
		 					array_push($order_details,$row1); 
				           
				  		}           

				  		$set['JSON_DATA'][]	=	array(    
							'msg' 	=>	"Order placed Successfully",
							'success'=>'1',
							'order_id' 	=>	$row['id'],
							'user_id' 	=>	$row['user_id'],
							'a_id' 	=>	$row['address'],
							'order_details' => $order_details,
							'payment_type' 	=>	$row['payment_type'],
							'message' 	=>	$row['message'],
							'dis_price' 	=>	$row['dis_price'],
							'ori_price'	=>  $row['ori_price'],
							'final_price'	=>  $row['final_price'],
							'payment_status'	=>  $row['payment_status'],
							'order_status'	=>  $row['order_status'],
							'txnid'	=>  $row['txnid'],
							'mihpayid'	=>  $row['mihpayid'],
							'payu_status'	=>  $row['payu_status'],
							'coupon_id'	=>	$row['coupon_id'],
							'coupon_value'	=>	$row['coupon_value'],
							'coupon_code'	=>	$row['coupon_code'],
							'added_on'	=>	$row['added_on'],
							'order_date'	=>	$row['order_date'],
							'order_time'	=>	$row['order_time'],
							
							);

						}else{

								$set['JSON_DATA'][]=array('msg' => "Insufficient balance in your wallet...!",'success'=>'0');
							}

						
            		  
					}else if($_POST['payment_type'] == 1 OR $_POST['payment_type'] == 2) {

						$qry1="INSERT INTO `orders`(`user_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)
	        				VALUES (
	        			    	'".$_POST['user_id']."',
	        			    	'".$_POST['a_id']."',
	        			    	'".$_POST['payment_type']."',
	        			    	'".$_POST['message']."',
	        					'".$_POST['dis_price']."',
	        					'".$_POST['ori_price']."',
	        					'".$_POST['final_price']."',
	        					'1',
	        					'1',
	        					'".$_POST['txnid']."',
	        					'".$_POST['mihpayid']."',
	        					'".$_POST['payu_status']."',
	        					'".$_POST['coupon_id']."',
	        					'".$_POST['coupon_value']."',
	        					'".$_POST['coupon_code']."',
	        					'".$now."',
	        				    '".$_POST['order_date']."',
	        				    '".$_POST['order_time']."'
	        				)"; 

	        			$result1 = mysqli_query($con,$qry1);
					
                       
                        
                        $last_id = mysqli_insert_id($con);  

                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
            			$results = mysqli_query($con,$qrys);
            			$row = mysqli_fetch_assoc($results);
    
                    
	                    // $delete = "DELETE FROM tbl_cart WHERE user_id='".$_POST['u_id']."' ";
	                    // $result1 = mysqli_query($mysqli,$delete);
	            		if(!empty($last_id))
	            		{
		            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
							LEFT JOIN user_registration u ON u.ID = cart.user_id 
							LEFT JOIN services s ON s.ID = cart.services_id 
							LEFT JOIN category c ON c.ID = s.category 
							LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
							LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
							WHERE cart.user_id='".$_POST['user_id']."'
							ORDER BY cart.ID ASC";


						    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
						    $index = 1;
						    while($data1 = mysqli_fetch_array($sql1))
						   	{

					            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

					            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

								$index++;
					  		}                           

	        			}

	                    // INSERT INTO `orders_detail`(`id`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`)

	                    // INSERT INTO `orders`(`id`, `user_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	                    $order_details = array(); 

	                	$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
							WHERE orderdetails.order_id='".$last_id."'
							ORDER BY orderdetails.id ASC";

						    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

						    while($data_order_details = mysqli_fetch_array($sql_order_details))
						   	{
						   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
						   		$row1['order_id'] = $data_order_details['order_id'];
						   		$row1['category_id'] = $data_order_details['category_id'];
						   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
						   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
						   		$row1['service_id'] = $data_order_details['service_id'];
						   		$row1['qty'] = $data_order_details['qty'];
						   		$row1['ori_price'] = $data_order_details['ori_price'];
						   		$row1['dis_price'] = $data_order_details['dis_price'];
			  		 			
			 					array_push($order_details,$row1); 
					           
					  		}           

					  		
					  		
					  			$set['JSON_DATA'][]	=	array(    
								'msg' 	=>	"Order placed Successfully",
								'success'=>'1',
								'order_id' 	=>	$row['id'],
								'user_id' 	=>	$row['user_id'],
								'a_id' 	=>	$row['address'],
								'order_details' => $order_details,
								'payment_type' 	=>	$row['payment_type'],
								'message' 	=>	$row['message'],
								'dis_price' 	=>	$row['dis_price'],
								'ori_price'	=>  $row['ori_price'],
								'final_price'	=>  $row['final_price'],
								'payment_status'	=>  $row['payment_status'],
								'order_status'	=>  $row['order_status'],
								'txnid'	=>  $row['txnid'],
								'mihpayid'	=>  $row['mihpayid'],
								'payu_status'	=>  $row['payu_status'],
								'coupon_id'	=>	$row['coupon_id'],
								'coupon_value'	=>	$row['coupon_value'],
								'coupon_code'	=>	$row['coupon_code'],
								'added_on'	=>	$row['added_on'],
								'order_date'	=>	$row['order_date'],
								'order_time'	=>	$row['order_time'],
								
								);
				  			
					}			

	        }else
				{
					$set['JSON_DATA'][]=array('msg' => "SomeThigns Want to wrong",'success'=>'0');
				}
                   
            
                  
		
        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//add to book the services
else if(isset($_GET['add_book1']))
{

 			$jsonObj1= array();

 			if($_POST['user_id']!='' && $_POST['payment_status']!=''  )
 			{
 			    $order_otp=rand(1000,9999);
				date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
				$date = date('Y-m-d H:i:s');
				$date1 = date('Y-m-d');
				$date2 = date('H:i:s');

					if($_POST['payment_status'] == 3)
					{
						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$_POST['user_id']."'
								ORDER BY cart.ID ASC";


							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
							}

							$total_time_slot = $times / 30;
        	
            			    $total_time_slot_round = round($total_time_slot);

							
							$all_timeslot = array();
                     
                            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
			    		    $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
			    		    while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
			    		    {
			    			   
			    			    $row2 = $data_timeslot['timeslot'];
			    			             
			    			    array_push($all_timeslot,$row2);

			    			}
			                    
			    			// print_r($all_timeslot);
			                $new = array();
			                foreach ($all_timeslot as $key => $value) {
			                    //echo $value;
			                if ($value === $_POST['order_time']) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $_POST['order_time'];
			                 //   array_push($new,$times1); 
			                    
			                     for ($x = 0; $x < $total_time_slot_round; $x++) {
			                        
    	                            $new[$key] = $all_timeslot[$key];
    	                            if($new[$key] == "")
    	                            {
    			                        break;
    	                            }
    	                            $key++;
			                    }
			                    
			                }
			                }
			                
			                $string_version = implode(',', $new);
			 				// echo $string_version;
			 				// print_r($new);
							// exit;

				// 		if($times >= 60)
				// 		{
				            if( $_POST['final_price']  >= MINI_ORDER_AMOUNT)
				            {
							$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
							$wallet_result = mysqli_query($con,$wallet_check);
							$wallet_row = mysqli_fetch_assoc($wallet_result);
							$wallet_amt = $wallet_row['wallet'];
							$wallet_num = mysqli_num_rows($wallet_result);
						    
                            $query_address="SELECT * FROM `address` a
                            WHERE a.ID = '".$_POST['a_id']."' and a.status = 1
                            ORDER BY a.ID DESC";
                            
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                        
                            $row_address = mysqli_fetch_assoc($sql_address);
                            
                            $address_city_id = $row_address['city_id'];
                            
							if(($wallet_num > 0 && $wallet_amt >= $_POST['final_price'] ))
							{
								$qry1="INSERT INTO `orders`(`user_id`, `staff_id`,`city_id`,`address`, `payment_type`, `message`, `dis_price`, `ori_price`,`conveyance_charges`,`safety_hygiene_charges`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`,`service_price`, `added_on`, `order_date`, `order_time`,`order_otp`)
		        				VALUES (
		        			    	'".$_POST['user_id']."',
		        			    	'".$_POST['staff_id']."',
		        			    	'".$address_city_id."',
		        			    	'".$_POST['a_id']."',
		        			    	'1',
		        			    	'".addslashes($_POST['message'])."',
		        					'".$_POST['dis_price']."',
		        					'".$_POST['ori_price']."',
		        					'".$_POST['conveyance_charges']."',
		        					'".$_POST['safety_hygiene_charges']."',
		        					'".$_POST['final_price']."',
		        					'".$_POST['payment_status']."',
		        					'1',
		        					'".$_POST['txnid']."',
		        					'".$_POST['mihpayid']."',
		        					'".$_POST['payu_status']."',
		        					'".$_POST['coupon_id']."',
		        					'".$_POST['coupon_value']."',
		        					'".$_POST['coupon_code']."',
		        					'0',
		        					'".$now."',
		        				    '".$_POST['order_date']."',
		        				    '".$string_version."',
		        				    '".$order_otp."'
		        				)"; 
			                        
		        				$result1 = mysqli_query($con,$qry1);

		        				$last_id = mysqli_insert_id($con);  

		                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
		            			$results = mysqli_query($con,$qrys);
		            			$row = mysqli_fetch_assoc($results);
	    
	                    
			                  
			                    
			            		if(!empty($last_id))
			            		{
				            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
									LEFT JOIN user_registration u ON u.ID = cart.user_id 
									LEFT JOIN services s ON s.ID = cart.services_id 
									LEFT JOIN category c ON c.ID = s.category 
									LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
									LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
									WHERE cart.user_id='".$_POST['user_id']."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}

                                  $delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' ";
			                    $result1 = mysqli_query($con,$delete);

			                	 //wallet payment
						  		if($_POST['payment_type'] == 3)
						  		{
						  			$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
									$wallet_result = mysqli_query($con,$wallet_check);

									$wallet_row = mysqli_fetch_assoc($wallet_result);
									$wallet_amt = $wallet_row['wallet'];
									$wallet_num = mysqli_num_rows($wallet_result);
									// echo "hello";
									if($wallet_num > 0)
									{ 
								
										$final_amount = $wallet_amt - $_POST['final_price'];
										
										$user_edit= "UPDATE user_registration SET wallet='".$final_amount."' WHERE ID = '".$_POST['user_id']."'";

										$user_res = mysqli_query($con,$user_edit);

										$description = 'Wallet payment debited';

										$childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$_POST['user_id']."','".$_POST['final_price']."','".$description."','2','3','".$date."','1')";
					            		$childuser_res = mysqli_query($con,$childuser_wallet);

									}
						  		}

						  		$order_details = array(); 

		                		$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
								WHERE orderdetails.order_id='".$last_id."'
								ORDER BY orderdetails.id ASC";

							    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

							    while($data_order_details = mysqli_fetch_array($sql_order_details))
							   	{
							   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
							   		$row1['order_id'] = $data_order_details['order_id'];
							   		$row1['category_id'] = $data_order_details['category_id'];
							   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
							   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
							   		$row1['service_id'] = $data_order_details['service_id'];
							   		$row1['qty'] = $data_order_details['qty'];
							   		$row1['ori_price'] = $data_order_details['ori_price'];
							   		$row1['dis_price'] = $data_order_details['dis_price'];

				  		 			
				 					array_push($order_details,$row1); 
						           
						  		}           

						  		$set['JSON_DATA'][]	=	array(    
									'msg' 	=>	"Order placed Successfully",
									'success'=>'1',
									'order_id' 	=>	$row['id'],
									'user_id' 	=>	$row['user_id'],
									'staff_id' 	=>	$row['staff_id'],
									'a_id' 	=>	$row['address'],
									'order_details' => $order_details,
									'payment_type' 	=>	$row['payment_type'],
									'message' 	=>	$row['message'],
									'dis_price' 	=>	$row['dis_price'],
									'ori_price'	=>  $row['ori_price'],
									'conveyance_charges'	=>  $row['conveyance_charges'],
									'safety_hygiene_charges'	=>  $row['safety_hygiene_charges'],
									'final_price'	=>  $row['final_price'],
									'payment_status'	=>  $row['payment_status'],
									'order_status'	=>  $row['order_status'],
									'txnid'	=>  $row['txnid'],
									'mihpayid'	=>  $row['mihpayid'],
									'payu_status'	=>  $row['payu_status'],
									'coupon_id'	=>	$row['coupon_id'],
									'coupon_value'	=>	$row['coupon_value'],
									'coupon_code'	=>	$row['coupon_code'],
									'service_price'	=>	$row['service_price'],
									'added_on'	=>	$row['added_on'],
									'order_date'	=>	$row['order_date'],
									'order_time'	=>	$row['order_time'],
								
									);

							}else{

										$set['JSON_DATA'][]=array('msg' => "Insufficient balance in your wallet...!",'success'=>'0');
						
										}
				// 		}else if($times <= 60){
				// 			$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
				// 		}
				        
				        			}else if( $_POST['final_price'] <= MINI_ORDER_AMOUNT){
							$set['JSON_DATA'][]=array('msg' => "you have to book service minimum amount 500...!",'success'=>'0');
						}
						
            		 
					}else if($_POST['payment_status'] == 1 OR $_POST['payment_status'] == 2) {

						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$_POST['user_id']."'
								ORDER BY cart.ID ASC";


							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
							}
                             //echo $times;
                            //exit;
							$total_time_slot = $times / 30;
        	               // echo $total_time_slot;
            			    $total_time_slot_round = round($total_time_slot);
                            // echo $total_time_slot_round;
							
							$all_timeslot = array();
                     
                            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
			    		    $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
			    		    while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
			    		    {
			    			   
			    			    $row2 = $data_timeslot['timeslot'];
			    			             
			    			    array_push($all_timeslot,$row2);

			    			}
			                    
			    	// 		 print_r($all_timeslot);
			                $new = array();
			                foreach ($all_timeslot as $key => $value) {
			                    //echo $value;
			                if ($value === $_POST['order_time']) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $_POST['order_time'];
			                 //   array_push($new,$times1); 
			                    
			                    for ($x = 0; $x < $total_time_slot_round; $x++) {
			                        
    	                            $new[$key] = $all_timeslot[$key];
    	                           // print_r($all_timeslot[$key]);
    	                            if($new[$key] == "")
    	                            {
    			                        break;
    	                            }
    	                            $key++;
			                    }
			                    
			                }
			                }
			                
			                $string_version = implode(',', $new);
                            // echo $string_version;
                            //print_r($new);
                            // exit;
			 //              	if($times >= 60)
				// 			{
							    
							 if( $_POST['final_price']  >= MINI_ORDER_AMOUNT)
				            {   
							$query_address="SELECT * FROM `address` a
                            WHERE a.ID = '".$_POST['a_id']."' and a.status = 1
                            ORDER BY a.ID DESC";
                            
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                        
                            $row_address = mysqli_fetch_assoc($sql_address);
                            
                            $address_city_id = $row_address['city_id'];
                            

								$qry1="INSERT INTO `orders`(`user_id`,`staff_id`, `city_id`,`address`, `payment_type`, `message`, `dis_price`, `ori_price`,`conveyance_charges`,`safety_hygiene_charges`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`,`service_price`, `added_on`, `order_date`, `order_time`,`order_otp`)
			        				VALUES (
			        			    	'".$_POST['user_id']."',
			        			    	'".$_POST['staff_id']."',
			        			    	'".$address_city_id."',
			        			    	'".$_POST['a_id']."',
			        			    	'1',
			        			    	'".addslashes($_POST['message'])."',
			        					'".$_POST['dis_price']."',
			        					'".$_POST['ori_price']."',
			        					'".$_POST['conveyance_charges']."',
			        					'".$_POST['safety_hygiene_charges']."',
			        					'".$_POST['final_price']."',
			        					'".$_POST['payment_status']."',
			        					'1',
			        					'".$_POST['txnid']."',
			        					'".$_POST['mihpayid']."',
			        					'".$_POST['payu_status']."',
			        					'".$_POST['coupon_id']."',
			        					'".$_POST['coupon_value']."',
			        					'".$_POST['coupon_code']."',
			        					'0',
			        					'".$now."',
			        				    '".$_POST['order_date']."',
			        				    '".$string_version."',
			        				    '".$order_otp."'
			        				)"; 

			        			$result1 = mysqli_query($con,$qry1);
							
		                       
		                        
		                        $last_id = mysqli_insert_id($con);  

		                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
		            			$results = mysqli_query($con,$qrys);
		            			$row = mysqli_fetch_assoc($results);
		    
		                    
			                   
			                    
			            		if(!empty($last_id))
			            		{
				            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
									LEFT JOIN user_registration u ON u.ID = cart.user_id 
									LEFT JOIN services s ON s.ID = cart.services_id 
									LEFT JOIN category c ON c.ID = s.category 
									LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
									LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
									WHERE cart.user_id='".$_POST['user_id']."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}
			        			
			        			 $delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' ";
			                    $result1 = mysqli_query($con,$delete);

			                    // INSERT INTO `orders_detail`(`id`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`)

			                    // INSERT INTO `orders`(`id`, `user_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

			                    $order_details = array(); 

			                	$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
									WHERE orderdetails.order_id='".$last_id."'
									ORDER BY orderdetails.id ASC";

								    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

								    while($data_order_details = mysqli_fetch_array($sql_order_details))
								   	{
								   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
								   		$row1['order_id'] = $data_order_details['order_id'];
								   		$row1['category_id'] = $data_order_details['category_id'];
								   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
								   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
								   		$row1['service_id'] = $data_order_details['service_id'];
								   		$row1['qty'] = $data_order_details['qty'];
								   		$row1['ori_price'] = $data_order_details['ori_price'];
								   		$row1['dis_price'] = $data_order_details['dis_price'];
					  		 			
					 					array_push($order_details,$row1); 
							           
							  		}           

							  		
							  		
							  			$set['JSON_DATA'][]	=	array(    
										'msg' 	=>	"Order placed Successfully",
										'success'=>'1',
										'order_id' 	=>	$row['id'],
										'user_id' 	=>	$row['user_id'],
										'staff_id' 	=>	$row['staff_id'],
										'a_id' 	=>	$row['address'],
										'order_details' => $order_details,
										'payment_type' 	=>	$row['payment_type'],
										'message' 	=>	$row['message'],
										'dis_price' 	=>	$row['dis_price'],
										'ori_price'	=>  $row['ori_price'],
										'conveyance_charges'	=>  $row['conveyance_charges'],
										'safety_hygiene_charges'	=>  $row['safety_hygiene_charges'],
										'final_price'	=>  $row['final_price'],
										'payment_status'	=>  $row['payment_status'],
										'order_status'	=>  $row['order_status'],
										'txnid'	=>  $row['txnid'],
										'mihpayid'	=>  $row['mihpayid'],
										'payu_status'	=>  $row['payu_status'],
										'coupon_id'	=>	$row['coupon_id'],
										'coupon_value'	=>	$row['coupon_value'],
										'coupon_code'	=>	$row['coupon_code'],
										'service_price'	=>	$row['service_price'],
										'added_on'	=>	$row['added_on'],
										'order_date'	=>	$row['order_date'],
										'order_time'	=>	$row['order_time'],
										
										);
						  //		}else if($times <= 60){
						  //			$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
						  //		}
            					}else if( $_POST['final_price'] <= MINI_ORDER_AMOUNT){
            							$set['JSON_DATA'][]=array('msg' => "you have to book service minimum amount 500...!",'success'=>'0');
            						}
						
							}			

	        }else
				{
					$set['JSON_DATA'][]=array('msg' => "SomeThigns Want to wrong",'success'=>'0');
				}
                   
            
                  
		
        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get booking upcoming order
else if(isset($_GET['get_order_user_upcoming']))
{


 		$jsonObj4= array();	

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark,ord.order_otp FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.user_id='".$_POST['user_id']."' and ( ord.payment_type= 1 or ord.payment_type= 2 OR ord.payment_type= 6 or ord.payment_type= 7 )
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
		
		    $query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}
			
			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}

			// $row['address'] = $data['address'];
			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];


 			$row2['order_date'] = $newdate;
 			
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
            
    		$row2['order_time'] = $arr[0];
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount = $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";
    		$row2['order_otp'] = $data['order_otp'];
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get booking older order
else if(isset($_GET['get_order_user_older']))
{


 		$jsonObj4= array();	

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark,ord.order_otp FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.user_id='".$_POST['user_id']."' and ( ord.payment_type= 3 or ord.payment_type= 4 or ord.payment_type= 5 )
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}
		    
		 
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];
			

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;


			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
    		$row2['order_time'] = $arr[0];
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount = $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";
    		
    		$row2['order_otp'] = $data['order_otp'];
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//single booking
else if(isset($_GET['single_order']))
{


 		$jsonObj4= array();	

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,s.dp as staffimage, ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark,st.ID as stateid,st.name as statename,c.ID as cityid,c.name as cityname,p.ID as pincodeid,p.name as pincodename,ord.order_otp as order_otp
		FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN state st ON st.ID = a.state_id
		LEFT JOIN city c ON c.ID = a.city_id
		LEFT JOIN pincode p ON p.ID = a.pincode
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.id='".$_POST['order_id']."'
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
            $query_order="SELECT  COUNT(*) as total_book, ROUND(avg(review.rate),2) as total_rate
    		FROM orders
    		left join review on review.order_id = orders.id
    		where orders.staff_id='".$data['staff_id']."' and orders.payment_type = 4 and review.rate > 0 ";

		   $result_order = mysqli_query($con,$query_order)or die(mysqli_error());

		   $row_order=mysqli_fetch_assoc($result_order);
		  
		       if($row_order['total_rate']== NULL )
    			{		             
    			    $row2['total_rate'] = "0";
    			    $row2['total_book'] = "0";
    		             
    			}else
    			{	
    			    
    			    $row2['total_rate'] = $row_order['total_rate'];	
    			    $row2['total_book'] = $row_order['total_book']	;
    
    			}
		   
		   
			
			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
                $row2['staff_image'] ='';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
                $row2['staff_image'] = UPLOAD_PATH.'staff/'.$data['staffimage'];
            }
            
            
            
        //     if(!empty($data['staffimage'])){
        //   	    $row2['staff_image'] = UPLOAD_PATH.'staff/'.$data['staffimage'];
        //   	}else{
        //   	    $row2['staff_image'] ='';
        //   	}
            

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.pic as serviceimage,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."' and orderdetails.type=1
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   	    if(!empty($data_order_details['serviceimage'])){
          	        $image = UPLOAD_PATH.'service/'.$data_order_details['serviceimage'];
              	}else{
              	    $image='';
              	}
          	
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_name'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['service_duration'] = hoursandmins($data_order_details['duration']);
		   		$row1['service_image'] = $image;
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		   		
		 			
				array_push($order_details,$row1); 
	           
	  		}    
	  		
	  		
	  		$order_service_details = array(); 

			$query_order_service_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.pic as serviceimage,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."' and orderdetails.type=2
			ORDER BY orderdetails.id ASC";

		    $sql_order_service_details = mysqli_query($con,$query_order_service_details)or die(mysqli_error());

		    while($data_order_service_details = mysqli_fetch_array($sql_order_service_details))
		   	{
		   	    if(!empty($data_order_service_details['serviceimage'])){
          	        $image = UPLOAD_PATH.'service/'.$data_order_service_details['serviceimage'];
              	}else{
              	    $image='';
              	}
          	
		   		$row11['order_details_id'] = $data_order_service_details['orderdetailsid'];
		   		$row11['order_type'] = $data_order_service_details['ordertype'];
		   		$row11['order_id'] = $data_order_service_details['order_id'];
		   		$row11['category_id'] = $data_order_service_details['category_id'];
		   		$row11['category_name'] = $data_order_service_details['categoryname'];
		   		$row11['sub_category_id'] = $data_order_service_details['subcategory_id'];
		   		$row11['sub_category_name'] = $data_order_service_details['sub_name'];
		   		$row11['sub_sub_category_id'] = $data_order_service_details['subsubcategory_id'];
		   		$row11['sub_sub_category_name'] = $data_order_service_details['subsubsubname'];
		   		$row11['service_id'] = $data_order_service_details['service_id'];
		   		$row11['service_name'] = $data_order_service_details['servicename'];
		   		$row11['service_short_description'] = $data_order_service_details['short_description'];
		   		$row11['service_duration'] = hoursandmins($data_order_service_details['duration']);
		   		$row11['service_image'] = $image;
		   		$row11['qty'] = $data_order_service_details['qty'];
		   		$row11['ori_price'] = $data_order_service_details['ori_price'];
		   		$row11['dis_price'] = $data_order_service_details['dis_price'];
		   		
		 			
				array_push($order_service_details,$row11); 
	           
	  		}

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
        	
			
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				// $row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				// $row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			
			
		    if($data['stateid']== null or $data['statename']==null )
			{
			    $row2['state_id'] = "0";
				$row2['state_name'] = "0";
			}else{
			    $row2['state_id'] = $data['stateid'];
				$row2['state_name'] = $data['statename'];
			}

			if($data['cityid']== null or $data['cityname']==null )
			{
			    $row2['city_id'] = "0";
				$row2['city_name'] = "";
			}else{
			    $row2['city_id'] = $data['cityid'];
				$row2['city_name'] = $data['cityname'];
			}
			
			if($data['pincodeid']== null or $data['pincodename']==null )
			{
			    $row2['pincode_id'] = "0";
				$row2['pincode_code'] = "";
			}else{
			    $row2['pincode_id'] = $data['pincodeid'];
				$row2['pincode_code'] = $data['pincodename'];
			}

			$row2['order_details'] = $order_details;
			
			
			if(!empty($order_service_details))
			{
			    $row2['addition_service_details'] = $order_service_details;
			}else{
			    $row2['addition_service_details'] = [];
			}
			
			
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['ori_price'] = $data['ori_price'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['previous_price'] = $data['dis_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			if(!empty($data['coupon_value']))
 			{
 			    $row2['coupon_value'] = $data['coupon_value'];
 			}else{
 			    $row2['coupon_value'] = '0';
 			}
 			
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];
            
            if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;
            
   
            $product_details = json_decode($data['product_details'], true);
            
            for ($x = 0; $x <= count($product_details)-1 ; $x++) {
                
                 $query2="SELECT * FROM product WHERE product_id='".$product_details[$x]["product_id"]."' ";
                $result2 = mysqli_query($con,$query2);
                $row3 = mysqli_fetch_assoc($result2);
                
                $product_id = $row3['product_id'];
                $product_name = $row3['product_name'];
                $product_desc = $row3['product_description'];
                $product_image = UPLOAD_PATH.'products/'.$row3['product_image'];
            
        	   $order_details1[$x] = array(
	  	        'product_id'=> $product_id,
                'product_name'=> $product_name,
	  	        'product_description'=> $product_desc,
	  	        'product_image'=> $product_image,
                'request_quantity'=> $product_details[$x]["request_quantity"],
             
                        
                    );
            }
            
            
    		//$row2['product_details'] = $order_details1;
    		
    		if($order_details1 == null)
    		{
    		    $row2['product_details'] = [];
    		}else{
    		    $row2['product_details'] = $order_details1;
    		}
            
 			$row2['order_date'] = $newdate;
 			$row2['cancel_reason'] = $data['cancel_reason'];
 			
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
 		
    		$row2['order_time'] = $arr[0];
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount =  $data['final_price'];
    		
    		$row2['txtfinalamount'] = $data['final_price'];
    		$row2['order_otp'] = $data['order_otp'];
    		
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}




//order status change
else if(isset($_GET['status_manage_order']))
{


	$qry = "SELECT * FROM `orders` ord
	LEFT JOIN user_registration u ON u.ID = ord.user_id
	WHERE ord.id='".$_POST['order_id']."' and ord.user_id='".$_POST['user_id']."' ";

	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row1 = mysqli_fetch_assoc($result);
		
         if ($num_rows > 0)
		{
		    
		    if($_POST['payment_type'] == 3)
		    {
		         $user_edit= "UPDATE orders SET staff_id='0', payment_type='1' , cancel_reason = '".$_POST['cancel_reason']."' 

    	        WHERE orders.id='".$_POST['order_id']."' and orders.user_id='".$_POST['user_id']."'  ";	 
    	         $result = mysqli_query($con,$user_edit);
    	         
		    }else{
		        
		         $user_edit= "UPDATE orders SET payment_type='".$_POST['payment_type']."', cancel_reason = '".$_POST['cancel_reason']."',staff_id='".$_POST['staff_id']."'

    	        WHERE orders.id='".$_POST['order_id']."' and orders.user_id='".$_POST['user_id']."' ";	 
    	         $result = mysqli_query($con,$user_edit);
		    }
		    
            $qry1 = "SELECT * FROM `orders`
            WHERE orders.id='".$_POST['order_id']."' ";        
    		$result1 = mysqli_query($con,$qry1);
    		$row2 = mysqli_fetch_assoc($result1);

			$qry2 = "SELECT * FROM `staff`
            WHERE staff.ID ='".$_POST['staff_id']."' ";        
    		$result2 = mysqli_query($con,$qry2);
    		$row3 = mysqli_fetch_assoc($result2);    
    		
    		if($row2['payment_type'] == 2)
            {
                $tokens = $row1['token'];
                $name = $row1['name'];
                $restro_name = $row3['name'];
                $o_date = $row2['order_date'];
                $b_id = $_POST['order_id'];
                
                $notification_click = 1;
                $title="Booking ACCEPTED";
    
                // $body = "Hello " .$name. ", Your Booking with ID " .$_POST['order_id']. " has been ACCEPTED by " .$restro_name ;
    			
    			//new notification
    			$body = "Hello! " .$name. ", your Booking for BonitaA services has been accepted by our service partner " .$restro_name. ".";
											 
    					   
                send_notification($tokens,$title,$body,$b_id,$notification_click);
                
                 $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`,`no_type`, `date`, `msg`, `image`) 

				 VALUES(1,'1','1','".$row1['ID']."','".$b_id."','".$title."','2','".$date."','".$body."','')"; 

	   			$notifi_res = mysqli_query($con,$notifi_insert);
                
            }
    		
               
            if($_POST['payment_type'] == 3)
            {
                $tokens = $row1['token'];
                $name = $row1['name'];
                $restro_name = $row3['name'];
                $o_date = $row2['order_date'];
                $b_id = $_POST['order_id'];
                
                $notification_click = 1;
                $title="BOOK REJECTED";
    
                $body = "Hello " .$name. ", sorry for the inconvenience caused, as your service has been rejected.";
    					 
    					   
                send_notification($tokens,$title,$body,$b_id,$notification_click);
                
                $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 

				VALUES(1,'1','1','".$row1['ID']."','".$b_id."','".$title."',3,'".$date."','".$body."','')"; 

	   			$notifi_res = mysqli_query($con,$notifi_insert);
                
            }
            
           
            if($_POST['payment_type'] == 4)
            {
                $tokens = $row1['token'];
                $name = $row1['name'];
                $restro_name = $row3['name'];
                $o_date = $row2['order_date'];
                $b_id = $_POST['order_id'];
                
                $notification_click = 1;
                $title="BOOK COMPLETED";
                
    
                // $body = "Hello " .$name. ", Your Booking with ID " .$_POST['order_id']. " has been COMPLETED by " .$restro_name ;
                
    			//new notification
    			$body = "Hello! " .$name. ", Booking ID ".$b_id." your booking for BonitaA services has been qently completed by our service partner ".$restro_name." . Hope to serve you again.";		 
    					   
                send_notification($tokens,$title,$body,$b_id,$notification_click);
                
                 $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 

				 VALUES(1,'1','1','".$row1['ID']."','".$b_id."','".$title."','4','".$date."','".$body."','')"; 

	   			$notifi_res = mysqli_query($con,$notifi_insert);
                
            }
            
       /*     if($_POST['payment_type'] == 5)
            {
                $tokens = $row1['token'];
                $name = $row1['name'];
                $restro_name = $row3['name'];
                $o_date = $row2['order_date'];
                $b_id = $_POST['order_id'];
                
                $notification_click = 1;
                $title="BOOK CANCELLED";
              			
            //   	$body = "Hello " .$name. ",  unfortunately order has CANCELLED because of ".$_POST['cancel_reason']." your Booking with ID " .$_POST['order_id'];
    					 
    			//new notification
    			$body = "Hello! " .$restro_name. ", ".$name." with Booking ID ".$b_id." has cancelled the booking assigned to you.";		 
                send_notification($tokens,$title,$body,$b_id,$notification_click);
                
                 $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`,`no_type`, `tittle`, `date`, `msg`, `image`) 

				 VALUES(1,'1','1','".$row1['ID']."','".$b_id."','5','".$title."','".$date."','".$body."','')"; 

	   			$notifi_res = mysqli_query($con,$notifi_insert);
                
            }*/
            
            
    	 
			$set['JSON_DATA'][]=array('msg'=>'Successfully Updated','success'=>'1');
		}
		else
		{
			$set['JSON_DATA'][]=array('msg'=>'Updated Fail','success'=>'0');	 
				
		}
			
		 	header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	
}

//staff accept the order
else if(isset($_GET['staff_order_accept']))
{


	$qry = "SELECT * FROM `orders` ord
	LEFT JOIN user_registration u ON u.ID = ord.user_id
	WHERE ord.id='".$_POST['order_id']."' ";

	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row1 = mysqli_fetch_assoc($result);
		
         if ($num_rows > 0)
		{
		    
    	    $user_edit= "UPDATE orders SET payment_type='2' , staff_id = '".$_POST['staff_id']."' 

    	    WHERE orders.id='".$_POST['order_id']."' ";	 
    	    
            $result = mysqli_query($con,$user_edit);
            
            $qry1 = "SELECT * FROM `orders`
            WHERE orders.id='".$_POST['order_id']."' ";        
    		$result1 = mysqli_query($con,$qry1);
    		$row2 = mysqli_fetch_assoc($result1);

			$qry2 = "SELECT * FROM `staff`
            WHERE staff.ID ='".$_POST['staff_id']."' ";        
    		$result2 = mysqli_query($con,$qry2);
    		$row3 = mysqli_fetch_assoc($result2);    
    	
               
            if($row2['payment_type'] == 2)
            {
                $tokens = $row1['token'];
                $name = $row1['name'];
                $restro_name = $row3['name'];
                $o_date = $row2['order_date'];
                $b_id = $_POST['order_id'];
                
                $notification_click = 1;
                $title="Booking ACCEPTED";
    
                // $body = "Hello " .$name. ", Your Booking with ID " .$_POST['order_id']. " has been ACCEPTED by " .$restro_name ;
    			//new notification
    			$body = "Hello! " .$name. ", your Booking for BonitaA services has been accepted by our service partner " .$restro_name. ".";		 
    					   
                send_notification($tokens,$title,$body,$b_id,$notification_click);
                
                 $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 

				 VALUES(1,'1','1','".$row1['ID']."','".$b_id."','".$title."','2','".$date."','".$body."','')"; 

	   			$notifi_res = mysqli_query($con,$notifi_insert);
                
            }

			$set['JSON_DATA'][]=array('msg'=>'Successfully Updated','success'=>'1');
		}
		else
		{
			$set['JSON_DATA'][]=array('msg'=>'Updated Fail','success'=>'0');	 
				
		}
			
		 	header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	
}

//add to fav
else if(isset($_GET['add_fav']))
{
	// INSERT INTO `fav`(`ID`, `status`, `user_id`, `services`)
  if($_POST['user_id']!="" AND $_POST['service_id']!="" )
  {
         $qry_fav_check = "SELECT * FROM fav WHERE user_id='".$_POST['user_id']."' and service_id='".$_POST['service_id']."' "; 
                
            $result_fav     = mysqli_query($con,$qry_fav_check);
            $num_rows_fav   = mysqli_num_rows($result_fav);
            $row1 = mysqli_fetch_assoc($result_fav);
            
            if($num_rows_fav > 0)
            {
            	$delete = "DELETE FROM fav WHERE user_id='".$_POST['user_id']."' and service_id='".$_POST['service_id']."' ";
                $result1 = mysqli_query($con,$delete);

                if($result1 == 1){
                    $set['JSON_DATA'][]=array('msg' => "fav deleted successfully...!",'success'=>'1','fid'=> 0);
                }
                else{
                    $set['JSON_DATA'][]=array('msg' => "Some error occured",'success  '=>'0','fid'=> 0);
                }
            }else{
                
            //     $qry_fav_check = "SELECT * FROM fav WHERE user_id='".$_POST['user_id']."' and service_id != '".$_POST['service_id']."' "; 

	           // $result_fav     = mysqli_query($con,$qry_fav_check);
	           // $num_rows_fav   = mysqli_num_rows($result_fav);
	           // $row = mysqli_fetch_assoc($result_fav);
	            
	           // if($num_rows_fav > 0)
	           // {
	           //     $delete = "DELETE FROM fav WHERE user_id='".$_POST['user_id']."' AND service_id !='".$_POST['service_id']."' ";
	           //     $result1 = mysqli_query($con,$delete);
	           // }
	            
	            $qry1="INSERT INTO `fav`(`status`, `user_id`, `service_id`)
  			    VALUES (
  			 		'1',
					'".$_POST['user_id']."',
					'".$_POST['service_id']."'
				)"; 
  
                $result1=mysqli_query($con,$qry1);  	
                
                $last_id = mysqli_insert_id($con); 
                
                $qrys = "SELECT * FROM fav WHERE ID = '".$last_id."'"; 
                $results = mysqli_query($con,$qrys);
                $row1 = mysqli_fetch_assoc($results);	 
                
                $set['JSON_DATA'][]	=	array( 
                'msg' =>	"Add Successfully",
                'success'=>'1',
                'fid'	=>	$row1['ID'],
                );
				
                
            }
		
  			 
		}
		else{
			$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!   ",'success'=>'0');
		}	
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
}

 //delete fav user wise
else if(isset($_GET['delete_fav']))
{

		$jsonObj= array();
 		$fid=$_POST['fid'];
 	
		if($_POST['fid'] != "") 
		{
	
		$qry = "SELECT * FROM fav WHERE ID='".$fid."'  "; 
			
		$result 	= mysqli_query($con,$qry);
		$num_rows 	= mysqli_num_rows($result);
			//$row = mysqli_fetch_array($result);
			
			if($num_rows > 0)
			{
			
				$delete = "DELETE FROM fav WHERE ID='".$fid."'  ";
				$result1 = mysqli_query($con,$delete);

				if($result1 == 1)
					$set['JSON_DATA'][]=array('msg' => "fav deleted successfully...!",'success'=>'1');
				else
					$set['JSON_DATA'][]=array('msg' => "Some error occured",'success'=>'0');
				

			}
			else
			{	
				$set['JSON_DATA'][]=array('msg' => "fav Not  found",'success'=>'0');
			} 
 	
		}
		else
		{
			$set['JSON_DATA'][]=array('msg' => "Please enter fav id",'success'=>'0');
		}	 

	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
		
} 


//get fav user wise
else if(isset($_GET['get_fav']))
{


   	$jsonObj1= array();
    	
    
    $query="SELECT *,f.ID as fid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.long_description as longservicedesc,s.status as servicestatus FROM `fav` f
     LEFT JOIN user_registration user on user.ID=f.user_id
     LEFT JOIN services s on s.ID=f.service_id
     LEFT JOIN category c ON c.ID = s.category
	 LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
	 LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
     WHERE f.user_id = '".$_POST['user_id']."' 
     ORDER BY f.ID ASC ";
     $sql = mysqli_query($con,$query)or die(mysqli_error());

	    while($data = mysqli_fetch_assoc($sql))
	    {
		   
	     
		    $qrys1 = "SELECT * FROM fav
		    WHERE fav.user_id = '".$_POST['user_id']."' and fav.service_id = '".$data['serviceid']."'  "; 
			$results1 = mysqli_query($con,$qrys1);
			$row11 = mysqli_fetch_assoc($results1);
		    
		    $row1['fav_id'] = $data['fid'];

	        if($data['serviceid'] == $row11['service_id'])   
	        {
	            
	            $row1['fav_user'] = "1";
	        }else{
	            
	            $row1['fav_user'] = "0";
	        }    

	        $qrys_cart = "SELECT * FROM cart
		    WHERE cart.user_id = '".$_POST['user_id']."' and cart.services_id = '".$data['serviceid']."'  "; 
			$results_cart = mysqli_query($con,$qrys_cart);
			$row_cart = mysqli_fetch_assoc($results_cart);
		    $num_rows_cart   = mysqli_num_rows($results_cart);
	            
	        if($num_rows_cart > 0)
	        {	
	            $row1['cart_id'] = $row_cart['ID'];
	            $row1['cart_user'] = "1";
		         
		    }else{
		    	
	            $row1['cart_id'] = "0"; 
	            $row1['cart_user'] = "0";
		    }   

	        if(!empty($data['serviceimage'])){
          	    $image = UPLOAD_PATH.'service/'.$data['serviceimage'];
          	}else{
          	    $image='';
          	}

		    
			$row1['service_id'] = $data['serviceid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];
            $row1['sub_sub_category_id'] = $data['subsubid'];
            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['service_type'] = $data['type'];
            $row1['service_title'] = $data['title'];
            $row1['service_url'] = $data['url'];
            $row1['service_original_price'] = $data['original_amount'];
            $row1['service_discount_price'] = $data['discount_amount'];
            $row1['service_skucode'] = $data['skucode'];
            $row1['service_short_description'] = $data['servicedesc'];
            $row1['service_long_description'] = $data['longservicedesc'];
            $row1['service_duration'] = hoursandmins($data['duration']);
            $row1['service_discount'] = $data['discount'];
            $row1['service_image'] = $image;
            $row1['service_status'] = $data['servicestatus'];
			
		 		        
			array_push($jsonObj1,$row1);


		}

	$set['JSON_DATA'] = $jsonObj1;	


	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

//get all offer type wise
else if(isset($_GET['get_offers']))
{
  		$jsonObj4 = array();
        
        $query="SELECT *,o.ID as offerid,o.status as offerstatus,o.title as offername,o.click as offerclick,o.pic as offerimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname FROM `offers` o
		LEFT JOIN category c ON c.ID = o.category_id
		LEFT JOIN subcategory subcat ON subcat.ID = o.subcategory_id
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = o.subsubcategory_id
		WHERE o.type = '".$_POST['type']."' and o.hide = 0
		ORDER BY o.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['offerimage'])){
          	    $image = UPLOAD_PATH.'offers/'.$data['offerimage'];
          	}else{
          	    $image='';
          	}

          	// INSERT INTO `offers`(`ID`, `status`, `type`, `category_id`, `subcategory_id`, `subsubcategory_id`, `title`, `pic`, `createdon`, `modifiedon`, `sort`, `hide`)

            $row1['offers_id'] = $data['offerid'];
            $row1['type'] = $data['type'];
           
            if($data['category_id'] == null OR $data['category_id'] == 0)
            {
                $row1['category_id'] = '0';
                $row1['category_name'] = '';
            }else{
                $row1['category_id'] = $data['category_id'];
                $row1['category_name'] = $data['category_name'];
            }
            
            if($data['subcategory_id'] == null OR $data['subcategory_id'] == 0)
            {
                $row1['sub_category_id'] = '0';
                $row1['sub_category_name'] = '';
            }else{
                $row1['sub_category_id'] = $data['subcategory_id'];
                $row1['sub_category_name'] = $data['sub_name'];
            }
            
            
            if($data['subsubcategory_id'] == null OR $data['subsubcategory_id'] == 0)
            {
                $row1['sub_sub_category_id'] = '0';
                $row1['sub_sub_category_name'] = '';
            }else{
                $row1['sub_sub_category_id'] = $data['subsubcategory_id'];
                $row1['sub_sub_category_name'] = $data['subsubsubname'];
            }
           
           
            $row1['offers_click'] = $data['offerclick'];
            $row1['offers_name'] = $data['offername'];
            $row1['offers_image'] = $image;
            $row1['offers_status'] = $data['offerstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all new lunch offer
else if(isset($_GET['get_new_lunch_offers']))
{
  		$jsonObj4 = array();
        
        $query="SELECT *,n.ID as offerid,n.status as newlunchstatus,n.title as newlunchname,n.click as newlunchclick,n.pic as newlunchimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,n.height as nheight,n.width as nwidth FROM `new_lunch` n
		LEFT JOIN category c ON c.ID = n.category_id
		LEFT JOIN subcategory subcat ON subcat.ID = n.subcategory_id
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = n.subsubcategory_id
		WHERE n.status = 1
		ORDER BY n.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['newlunchimage'])){
          	    $image = UPLOAD_PATH.'new_lunch_offers/'.$data['newlunchimage'];
          	}else{
          	    $image='';
          	}

          	// INSERT INTO `offers`(`ID`, `status`, `type`, `category_id`, `subcategory_id`, `subsubcategory_id`, `title`, `pic`, `createdon`, `modifiedon`, `sort`, `hide`)

            $row1['new_lunch_id'] = $data['offerid'];
           
            if($data['category_id'] == null OR $data['category_id'] == 0)
            {
                $row1['category_id'] = '0';
                $row1['category_name'] = '';
            }else{
                $row1['category_id'] = $data['category_id'];
                $row1['category_name'] = $data['category_name'];
            }
            
            if($data['subcategory_id'] == null OR $data['subcategory_id'] == 0  )
            {
                $row1['sub_category_id'] = '0';
                $row1['sub_category_name'] = '';
            }else{
                $row1['sub_category_id'] = $data['subcategory_id'];
                $row1['sub_category_name'] = $data['sub_name'];
            }
            
            
            if($data['subsubcategory_id'] == null OR $data['subsubcategory_id'] == 0 OR $data['sub_category_name'] == null)
            {
                $row1['sub_sub_category_id'] = '0';
                $row1['sub_sub_category_name'] = '';
            }else{
                $row1['sub_sub_category_id'] = $data['subsubcategory_id'];
                $row1['sub_sub_category_name'] = $data['subsubsubname'];
            }
           
           
            $row1['new_lunch_click'] = $data['newlunchclick'];
            $row1['new_lunch_name'] = $data['newlunchname'];
            $row1['new_lunch_image'] = $image;
            $row1['new_lunch_height'] = $data['nheight'];
            $row1['new_lunch_width'] = $data['nwidth'];
            $row1['new_lunch_status'] = $data['newlunchstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//get all new lunch offer
else if(isset($_GET['get_cat_offers']))
{
  		$jsonObj4 = array();
        
        $query="SELECT *,co.ID as catofferid,co.status as catofferstatus,co.title as catoffername,co.click as catofferclick,co.pic as catofferimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,co.height as coheight,co.width as cowidth FROM `cat_offer` co
		LEFT JOIN category c ON c.ID = co.category_id
		LEFT JOIN subcategory subcat ON subcat.ID = co.subcategory_id
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = co.subsubcategory_id
		WHERE co.status = 1 and co.type=1 and co.category_id='".$_POST['category_id']."'
		ORDER BY co.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['catofferimage'])){
          	    $image = UPLOAD_PATH.'cat_offers/'.$data['catofferimage'];
          	}else{
          	    $image='';
          	}

          	// INSERT INTO `offers`(`ID`, `status`, `type`, `category_id`, `subcategory_id`, `subsubcategory_id`, `title`, `pic`, `createdon`, `modifiedon`, `sort`, `hide`)
            
            
            $row1['cat_offer_id'] = $data['catofferid'];
            
            if($data['category_id'] == null OR $data['category_id'] == 0)
            {
                $row1['category_id'] = '0';
                $row1['category_name'] = '';
            }else{
                $row1['category_id'] = $data['category_id'];
                $row1['category_name'] = $data['category_name'];
            }
            
            if($data['subcategory_id'] == null OR $data['subcategory_id'] == 0)
            {
                $row1['sub_category_id'] = '0';
                $row1['sub_category_name'] = '';
            }else{
                $row1['sub_category_id'] = $data['subcategory_id'];
                $row1['sub_category_name'] = $data['sub_name'];
            }
            
            
            if($data['subsubcategory_id'] == null OR $data['subsubcategory_id'] == 0)
            {
                $row1['sub_sub_category_id'] = '0';
                $row1['sub_sub_category_name'] = '';
            }else{
                $row1['sub_sub_category_id'] = $data['subsubcategory_id'];
                $row1['sub_sub_category_name'] = $data['subsubsubname'];
            }
            
            $row1['cat_offer_click'] = $data['catofferclick'];
            $row1['cat_offer_name'] = $data['catoffername'];
            $row1['cat_offer_image'] = $image;
            $row1['cat_offer_height'] = $data['coheight'];
            $row1['cat_offer_width'] = $data['cowidth'];
            $row1['cat_offer_status'] = $data['catofferstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all offer type wise
else if(isset($_GET['get_user_wallet_history']))
{
  		$jsonObj4 = array();
        
        $query="SELECT *,u.name as username FROM `wallet_history` w
		LEFT JOIN user_registration u ON u.ID = w.wh_user_id
		WHERE w.wh_user_id = '".$_POST['user_id']."'
		ORDER BY w.wh_id DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	// INSERT INTO `wallet_history`(`wh_id`, `wh_user_id`, `wh_amount`, `description`, `wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) 

            $row1['wh_id'] = $data['wh_id'];
            $row1['user_id'] = $data['wh_user_id'];
            $row1['user_name'] = $data['username'];
            $row1['wh_amount'] = $data['wh_amount'];
            $row1['description'] = $data['description'];
            $row1['wh_transaction_type'] = $data['wh_transaction_type'];
            $row1['wh_type'] = $data['wh_type'];
            
            $newdate = date("d M,Y H:i:s", strtotime($data['wallet_date']));
            
            if($data['wallet_date'] == "")
            {
                $row1['wallet_date'] = '';
            }else{
                $row1['wallet_date'] = $newdate;
            }
            
            // $row1['wallet_date'] = $data['wallet_date'];
            $row1['wallet_status'] = $data['wallet_status'];
        
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//reschedule the delivery order
else if(isset($_GET['add_rating']))
{
    	    
	    if($_POST['order_id']!="" and $_POST['user_id']!="")
		{
		    
		    $query_order="SELECT * FROM `orders` ord
            WHERE ord.id = '".$_POST['order_id']."' ";
            
            $sql_order = mysqli_query($con,$query_order)or die(mysqli_error());
        
            $row_order = mysqli_fetch_assoc($sql_order);
            
            $address_city_id = $row_order['city_id'];
            
	        $qry11="INSERT INTO `review`(`user_id`, `order_id`, `city`, `rate`, `comment`, `date`, `feature`, `status`) 
	        VALUES('".$_POST['user_id']."','".$_POST['order_id']."','".$address_city_id."','".$_POST['rate']."','".addslashes($_POST['comment'])."','".$now."',0,1) ";
		  
		  	$result1 = mysqli_query($con,$qry11);

           	
		    $set['JSON_DATA'][]	=	array(    
                         'msg'=>'Successfully!....',
                         'success'=>'1'
	     	);
	
	}else
	{
	    	$set['JSON_DATA'][]=array('msg'=>'Something went wrong!','success'=>'0');
	}
	
	   	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	   	  
}



//get all users reviews
else if(isset($_GET['get_city_review']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,r.ID as rid, u.ID as userid, c.ID as cityid,c.name as cityname,u.name as username,u.dp as userimage,r.status as rstatus,r.date as rdate FROM `review` r
		LEFT JOIN user_registration u ON u.ID = r.user_id
		LEFT JOIN city c ON c.ID = r.city
		WHERE r.city='".$_POST['city_id']."' and r.status = 1
		ORDER BY r.feature ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			if($data['userimage'] != "")
		    {
		        $image = UPLOAD_PATH.'users/'.$data['userimage'];
		    }else
		    {
		        $image = ""; 
		        
		    }

            $row1['review_id'] = $data['rid'];
            $row1['user_id'] = $data['userid'];
            $row1['user_name'] = $data['username'];
            $row1['user_image'] = $image;
            $row1['city_id'] = $data['cityid'];
            $row1['city_name'] = $data['cityname'];
            $row1['review_rate'] = $data['rate'];
            $row1['review_comment'] = $data['comment'];
            $row1['review_date'] = $data['rdate'];
            $row1['state_status'] = $data['rstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}



//get all brands
else if(isset($_GET['get_brands']))
{
  		$jsonObj4= array();
        
        $query="SELECT * FROM brands b
        where b.status = 1
        ORDER BY b.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `category`(`ID`, `status`, `category`, `categoryurl`, `description`, `pic`, `createdon`, `modifiedon`, `rd`, `date`, `time`, `sort`, `hide`)

          	if(!empty($data['image'])){
          	    $image = UPLOAD_PATH.'brands/'.$data['image'];
          	}else{
          	    $image='';
          	}
            $row1['brands_id'] = $data['ID'];
            $row1['brands_image'] = $image;
            $row1['brands_status'] = $data['status'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//search services
else if(isset($_GET['search_services']))
{
  		$jsonObj4= array();

  		$tableName="services";   
        $limit = 10; 

        $query = "SELECT COUNT(*) as num,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
		LEFT JOIN category c ON c.ID = s.category
		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
		WHERE s.title like '%".addslashes(trim($_GET['search_value']))."%' and s.status = 1
		ORDER BY s.sort ASC
        ";
	      
	      $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
	      $total_pages = $total_pages['num'];
	      
	      $stages = 3;
	      $page=0;
	      if(isset($_GET['page'])){
	      $page = mysqli_real_escape_string($con,$_GET['page']);
	      }
	      if($page){
	        $start = ($page - 1) * $limit; 
	      }else{
	        $start = 0; 
	        } 


        
        $query="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
		LEFT JOIN category c ON c.ID = s.category
		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
		WHERE s.title like '%".addslashes(trim($_GET['search_value']))."%' and s.status = 1
		ORDER BY s.sort ASC LIMIT $start, $limit";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['serviceimage'])){
          	    $image = UPLOAD_PATH.'service/'.$data['serviceimage'];
          	}else{
          	    $image='';
          	}
          	
          	$row1['service_id'] = $data['serviceid'];
          	$row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category_name'];
          	$row1['sub_category_id'] = $data['subid'];    
            $row1['sub_category_name'] = $data['sub_name'];
            $row1['sub_sub_category_id'] = $data['subsubid'];
            $row1['sub_sub_category_name'] = $data['subsubcategory_name'];
            $row1['service_type'] = $data['type'];
            $row1['service_title'] = $data['title'];
            $row1['service_url'] = $data['url'];
            $row1['service_original_price'] = $data['original_amount'];
            $row1['service_discount_price'] = $data['discount_amount'];
            $row1['service_skucode'] = $data['skucode'];
            $row1['service_short_description'] = $data['short_description'];
            $row1['service_long_description'] = $data['long_description'];
            $row1['service_duration'] = hoursandmins($data['duration']);
            $row1['service_discount'] = $data['discount'];
            $row1['service_image'] = $image;
            $row1['service_status'] = $data['servicestatus'];

            $qrys1 = "SELECT * FROM fav
		    WHERE fav.user_id = '".$_GET['user_id']."' and fav.service_id = '".$data['serviceid']."'  "; 
			$results1 = mysqli_query($con,$qrys1);
			$row11 = mysqli_fetch_assoc($results1);
		    $num_rows_fav   = mysqli_num_rows($results1);
	            
	        if($num_rows_fav > 0)
	        {	
	            $row1['fav_id'] = $row11['ID'];
	            $row1['fav_user'] = "1";
		         
		    }else{

	            $row1['fav_id'] = "0"; 
	            $row1['fav_user'] = "0";
		    }  

		    $qrys_cart = "SELECT * FROM cart
		    WHERE cart.user_id = '".$_GET['user_id']."' and cart.services_id = '".$data['serviceid']."'  "; 
			$results_cart = mysqli_query($con,$qrys_cart);
			$row_cart = mysqli_fetch_assoc($results_cart);
		    $num_rows_cart   = mysqli_num_rows($results_cart);
	            
	        if($num_rows_cart > 0)
	        {	
	            $row1['cart_quantity'] = $row_cart['cart_services_qty'];
	            $row1['cart_id'] = $row_cart['ID'];
	            $row1['cart_user'] = "1";
		         
		    }else{
		    	$row1['cart_quantity'] = "0";
	            $row1['cart_id'] = "0"; 
	            $row1['cart_user'] = "0";
		    }   
 	 
 	
			array_push($jsonObj4,$row1); 
		}

		$set['page'] = $_GET['page'];
		$set['totalimage'] = $total_pages;
		$set['limit'] = $limit;
		$set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


// ------------------------------------------- PARTNER / VENDOR / STAFF API --------------------------------

//delivery boy Login 
else if(isset($_GET['staff_login']))
{
    $email_id = $_POST['staff_email'];
	$password = $_POST['staff_pass'];
	$b_token = $_POST['staff_token'];

	$qry = "SELECT * FROM staff WHERE (email = '".$email_id."' or mobile = '".$email_id."') and password = '".$password."'"; 
	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
    if ($num_rows > 0)
	{ 
		
	    $user_edit= "UPDATE staff SET token='".$b_token."' WHERE (email = '".$email_id."' or mobile = '".$email_id."') and password = '".$password."'"; 
		$result1 = mysqli_query($con,$user_edit);
		
		
		
		$qry = "SELECT * FROM staff WHERE (email = '".$email_id."' or mobile = '".$email_id."') and password = '".$password."'"; 
    	$result = mysqli_query($con,$qry);
    	$num_rows = mysqli_num_rows($result);
    	$row1 = mysqli_fetch_assoc($result);
	
        if(!empty($row1['dp'])){
			$imageurl = UPLOAD_PATH.'staff/'.$row1['dp'];
		}else{
			$imageurl ="";
		}


		if(!empty($row1['bb_id_card1'])){
			$bb_id_card1 = UPLOAD_PATH.'staff/'.$row1['bb_id_card1'];
		}else{
			$bb_id_card1 ="";
		}

		if(!empty($row1['bb_id_card2'])){
			$bb_id_card2 = UPLOAD_PATH.'staff/'.$row1['bb_id_card2'];
		}else{
			$bb_id_card2 ="";
		}
		

		if(!empty($row1['adhar_card1'])){
			$adhar_card1 = UPLOAD_PATH.'staff/'.$row1['adhar_card1'];
		}else{
			$adhar_card1 ="";
		}

		if(!empty($row1['adhar_card2'])){
			$adhar_card2 = UPLOAD_PATH.'staff/'.$row1['adhar_card2'];
		}else{
			$adhar_card2 ="";
		}

		if(!empty($row1['pan_card1'])){
			$pan_card1 = UPLOAD_PATH.'staff/'.$row1['pan_card1'];
		}else{
			$pan_card1 ="";
		}

		if(!empty($row1['pan_card2'])){
			$pan_card2 = UPLOAD_PATH.'staff/'.$row1['pan_card2'];
		}else{
			$pan_card2 ="";
		}

		if(!empty($row1['bank_details1'])){
			$bank_details1 = UPLOAD_PATH.'staff/'.$row1['bank_details1'];
		}else{
			$bank_details1 ="";
		}

		if(!empty($row1['bank_details2'])){
			$bank_details2 = UPLOAD_PATH.'staff/'.$row1['bank_details2'];
		}else{
			$bank_details2 ="";
		}
		
		
		$set['JSON_DATA'][]	= array(  
										'msg'			=>	'Sucessfully Logged in   ',
										'success'=>'1',
										'staff_id'	=>	$row1['ID'],
										'staff_name' =>	$row1['name'],
										'staff_email'	=>	$row1['email'],
										'staff_image'	=> $imageurl,
										'staff_pass'	=>	$row1['password'],
										'city_id'	=>	$row1['city_id'],
										'staff_phone'	=>	$row1['mobile'],
										'bb_id_card1'	=> $bb_id_card1,
										'bb_id_card2'	=> $bb_id_card2,
										'adhar_card1'	=> $adhar_card1,
										'adhar_card2'	=> $adhar_card2,
										'pan_card1'	=> $pan_card1,
										'pan_card2'	=> $pan_card2,
										'bank_details1'	=> $bank_details1,
										'bank_details2'	=> $bank_details2,
										'holder_name'	=> $row1['holder_name'],
										'account_number'	=> $row1['account_number'],
										'ifsc_code'	=> $row1['ifsc_code'],
										'staff_token'	=>	$row1['token'],
										'staff_status'	=>	$row1['status'],
	     							);
		  
	}		 
	else
	{
		$set['JSON_DATA'][]=array('msg' =>'Invalid username and password','success'=>'0');
	}

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

// staff profile
else if(isset($_GET['staff_profile']))
{
    	
	if(isset($_POST['staff_id']) && !empty($_POST['staff_id']) )
	{
	    	
	    	$qry = "SELECT *,staff.holder_name,staff.account_number,staff.ifsc_code,city.ID as cityid,city.name as cityname,staff.ID as staffid,staff.name as staffname,staff.address as staff_address,staff.status as staffstatus FROM staff 
	    	left join city on city.ID = staff.city_id
	    	WHERE staff.ID='".$_POST['staff_id']."'"; 
			$result = mysqli_query($con,$qry);
			$row1 = mysqli_fetch_assoc($result);
			$fetch_email = mysqli_num_rows($result);
			
			 $query_order="SELECT  COUNT(*) as total_book, ROUND(avg(review.rate),2) as total_rate
    		FROM orders
    		left join review on review.order_id = orders.id
    		where orders.staff_id='".$_POST['staff_id']."' and orders.payment_type = 4 and review.rate > 0 ";

		   $result_order = mysqli_query($con,$query_order)or die(mysqli_error());

		   $row_order=mysqli_fetch_assoc($result_order);
		  
		       if($row_order['total_rate']== NULL )
    			{		             
    			    $total_rate = "0";
    			    $total_book = "0";
    		             
    			}else
    			{	
    			    
    			    $total_rate = $row_order['total_rate'];	
    			    $total_book = $row_order['total_book']	;
    
    			}
		   
			
	 	 	if($fetch_email ==1)
			{
				if(!empty($row1['dp'])){
					$imageurl = UPLOAD_PATH.'staff/'.$row1['dp'];
				}else{
					$imageurl ="";
				}


				if(!empty($row1['bb_id_card1'])){
					$bb_id_card1 = UPLOAD_PATH.'staff/'.$row1['bb_id_card1'];
				}else{
					$bb_id_card1 ="";
				}

				if(!empty($row1['bb_id_card2'])){
					$bb_id_card2 = UPLOAD_PATH.'staff/'.$row1['bb_id_card2'];
				}else{
					$bb_id_card2 ="";
				}
				

				if(!empty($row1['adhar_card1'])){
					$adhar_card1 = UPLOAD_PATH.'staff/'.$row1['adhar_card1'];
				}else{
					$adhar_card1 ="";
				}

				if(!empty($row1['adhar_card2'])){
					$adhar_card2 = UPLOAD_PATH.'staff/'.$row1['adhar_card2'];
				}else{
					$adhar_card2 ="";
				}

				if(!empty($row1['pan_card1'])){
					$pan_card1 = UPLOAD_PATH.'staff/'.$row1['pan_card1'];
				}else{
					$pan_card1 ="";
				}

				if(!empty($row1['pan_card2'])){
					$pan_card2 = UPLOAD_PATH.'staff/'.$row1['pan_card2'];
				}else{
					$pan_card2 ="";
				}

				if(!empty($row1['bank_details1'])){
					$bank_details1 = UPLOAD_PATH.'staff/'.$row1['bank_details1'];
				}else{
					$bank_details1 ="";
				}

				if(!empty($row1['bank_details2'])){
					$bank_details2 = UPLOAD_PATH.'staff/'.$row1['bank_details2'];
				}else{
					$bank_details2 ="";
				}


				$set['JSON_DATA'][]	= array(
							            'msg'	=>	'Successfully',
							            'success'=>'1',
										'staff_id'	=>	$row1['staffid'],
										'staff_name' =>	$row1['staffname'],
										'staff_email'	=>	$row1['email'],
										'staff_image'	=> $imageurl,
										'staff_pass'	=>	$row1['password'],
										'city_id'	=>	$row1['cityid'],
										'city_name'	=>	$row1['cityname'],
										'staff_phone'	=>	$row1['mobile'],
										'staff_address'	=>	$row1['staff_address'],
										'bb_id_card1'	=> $bb_id_card1,
										'bb_id_card2'	=> $bb_id_card2,
										'adhar_card1'	=> $adhar_card1,
										'adhar_card2'	=> $adhar_card2,
										'pan_card1'	=> $pan_card1,
										'pan_card2'	=> $pan_card2,
										'bank_details1'	=> $bank_details1,
										'bank_details2'	=> $bank_details2,
										'holder_name'	=> $row1['holder_name'],
										'account_number'	=> $row1['account_number'],
										'ifsc_code'	=> $row1['ifsc_code'],
										'staff_token'	=>	$row1['token'],
										'staff_status'	=>	$row1['staffstatus'],
										'total_rate' => $total_rate,
										'total_book' => $total_book,
								);
			}else{
				$set['JSON_DATA'][]=array('msg' => "Client account disable...!",'success'=>'0');
	    	}
	}else{
			$set['JSON_DATA'][]=array('msg' => "Something want wrong",'success'=>'0');
	        
	}  

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//logout staff
else if(isset($_GET['logout_staff']))
{
	if($_POST['staff_id']!="" )
	{
	
		$b_id = $_POST['staff_id'];

		$user_edit= "UPDATE staff SET token = '' WHERE ID = '".$b_id."'  "; 
        $user_res = mysqli_query($con,$user_edit);

			$set['JSON_DATA'][]	= array(  
			'msg' =>	"Logout",
			'success'=>'1'
	     	);
		  
    
     }else {
		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
	}

	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//reschedule the delivery order
else if(isset($_GET['reschedule_order']))
{
    	    
	$qry = "SELECT * FROM orders WHERE id = '".$_POST['order_id']."' "; 
		$result = mysqli_query($con,$qry);
		$row = mysqli_fetch_assoc($result);
		
	$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0)
		{
	      
            
            $times = 0;
            
            $query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
            LEFT JOIN services s on s.ID = orderdetails.service_id
            WHERE orderdetails.order_id='".$_POST['order_id']."'
            ORDER BY orderdetails.id ASC";
            
            $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

            while($data_order_details = mysqli_fetch_array($sql_order_details))
            {
                
                $times += $data_order_details['duration']*$data_order_details['qty'];
        
            }           
            
            //echo $times;
            //exit;
            $total_time_slot = $times / 30;
            
            $total_time_slot_round = round($total_time_slot);
            
            
            $all_timeslot = array();
            
            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
            $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
            while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
            {
            
            $row2 = $data_timeslot['timeslot'];
            
            array_push($all_timeslot,$row2);
            
            }
            
            // print_r($all_timeslot);
            $new = array();
            foreach ($all_timeslot as $key => $value) {
                    //echo $value;
                if ($value === $_POST['order_time']) {
                    // echo  $key;
                    // $search = $key;
                    //  	$times1 = $_POST['order_time'];
                    //   array_push($new,$times1); 
                
                    for ($x = 0; $x < $total_time_slot_round; $x++) {
                    
                        $new[$key] = $all_timeslot[$key];
                        
                        if($new[$key] == "")
                        {
                            break;
                        }
                            $key++;
                    }
            
                }
            }
            
            $string_version = implode(',', $new);
            
            $object1 = json_encode($string_version);
			                
           $qry11="UPDATE `orders` SET `order_date` = '".$_POST['order_date']."' , `order_time` = $object1
	       WHERE id = '".$_POST['order_id']."'";
	       
	       $result1 = mysqli_query($con,$qry11);
	       
	        $qry1 = "SELECT * FROM `orders`
            WHERE orders.id='".$_POST['order_id']."' ";        
    		$result1 = mysqli_query($con,$qry1);
    		$row2 = mysqli_fetch_assoc($result1);
    
    		$qry2 = "SELECT * FROM `staff`
            WHERE staff.ID ='".$row2['staff_id']."' ";        
    		$result2 = mysqli_query($con,$qry2);
    		$row3 = mysqli_fetch_assoc($result2);    
    		
            $qry3 = "SELECT * FROM `user_registration`
            WHERE user_registration.ID='".$row2['user_id']."' ";        
            $result3 = mysqli_query($con,$qry3);
            $row4 = mysqli_fetch_assoc($result3); 
    		
    
            $tokens = $row3['token'];
            $name = $row4['name'];
            $restro_name = $row3['name'];
            $o_date = $_POST['order_date'];
            $o_time = $_POST['order_time'];
            $order_id = $_POST['order_id'];
            
            $notification_click = 1;
            $title="BOOK RESCHEDULE";
            
            //new notification		
          	$body = "Hello! " .$restro_name. ",".$name." with Booking ID ".$order_id." has just reschedule the booking assigned you to ".$o_date." & ".$o_time.".";
					 
					   
            send_notification($tokens,$title,$body,$order_id,$notification_click);
             
            
            $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 

		    VALUES(1,'1','2','".$row3['ID']."','".$order_id."','".$title."','8','".$date."','".$body."','')"; 
		 
            
    //          $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `date`, `msg`, `image`) 

			 //VALUES(1,'1','1','".$row3['ID']."','".$order_id."','".$title."','".$now."','".$body."','')"; 

   			$notifi_res = mysqli_query($con,$notifi_insert);
           	
		    $set['JSON_DATA'][]	=	array(    
                         'msg'=>'Successfully Updated!....',
                         'success'=>'1'
	     	);
	
	}else
	{
	    	$set['JSON_DATA'][]=array('msg'=>'Something went wrong!','success'=>'0');
	}
	
	   	
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();	   	  
}

//today pending order
else if(isset($_GET['get_today_order_staff_pending']))
{


 		$jsonObj4= array();	

 		 $query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.payment_type='1' and ord.staff_id = '".$_POST['staff_id']."'
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
 			
            if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
            
    		$row2['order_time'] = $arr[0];

    		if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;


    		$product_details = json_decode($data['product_details'], true);

    		$row2['product_details'] = $product_details;
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount =  $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";

    		

 			// $row['order_time'] = $data['order_time'];


			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//today staff booking
else if(isset($_GET['get_today_order_staff']))
{


 		$jsonObj4= array();	

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_POST['staff_id']."' and ord.order_date='".$newrd."'
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null)
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
            
            if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
            
    		$row2['order_time'] = $arr[0];

    		if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;

    		$product_details = json_decode($data['product_details'], true);

    		$row2['product_details'] = $product_details;
    		$row2['service_price'] = $data['service_price'];
    		
    		$service_final_amount = $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//upcoming staff booking
else if(isset($_GET['get_upcoming_order_staff']))
{


 		$jsonObj4= array();	

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_POST['staff_id']."' and ord.order_date > '".$newrd."'
 		ORDER BY ord.id DESC";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
 			
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
 		
    		$row2['order_time'] = $arr[0];

    		if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;

    		$product_details = json_decode($data['product_details'], true);

    		$row2['product_details'] = $product_details;
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount =$data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
		
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//dashboad
else if(isset($_GET['staff_dashboad']))
{

		$jsonObj= array();	
            
        // 1=Pending,2=Accepted,3=Rejected,4=Completed,5=Canceled
        
		$query1 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.order_date = '".$newrd."' ";
		$total_pages1 = mysqli_fetch_array(mysqli_query($con,$query1));
		$today_order = $total_pages1['num'];
		
		$query2 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' ";
		$total_pages2 = mysqli_fetch_array(mysqli_query($con,$query2));
		$total_order = $total_pages2['num'];

		$query3 = "SELECT COUNT(*) 
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 1 and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."'  ";
		$total_pages3 = mysqli_fetch_array(mysqli_query($con,$query3));
		$total_todaypending_order = $total_pages3['num'];     
        
		$query4 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and (orders.payment_type = 2 or orders.payment_type=6 or orders.payment_type=7  ) and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' ";
		$total_pages4 = mysqli_fetch_array(mysqli_query($con,$query4));
		$total_todayaccept_order = $total_pages4['num'];  
        
	
		$query8 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 3 and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' ";
		$total_pages8 = mysqli_fetch_array(mysqli_query($con,$query8));
		$total_todayreject_order = $total_pages8['num'];  


		$query7 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 4 and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' ";
		$total_pages7 = mysqli_fetch_array(mysqli_query($con,$query7));
		$total_todaydelivered_order = $total_pages7['num'];  

		$query6 = "SELECT COUNT(*)
		as num FROM orders where orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 5 and orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' ";
		$total_pages6 = mysqli_fetch_array(mysqli_query($con,$query6));
		$total_todaycancle_order = $total_pages6['num'];     
        
        $final_prices = 0;
        $query9 = "SELECT * FROM orders where orders.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."'  and payment_type = 4 and orders.staff_id='".$_GET['staff_id']."'  ";
        $total_pages9 = mysqli_query($con,$query9);
        while($row=mysqli_fetch_array($total_pages9, TRUE))
        {
            $final_price = 0;
            $order_id = $row['id'];
            
            $sql1 = "SELECT t1.* FROM `orders_detail` t1 
            LEFT JOIN `orders` t3 ON t3.ID=t1.order_id 
            WHERE t1.order_id='$order_id'  ";
            $result_pages = mysqli_query($con,$sql1);
            while($row12 = mysqli_fetch_assoc($result_pages))
            { 
                
                $final_price += ($row12['dis_price']*$row12['qty']);
                
            }
            
             $final_prices += ($final_price + $row['conveyance_charges'] + $row['safety_hygiene_charges']) - $row['coupon_value'];
        }
       
    
        $set['total_order'] = $total_order;    
		$set['today_order'] = $today_order;
		$set['total_pending_order'] = $total_todaypending_order;
		$set['total_accept_order'] = $total_todayaccept_order;
		$set['total_reject_order'] = $total_todayreject_order;
		$set['total_delivered_order'] = $total_todaydelivered_order;
		$set['total_cancle_order'] = $total_todaycancle_order;
		
		if($final_prices !=null)
        {
        	$set['total_amount'] = "$final_prices";
        }else{
        	$set['total_amount'] = "0";
        }


 	
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

}

//past staff booking
else if(isset($_GET['get_past_order_staff']))
{
    
    if($_GET['s_date'] != "" or $_GET['e_date']!= "" )
    {

 		$jsonObj4= array();	
 		
        $tableName="orders";   
        $limit = 10; 
        
        $query = "SELECT COUNT(*) as num FROM $tableName ord
        LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_GET['staff_id']."' and ord.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' AND ord.payment_type != '1'
 		ORDER BY ord.id DESC";
        
        $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
        $total_pages = $total_pages['num'];
        
        $stages = 3;
        $page=0;
        
        if(isset($_GET['page'])){
        $page = mysqli_real_escape_string($con,$_GET['page']);
        }
        if($page){
        $start = ($page - 1) * $limit; 
        }else{
        $start = 0; 
        }

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_GET['staff_id']."' and ord.order_date BETWEEN '".$_GET['s_date']."' AND '".$_GET['e_date']."' AND ord.payment_type != '1'
 		ORDER BY ord.id DESC LIMIT $start, $limit";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           
	  		
	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
 			
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
 		
    		$row2['order_time'] = $arr[0];

    		if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;

    		$product_details = json_decode($data['product_details'], true);

    		$row2['product_details'] = $product_details;
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount =  $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";

 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
			
		$set['page'] = $_GET['page'];
        $set['totalimage'] = $total_pages;
        $set['limit'] = $limit;
        $set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }else {
        
        $jsonObj4= array();	
 		
        $tableName="orders";   
        $limit = 10; 
        
        $query = "SELECT COUNT(*) as num FROM $tableName ord
        LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_GET['staff_id']."' AND ord.payment_type != '1'
 		ORDER BY ord.id DESC";
        
        $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
        $total_pages = $total_pages['num'];
        
        $stages = 3;
        $page=0;
        
        if(isset($_GET['page'])){
        $page = mysqli_real_escape_string($con,$_GET['page']);
        }
        if($page){
        $start = ($page - 1) * $limit; 
        }else{
        $start = 0; 
        }

 		$query="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
		username,a.ID as adderssid,a.status as
		adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
		addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
		adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
		LEFT JOIN user_registration u ON u.ID = ord.user_id
		LEFT JOIN staff s ON s.ID = ord.staff_id
		LEFT JOIN address a ON a.ID = ord.address
		LEFT JOIN review r ON r.ID = ord.id
 		WHERE ord.staff_id='".$_GET['staff_id']."' AND ord.payment_type != '1'
 		ORDER BY ord.id DESC LIMIT $start, $limit";
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{

			if($data['staffid']== NULL && $data['staffname']==NULL && $data['staffphone']==NULL )
            {
                $row2['staff_id']= '0';
                $row2['staff_name']= '';
                $row2['staff_phone']= '';
            }else
            {
                $row2['staff_id'] = $data['staffid']; 
                $row2['staff_name'] = $data['staffname'];
                $row2['staff_phone'] = $data['staffphone'];
            }

            $order_details = array(); 

			$query_order_details="SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.short_description as short_description,orderdetails.type as ordertype FROM `orders_detail` orderdetails
			LEFT JOIN category cat ON cat.ID = orderdetails.category_id
			LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
			LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
			LEFT JOIN services services ON services.ID = orderdetails.service_id
			WHERE orderdetails.order_id='".$data['orderid']."'
			ORDER BY orderdetails.id ASC";

		    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

		    while($data_order_details = mysqli_fetch_array($sql_order_details))
		   	{
		   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
		   		$row1['order_type'] = $data_order_details['ordertype'];
		   		$row1['order_id'] = $data_order_details['order_id'];
		   		$row1['category_id'] = $data_order_details['category_id'];
		   		$row1['category_name'] = $data_order_details['categoryname'];
		   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
		   		$row1['sub_category_name'] = $data_order_details['sub_name'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
		   		$row1['sub_sub_category_id'] = $data_order_details['subsubsubname'];
		   		$row1['service_id'] = $data_order_details['service_id'];
		   		$row1['service_name'] = $data_order_details['servicename'];
		   		$row1['service_short_description'] = $data_order_details['short_description'];
		   		$row1['qty'] = $data_order_details['qty'];
		   		$row1['ori_price'] = $data_order_details['ori_price'];
		   		$row1['dis_price'] = $data_order_details['dis_price'];
		 			
				array_push($order_details,$row1); 
	           
	  		}           

	  		
	  		// INSERT INTO `orders`(`id`, `user_id`, `staff_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

	  		$newdate = date("d M, Y", strtotime($data['order_date']));


	    	$row2['order_id'] = $data['orderid'];
			$row2['user_id'] = $data['userid'];
			$row2['user_name'] = $data['username'];
			// $row['address'] = $data['address'];

			$query_rate="SELECT * FROM `review` 
			WHERE review.order_id='".$data['orderid']."' ";

		    $sql_rate = mysqli_query($con,$query_rate)or die(mysqli_error());
		    $data_rate = mysqli_fetch_array($sql_rate);
            $num_rows_rate 	= mysqli_num_rows($sql_rate);
      
	        if($data_rate['rate'] == null )
			{
				$row2['rate'] = '0';
				$row2['comment'] = '';
			}else{
				$row2['rate'] = $data_rate['rate'];
				$row2['comment'] = $data_rate['comment'];
			}

			if($data['adderssid'] == '0' or $data['adderssid'] == null)
			{
				$row2['a_id'] = '0';
				$row2['a_name'] = '';
				$row2['a_number'] = '';
				$row2['a_house_no'] = '';
				$row2['a_lendmark'] = '';
				$row2['a_address'] = '';
				$row2['a_pincode'] = '';
				$row2['a_lat'] = '';
				$row2['a_long'] = '';

			}else{
				$row2['a_id'] = $data['adderssid'];
				$row2['a_name'] = $data['adderssname'];
				$row2['a_number'] = $data['adderssnumber'];
				$row2['a_house_no'] = $data['addersshouserno'];
				$row2['a_lendmark'] = $data['addersslendmark'];
				$row2['a_address'] = $data['addersses'];
				$row2['a_pincode'] = $data['addersspincode'];
				$row2['a_lat'] = $data['addersslatitude'];
				$row2['a_long'] = $data['addersslongitude'];
			}
			

			$row2['order_details'] = $order_details;
			// $row['address'] = $data['address'];
			$row2['payment_type'] = $data['payment_type'];
	    	$row2['message'] = $data['message'];
	    	$row2['dis_price'] = $data['dis_price'];
	    	$row2['conveyance_charges'] = $data['conveyance_charges'];
	    	$row2['safety_hygiene_charges'] = $data['safety_hygiene_charges'];
	  		$row2['final_price'] = $data['final_price'];
			$row2['payment_status'] = $data['payment_status'];
			$row2['order_status'] = $data['order_status'];	
        	$row2['txnid'] = $data['txnid'];		    	    	
			$row2['mihpayid'] = $data['mihpayid'];
			$row2['payu_status'] = $data['payu_status'];
 			$row2['coupon_id'] = $data['coupon_id'];
 			$row2['coupon_value'] = $data['coupon_value'];
 			$row2['coupon_code'] = $data['coupon_code'];
 			$row2['added_on'] = $data['added_on'];

 			$row2['order_date'] = $newdate;
 			
 			if ($data['order_time'] != "") 
 			{
                $arr1= explode(",",$data['order_time']);
                $arr = array_filter($arr1, 'strlen');
            }else
            {
                $arr = [] ;
            }
    
            
    		$row2['order_time'] = $arr[0];


    		if(!empty($data['partner_pic'])){
				$partner_pic = UPLOAD_PATH.'orders/'.$data['partner_pic'];
			}else{
				$partner_pic ="";
			}

			if(!empty($data['setup_pic'])){
				$setup_pic = UPLOAD_PATH.'orders/'.$data['setup_pic'];
			}else{
				$setup_pic ="";
			}

			if(!empty($data['product_pic'])){
				$product_pic = UPLOAD_PATH.'orders/'.$data['product_pic'];
			}else{
				$product_pic ="";
			}

    		$row2['partner_pic'] = $partner_pic;
    		$row2['setup_pic'] = $setup_pic;
    		$row2['product_pic'] = $product_pic;

    		$product_details = json_decode($data['product_details'], true);

    		$row2['product_details'] = $product_details;
    		$row2['service_price'] = $data['service_price'];

    		$service_final_amount = $data['final_price'];
    		$row2['txtfinalamount'] = "$service_final_amount";
    		
 			// $row['order_time'] = $data['order_time'];
			
			array_push($jsonObj4,$row2); 
			
			
			}
			
		$set['page'] = $_GET['page'];
        $set['totalimage'] = $total_pages;
        $set['limit'] = $limit;
        $set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj4;	

 		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
        
    }
}

//delivery boy status update
else if(isset($_GET['staff_status_update']))
{
	$qry = "SELECT * FROM staff WHERE ID = '".$_POST['staff_id']."' "; 
		$result = mysqli_query($con,$qry);
		$row = mysqli_fetch_assoc($result);
		
	$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0)
		{
	        $qry11="UPDATE `staff` SET `status` = '".$_POST['status']."' 
	       WHERE ID = '".$_POST['staff_id']."'";
		  
		  	$result1 = mysqli_query($con,$qry11);

           	
		    $set['JSON_DATA'][]	=	array(    
                         'msg'=>'Successfully Updated!....',
                         'success'=>'1'
	     	);
	
	}else
	{
	    	$set['JSON_DATA'][]=array('msg'=>'Something went wrong!','success'=>'0');
	}

		
    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

//get all notification
else if(isset($_GET['get_users_notification']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,n.ID as nid,n.tittle as ntitle, n.date as ndate, n.msg as nmsg, n.image as nimage,n.status as nstatus FROM `notification` n
		LEFT JOIN user_registration u ON u.ID = n.user_id
		WHERE n.type = '".$_POST['type']."' and ( n.user_id = '".$_POST['user_id']."' OR n.user_id = 0 ) and n.status = 1
		ORDER BY n.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['nimage'])){
          	    $image = UPLOAD_PATH.'notification/'.$data['nimage'];
          	}else{
          	    $image='';
          	}
          	$newdate = date("d M, Y", strtotime($data['ndate']));

            $row1['notification_id'] = $data['nid'];
            $row1['notification_title'] = $data['ntitle'];
            $row1['notification_date'] = $newdate;
            $row1['notification_msg'] = $data['nmsg'];
            $row1['notification_image'] = $image;
            $row1['notification_status'] = $data['nstatus'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all user notification
else if(isset($_GET['get_notification_user']))
{
  		 $jsonObj4= array();	
  		 
  		 
  		 // type : boy-3, vendor-1, user-2
  		 //notification_click : 1->click , 0-> noclick
        
		 $query="SELECT * FROM notification WHERE (user_id='".$_POST['user_id']."' or user_id = 0 ) and (type ='".$_POST['type']."' or type = 0 )  ORDER BY `ID` DESC";

		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{		 
            //INSERT INTO `notification`(`ID`, `status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `date`, `msg`, `image`)
            $row1['id'] = $data['ID'];
            $row1['type'] = $data['type'];
            $row1['notification_click'] = $data['click'];
            $row1['user_id'] = $data['user_id'];
            $row1['order_id'] = $data['order_id'];
            
            $newdate = date("d M, Y H:i:s", strtotime($data['date']));
            
            if($data['date'] == "")
            {
                $row1['date'] = '';
            }else{
                $row1['date'] = $newdate;
            }
            if(!empty($data['image'])){
          	    $image = UPLOAD_PATH.'notification/'.$data['image'];
          	}else{
          	    $image='';
          	}
              	
            $row1['image'] = $image;
            $row1['no_type'] = $data['no_type'];
            $row1['tittle'] = $data['tittle'];
            $row1['msg'] = $data['msg'];
            $row1['status'] = $data['status'];
 			
 	
 	
			array_push($jsonObj4,$row1); 
			}
			
		$query1 = "SELECT COUNT(*) as num FROM notification WHERE (user_id='".$_POST['user_id']."' or user_id = 0 ) and (type ='".$_POST['type']."' or type = 0 ) ORDER BY `ID` DESC";  
        $total_pages1 = mysqli_fetch_array(mysqli_query($con,$query1));
        $total_order = $total_pages1['num'];
        

	    $set['total_count'] = $total_order;
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//add to fav to card
else if(isset($_GET['add_fav_to_card']))
{
	
		if($_POST['user_id']!="" AND $_POST['service_id']!="" )
		{

			$qry_product_check = "SELECT * FROM services WHERE ID='".$_POST['service_id']."'  "; 
            
            $result_product_check     = mysqli_query($con,$qry_product_check);
            $num_rows_product_check   = mysqli_num_rows($result_product_check);
            $row_product_check = mysqli_fetch_assoc($result_product_check);

            
            $f_price = $row_product_check['original_amount'];
            $f_dis_price = $row_product_check['discount_amount'];
            

           	if($num_rows_product_check>0){
                    
                    
		            $qry_product_check_cart = "SELECT * FROM cart WHERE user_id='".$_POST['user_id']."' AND services_id ='".$_POST['service_id']."'  "; 
            		
		            $result_product_check_cart     = mysqli_query($con,$qry_product_check_cart);
		            $num_rows_product_check_cart   = mysqli_num_rows($result_product_check_cart);
		            $row_product_check_cart = mysqli_fetch_assoc($result_product_check_cart);
		            if($num_rows_product_check_cart > 0){

		            	
	                        $set['JSON_DATA'][]=array('msg' => "This Service is already exists in cart",'success'=>'0','cart_id'=> 0);
		            	

		            }else{
		            	$qry_insert="INSERT INTO `cart`(`user_id`, `services_id`, `cart_services_qty`, `cart_services_dis_amount`,`cart_services_ori_amount`,
						`status`)
						VALUES ('".$_POST['user_id']."','".$_POST['service_id']."', '1', '".$f_dis_price."','".$f_price."','1')"; 

						$result_insert=mysqli_query($con,$qry_insert);
						
                        
                        $last_id = mysqli_insert_id($con); 
             
                        $set['JSON_DATA'][] =   array( 
                        'msg' =>    "Add Successfully",
                        'success'=>'1',
                        'cart_id'=> "$last_id"
                        );
                        
                        $delete11 = "DELETE FROM fav WHERE user_id='".$_POST['user_id']."' and service_id='".$_POST['service_id']."'  ";
                        $result11 = mysqli_query($con,$delete11);
                        
		            }




		           	

           	}else{
           		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!111   ",'success'=>'0');
           	}

		            
		}
		else{
			$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!2   ",'success'=>'0');
		}	
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
}


//get sub category category wise 
else if(isset($_GET['get_hot_deals_offer_service']))
{
  		$jsonObj4= array();
        
        
        
        if(!empty($_POST['category_id'])){
            $query="SELECT *,s.ID as subid, c.ID as catid,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.category_id = '".$_POST['category_id']."' and s.status = 1
    		ORDER BY s.sort ASC";
        }else{
            $query="SELECT *,s.ID as subid, c.ID as catid,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.status = 1 
    		ORDER BY s.sort ASC";
        }
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `subcategory`(`ID`, `status`, `category_id`, `subcategory`, `description`, `subcategoryurl`, `pic`, `createdon`, `modifiedon`, `rd`, `date`, `time`, `sort`, `hide`)

          	if(!empty($data['subimage'])){
          	    $image = UPLOAD_PATH.'subcategory/'.$data['subimage'];
          	}else{
          	    $image='';
          	}
          	
          	
          	
          	$jsonObj3 = array();   

            $query1="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
            LEFT JOIN category c ON c.ID = subsubcat.category
            LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
            WHERE subsubcat.category = '".$data['category_id']."' and subsubcat.subcategory = '".$data['subid']."' and subsubcat.status = 1
            ORDER BY subsubcat.sort ASC ";

            $result2 = mysqli_query($con,$query1)or die(mysqli_error());

            while($data1 = mysqli_fetch_assoc($result2))
            {   

                if(!empty($data1['subsubimage'])){
                $image1 = UPLOAD_PATH.'subsubcategory/'.$data1['subsubimage'];
                }else{
                    $image1='';
                }
                $row2['sub_sub_category_id'] = $data1['subsubid'];
                // $row2['category_id'] = $data1['catid'];
                // $row2['category_name'] = $data1['category_name'];
                // $row2['sub_category_id'] = $data1['subid'];    
                // $row2['sub_category_name'] = $data1['sub_name'];

                // $row2['sub_sub_category_name'] = $data1['subsubcategory_name'];
                // $row2['sub_sub_category_url'] = $data1['subsubcategoryurl'];
                // $row2['sub_sub_category_image'] = $image1;
                // $row2['sub_sub_category_description'] = $data1['subsubdescription'];
                // $row2['sub_sub_category_status'] = $data1['subsubstatus'];
                
                array_push($jsonObj3, $row2);   

            }
          	
          	
          	
          	$row1['sub_category_id'] = $data['subid'];
            $row1['category_id'] = $data['catid'];
            $row1['category_name'] = $data['category'];
            $row1['sub_category_name'] = $data['subcategory'];
            $row1['sub_category_url'] = $data['subcategoryurl'];
            
            $row1['sub_category_image'] = $image;
            $row1['sub_category_description'] = $data['description'];
            $row1['sub_category_status'] = $data['substatus'];
            $row1['service_variant'] = $jsonObj3;
            
            
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all video
else if(isset($_GET['get_video']))
{
  		$jsonObj4= array();
        
        $query="SELECT * FROM video v
        where v.status = 1
        ORDER BY v.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	

          	if(!empty($data['image'])){
          	    $image = UPLOAD_PATH.'videos/'.$data['image'];
          	}else{
          	    $image='';
          	}
            $row1['video_id'] = $data['ID'];
            $row1['video_name'] = $data['name'];
            $row1['video_url'] = $data['url'];
            $row1['video_image'] = $image;
            $row1['video_status'] = $data['status'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


// ================================ New moudle api for staff ========================================



//staff apply for leaves
else if(isset($_GET['staff_apply_leaves']))
{
  if($_POST['staff_id']!="" AND $_POST['start_date']!="" )
  {


            // $qry_fav_check = "SELECT * FROM staff_leaves WHERE start_date >= '".$_POST['start_date']."' and end_date <= '".$_POST['end_date']."' "; 
                
            // $result_fav     = mysqli_query($con,$qry_fav_check);
            // $num_rows_fav   = mysqli_num_rows($result_fav);
            // $row1 = mysqli_fetch_assoc($result_fav);
            
            // if($num_rows_fav > 0)
            // {
            // 	$set['JSON_DATA'][]=array('msg' => "This date you have to already apply.",'success'=>'0');
            // }else{

	            $qry1="INSERT INTO `staff_leaves`( `status`, `staff_id`, `type`, `cdate`, `message`, `leave_status`, `start_date`, `end_date`)
  			    VALUES (
  			 		'1',
					'".$_POST['staff_id']."',
					'".$_POST['type']."',
					'".$date."',
					'".$_POST['message']."',
					'1',
					'".$_POST['start_date']."',
					'".$_POST['end_date']."'
				)"; 
  
                $result1=mysqli_query($con,$qry1);  	
                
                $last_id = mysqli_insert_id($con); 
              
                $set['JSON_DATA'][]	=	array( 
                'msg' =>	"Add Successfully",
                'success'=>'1',
                );
				
                
            //}
		
  			 
		}
		else{
			$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
		}	
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
}


//staff list for leaves data
//staff list for leaves data
else if(isset($_GET['get_staff_leaves']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,s.name as staffname, s.ID as staffid,sl.ID as leavesid,sl.type as leavestype,sl.cdate as leavescdate, sl.message as leavesmessage,sl.start_date as leavessdate,sl.end_date as leavesedate,sl.status as leavesstatus FROM staff_leaves sl
        left join staff s on s.ID = sl.staff_id 
        where sl.status = 1 and staff_id = '".$_POST['staff_id']."'
        ORDER BY sl.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `staff_leaves`(`ID`, `status`, `staff_id`, `type`, `cdate`, `message`, `leave_status`, `start_date`, `end_date`)
          	$leaves_s_date = date("d M, Y", strtotime($data['leavessdate']));
          	$leaves_e_date = date("d M, Y", strtotime($data['leavesedate']));

          	if($data['leavesedate'] == "")
          	{
          		$edate = $data['leavessdate'];
          	}else{
          		$edate = $data['leavesedate'];
          	}
          	$sdate = $data['leavessdate'];

            $row1['leaves_id'] = $data['leavesid'];
            $row1['staff_id'] = $data['staffid'];
            $row1['staff_name'] = $data['staffname'];
            $row1['leaves_type'] = $data['leavestype'];
            $row1['leaves_cdate'] = $data['leavescdate'];
            $row1['leaves_message'] = $data['leavesmessage'];
            
            if(!empty($data['leavessdate']) ){
            	$row1['leaves_start_date'] = $leaves_s_date;
            }else{
            	$row1['leaves_start_date']="";
            }

            if(!empty($data['leavesedate']) ){
            	$row1['leaves_end_date'] = $leaves_e_date;
            }else{
            	$row1['leaves_end_date'] = "";
            }


            $row1['leaves_status'] = $data['leavesstatus'];
            $row1['leave_status'] = $data['leave_status'];

           $query_count = "SELECT t.*, datediff(greatest(t.end_date, '$edate'), least(t.start_date, '$sdate')) + 1 as total_days from staff_leaves t where t.ID = '".$data['leavesid']."' ";
            // $sql_count = mysqli_query($con,$query_count)or die(mysqli_error());
            // $row_count=mysqli_fetch_assoc($sql_count);

            $total_count = mysqli_fetch_array(mysqli_query($con,$query_count));
			$total_count = $total_count['total_days'];

            //leaves_type
			//1-full day,2-Moring half day,3- Evening half day,4-mutiple days	
            if($data['leavestype'] == 1)
			{	
				$type = 'Full Day';
				$total_days = $type.' - '.$total_count.' days';

			}else if($data['leavestype'] == 2){
				$type ='Half Day - Morning';
				$total_days = $type;
			}else if($data['leavestype'] == 3){
				$type ='Half Day - Evening';
				$total_days = $type;
			}else if($data['leavestype'] == 4){
				$type ='Full Day';
				$total_days = $type.' - '.$total_count.' days';
			}         

          	// if($data['total_days'] == 0){
          	// 	$row1['total_days'] = '1';
          	// }else{
            // 	$row1['total_days'] = $data['total_days'].'days';

          	// }

          	$row1['total_days'] =  $total_days;
          	$row1['cancel_reason'] = $data['cancel_reason'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}


else if(isset($_GET['get_staff_leaves_old']))
{
  		$jsonObj4= array();
        
        $query="SELECT *,s.name as staffname, s.ID as staffid,sl.ID as leavesid,sl.type as leavestype,sl.cdate as leavescdate, sl.message as leavesmessage,sl.start_date as leavessdate,sl.end_date as leavesedate,sl.status as leavesstatus,DATEDIFF(sl.end_date, sl.start_date) AS total_days FROM staff_leaves sl
        left join staff s on s.ID = sl.staff_id 
        where sl.status = 1 and staff_id = '".$_POST['staff_id']."'
        ORDER BY sl.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `staff_leaves`(`ID`, `status`, `staff_id`, `type`, `cdate`, `message`, `leave_status`, `start_date`, `end_date`)
          	
           $leaves_s_date = date("d M, Y", strtotime($data['leavessdate']));
          	$leaves_e_date = date("d M, Y", strtotime($data['leavesedate']));

            $row1['leaves_id'] = $data['leavesid'];
            $row1['staff_id'] = $data['staffid'];
            $row1['staff_name'] = $data['staffname'];
            $row1['leaves_type'] = $data['leavestype'];
            $row1['leaves_cdate'] = $data['leavescdate'];
            $row1['leaves_message'] = $data['leavesmessage'];
            if(!empty($data['leavessdate']) ){
            	$row1['leaves_start_date'] = $leaves_s_date;
            }else{
            	$row1['leaves_start_date']="";
            }

            if(!empty($data['leavesedate']) ){
            	$row1['leaves_end_date'] = $leaves_e_date;
            }else{
            	$row1['leaves_end_date'] = "";
            }

            //$row1['leaves_start_date'] = $leaves_s_date;
            //$row1['leaves_end_date'] = $leaves_e_date;
            $row1['leaves_status'] = $data['leavesstatus'];
            $row1['leave_status'] = $data['leave_status'];
            //leaves_type
			//1-full day,2-Moring half day,3- Evening half day,4-mutiple days	
            if($data['leavestype'] == 1)
			{	
				$type = 'Full Day';
				$total_days = $type.' - '.$data['total_days'].'days';

			}else if($data['leavestype'] == 2){
				$type ='Half Day - Morning';
				$total_days = $type;
			}else if($data['leavestype'] == 3){
				$type ='Half Day - Evening';
				$total_days = $type;
			}else if($data['leavestype'] == 4){
				$type ='Full Day';
				$total_days = $type.' - '.$data['total_days'].'days';
			}         

          	// if($data['total_days'] == 0){
          	// 	$row1['total_days'] = '1';
          	// }else{
            // 	$row1['total_days'] = $data['total_days'].'days';

          	// }

          	$row1['total_days'] =  $total_days;
          	$row1['cancel_reason'] = $data['cancel_reason'];
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}



//staff for reachage fine and rewards list
else if(isset($_GET['get_staff_recharge_fine']))
{
  		$jsonObj4= array();


        
        $query="SELECT *,s.name as staffname, s.ID as staffid,rf.ID as rechargefineid,rf.type as rechargefinetype,rf.cdate as rechargefinecdate,rf.start_date as rechargefinesdate,rf.end_date as rechargefineedate,rf.status as rechargefinestatus,rf.title as rechargefinetitle,rf.description as rechargefinedesc,rf.price as rechargefineprice,rf.recharge_fine_type as recharge_fine_type
         FROM recharge_fine rf
        left join staff s on s.ID = rf.staff_id 
        where rf.status = 1 and rf.staff_id = '".$_POST['staff_id']."' and rf.recharge_fine_type = '".$_POST['rechargefine_type']."'
        ORDER BY rf.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `recharge_fine`(`ID`, `status`, `staff_id`, `recharge_fine_type`, `title`, `description`, `price`, `start_date`, `end_date`, `type`) 
          	    

          	
          	if($data['rechargefinesdate'] == "")
          	{
          	    $rechange_date = "";
          	}else{
          	    $rechange_date = date("d M, Y", strtotime($data['rechargefinesdate']));
          	}
          		
            $row1['rechargefine_id'] = $data['rechargefineid'];
            $row1['staff_id'] = $data['staffid'];
            $row1['staff_name'] = $data['staffname'];
            $row1['rechargefine_type'] = $data['recharge_fine_type'];
            $row1['rechargefine_title'] = $data['title'];
            $row1['rechargefine_cdate'] = $data['rechargefinecdate'];
            $row1['rechargefine_start_date'] = $rechange_date;
            // $row1['rechargefine_end_date'] = $data['rechargefineedate'];
            $row1['rechargefine_desc'] = $data['rechargefinedesc'];
            $row1['rechargefine_price'] = $data['rechargefineprice'];
            $row1['rechargefine_status'] = $data['rechargefinestatus'];

			// 1-pay,2-paid,3-expried
           
            $row1['type'] = $data['rechargefinetype'];
          
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}

//staff rating count
else if(isset($_GET['get_staff_rating']))
{
  		$jsonObj4= array();


     	if(isset($_POST['staff_id']) && !empty($_POST['staff_id']) )
	{
	    	$last_month_ini = new DateTime("first day of last month");
			$last_month_end = new DateTime("last day of last month");

		 	$last_first_month = $last_month_ini->format('Y-m-d'); // 2012-02-01
		 	$last_end_month = $last_month_end->format('Y-m-d'); // 2012-02-29

		 	$this_month_ini = new DateTime("first day of this month");
			$this_month_end = new DateTime("last day of this month");

		 	$this_first_month = $this_month_ini->format('Y-m-d'); // 2012-02-01
		 	$this_end_month = $this_month_end->format('Y-m-d'); // 2012-02-29


	    	$qry = "SELECT *,city.ID as cityid,city.name as cityname,staff.ID as staffid,staff.name as staffname,staff.status as staffstatus FROM staff 
	    	left join city on city.ID = staff.city_id
	    	WHERE staff.ID='".$_POST['staff_id']."'"; 
			$result = mysqli_query($con,$qry);
			$row1 = mysqli_fetch_assoc($result);
			$fetch_email = mysqli_num_rows($result);
			
		    $query_order_last="SELECT  COUNT(*) as total_book, ROUND(avg(review.rate),2) as total_rate
    		FROM orders
    		left join review on review.order_id = orders.id
    		where orders.staff_id='".$_POST['staff_id']."' and orders.payment_type = 4 and review.rate > 0 and orders.order_date BETWEEN '".$last_first_month."' and '".$last_end_month."' ";

		   $result_order_last = mysqli_query($con,$query_order_last)or die(mysqli_error());

		   $row_order_last=mysqli_fetch_assoc($result_order_last);
		  
		       if($row_order_last['total_rate']== NULL )
    			{		             
    			    $last_total_rate = "0";
    			    $last_total_book = "0";
    		             
    			}else
    			{	
    			    
    			    $last_total_rate = $row_order_last['total_rate'];	
    			    $last_total_book = $row_order_last['total_book'];
    
    			}


    			 $query_order_this="SELECT  COUNT(*) as total_book, ROUND(avg(review.rate),2) as total_rate
    		FROM orders
    		left join review on review.order_id = orders.id
    		where orders.staff_id='".$_POST['staff_id']."' and orders.payment_type = 4 and review.rate > 0 and orders.order_date BETWEEN '".$this_first_month."' and '".$this_end_month."' ";

		   $result_order_this = mysqli_query($con,$query_order_this)or die(mysqli_error());

		   $row_order_this=mysqli_fetch_assoc($result_order_this);
		  
		       if($row_order_this['total_rate']== NULL )
    			{		             
    			    $this_total_rate = "0";
    			    $this_total_book = "0";
    		             
    			}else
    			{	
    			    
    			    $this_total_rate = $row_order_this['total_rate'];	
    			    $this_total_book = $row_order_this['total_book'];
    
    			}



		   
			
	 	 	if($fetch_email ==1)
			{
				

				$set['JSON_DATA'][]	= array(
							            'msg'	=>	'Successfully',
							            'success'=>'1',
										'last_total_rate' => $last_total_rate,
										'last_total_job' => $last_total_book,
										'this_total_rate' => $this_total_rate,
										'this_total_job' => $this_total_book,
								);
			}else{
				$set['JSON_DATA'][]=array('msg' => "Client account disable...!",'success'=>'0');
	    	}
	}else{
			$set['JSON_DATA'][]=array('msg' => "Something want wrong",'success'=>'0');
	        
	}  


		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}





//get all staff city wise for user app
else if(isset($_GET['get_staff_city']))
{
  		$jsonObj4= array();


        
       	$query="SELECT *,city.ID as cityid,city.name as cityname,staff.ID as staffid,staff.name as staffname,staff.status as staffstatus,staff.dp as dp FROM staff 
	    	left join city on city.ID = staff.city_id
	    	WHERE staff.city_id='".$_POST['city_id']."' ORDER BY staff.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `staff`(`ID`, `status`, `name`, `email`, `mobile`, `password`, `city_id`, `dp`, `bb_id_card`, `adhar_card`, `pan_card`, `bank_details`, `sessionid`, `ip`, `token`)
          	
                	 $query_order="SELECT  COUNT(*) as total_book, ROUND(avg(review.rate),2) as total_rate
    		FROM orders
    		left join review on review.order_id = orders.id
    		where orders.staff_id='".$data['staffid']."' and orders.payment_type = 4 and review.rate > 0 ";

		   $result_order = mysqli_query($con,$query_order)or die(mysqli_error());

		   $row_order=mysqli_fetch_assoc($result_order);
		  
		       if($row_order['total_rate']== NULL )
    			{		             
    			    $total_rate = "0";
    			    $total_book = "0";
    		             
    			}else
    			{	
    			    
    			    $total_rate = $row_order['total_rate'];	
    			    $total_book = $row_order['total_book']	;
    
    			}
                
				if(!empty($data['dp'])){
					$imageurl = UPLOAD_PATH.'staff/'.$data['dp'];
				}else{
					$imageurl ="";
				}


					if(!empty($data['bb_id_card1'])){
						$bb_id_card1 = UPLOAD_PATH.'staff/'.$data['bb_id_card1'];
					}else{
						$bb_id_card1 ="";
					}

					if(!empty($data['bb_id_card2'])){
						$bb_id_card2 = UPLOAD_PATH.'staff/'.$data['bb_id_card2'];
					}else{
						$bb_id_card2 ="";
					}
					

					if(!empty($data['adhar_card1'])){
						$adhar_card1 = UPLOAD_PATH.'staff/'.$data['adhar_card1'];
					}else{
						$adhar_card1 ="";
					}

					if(!empty($data['adhar_card2'])){
						$adhar_card2 = UPLOAD_PATH.'staff/'.$data['adhar_card2'];
					}else{
						$adhar_card2 ="";
					}

					if(!empty($data['pan_card1'])){
						$pan_card1 = UPLOAD_PATH.'staff/'.$data['pan_card1'];
					}else{
						$pan_card1 ="";
					}

					if(!empty($data['pan_card2'])){
						$pan_card2 = UPLOAD_PATH.'staff/'.$data['pan_card2'];
					}else{
						$pan_card2 ="";
					}

					if(!empty($data['bank_details1'])){
						$bank_details1 = UPLOAD_PATH.'staff/'.$data['bank_details1'];
					}else{
						$bank_details1 ="";
					}

					if(!empty($data['bank_details2'])){
						$bank_details2 = UPLOAD_PATH.'staff/'.$data['bank_details2'];
					}else{
						$bank_details2 ="";
					}

            $row1['total_rating'] = $total_rate;
            $row1['staff_id'] = $data['staffid'];
            $row1['staff_name'] = $data['staffname'];
            $row1['staff_email'] = $data['email'];
            $row1['staff_image'] = $imageurl;
            $row1['staff_pass'] = $data['password'];
            $row1['city_id'] = $data['cityid'];
            $row1['city_name'] = $data['cityname'];
            $row1['staff_phone'] = $data['mobile'];
            $row1['bb_id_card1'] = $bb_id_card1;
            $row1['bb_id_card2'] = $bb_id_card2;
            $row1['adhar_card1'] = $adhar_card1;
            $row1['adhar_card2'] = $adhar_card2;
            $row1['pan_card1'] = $pan_card1;
            $row1['pan_card2'] = $pan_card2;
            $row1['bank_details1'] = $bank_details1;
            $row1['bank_details2'] = $bank_details2;
            
            $row1['staff_token'] = $data['token'];
            $row1['staff_status'] = $data['staffstatus'];

			
 	
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}


//verify otp for staff
else if(isset($_GET['order_verify_otp']))
{
       
	    $qry = "SELECT * FROM orders WHERE orders.staff_id ='".$_POST['staff_id']."' AND  orders.id = '".$_POST['order_id']."' AND orders.order_otp='".$_POST['order_otp']."' "; 
	    $result = mysqli_query($con,$qry);
	    $row = mysqli_fetch_assoc($result);
	    
	    $num_rows = mysqli_num_rows($result);
    	
	    if ($num_rows > 0)
	    {
			
				$set['JSON_DATA'][]=array('msg' => "Order confirmation otp verification updated successfully...!",
				'success' 	=>	"1"
				);
				    	
	    }else{	
	    
	    		
	        $set['JSON_DATA'][]=array('msg' => "Your otp is not valid.please enter valid otp.",'success'=>'0');
	    		
	    }

    
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


// Normal Registration
else if(isset($_GET['staff_verification_image_upload']))
{
    	
    	if(isset($_POST['order_id']) ){

    		$sql = "SELECT * FROM orders where id = '".$_POST['order_id']."' and staff_id='".$_POST['staff_id']."' ";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_assoc($res);
			
			$num_rows2 = mysqli_num_rows($res);
	    		
	        if ($num_rows2 > 0 )
	        {	

				// 	$ext="";
				// 	if((!empty($_FILES["partner_pic"])) && ($_FILES['partner_pic']['error'] == 0)){
				// 	  $filename    = strtolower(basename($_FILES['partner_pic']['name']));
				// 	  $ext         = substr($filename, strrpos($filename, '.') + 1);
				// 	  $namefile    = str_replace(".$ext","", $filename);
				// 	  $newfilename = "orders-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext=".".$ext;
				// 	  $newname = '../uploads/orders/'.$newfilename.$ext;
				// 	  move_uploaded_file($_FILES['partner_pic']['tmp_name'],$newname);  
				// 	} 

				// 	if($ext!=""){$pic="$newfilename$ext";

				// 		$user_image_edit= "UPDATE orders SET `partner_pic`='$pic' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res1 = mysqli_query($con,$user_image_edit);	
		   				
		   				
				// 	}

					

				// 	$ext1="";
				// 	if((!empty($_FILES["setup_pic"])) && ($_FILES['setup_pic']['error'] == 0)){
				// 	  $filename1    = strtolower(basename($_FILES['setup_pic']['name']));
				// 	  $ext1         = substr($filename1, strrpos($filename1, '.') + 1);
				// 	  $namefile1    = str_replace(".$ext1","", $filename1);
				// 	  $newfilename1 = "orders-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext1=".".$ext1;
				// 	  $newname1 = '../uploads/orders/'.$newfilename1.$ext1;
				// 	  move_uploaded_file($_FILES['setup_pic']['tmp_name'],$newname1);  
				// 	} 

				// 	if($ext1!=""){$pic1="$newfilename1$ext1";

				// 		$user_image_edit2= "UPDATE orders SET `setup_pic`='$pic1' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res2 = mysqli_query($con,$user_image_edit2);	
		   				
		   				
				// 	}


				// 	$ext2="";
				// 	if((!empty($_FILES["product_pic"])) && ($_FILES['product_pic']['error'] == 0)){
				// 	  $filename2    = strtolower(basename($_FILES['product_pic']['name']));
				// 	  $ext2         = substr($filename2, strrpos($filename2, '.') + 1);
				// 	  $namefile2    = str_replace(".$ext2","", $filename2);
				// 	  $newfilename2 = "orders-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext2=".".$ext2;
				// 	  $newname2 = '../uploads/orders/'.$newfilename2.$ext2;
				// 	  move_uploaded_file($_FILES['product_pic']['tmp_name'],$newname2);  
				// 	} 

				// 	if($ext2!=""){$pic2="$newfilename2$ext2";

				// 		$user_image_edit1= "UPDATE orders SET `product_pic`='$pic2' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res3 = mysqli_query($con,$user_image_edit1);	
		   				
		   				
				// 	}
				
				if($_FILES['partner_pic']['name']!="")
                {
                    $filename = rand(0,99999)."_". $_FILES["partner_pic"]["name"]; 
                    $tempname = $_FILES["partner_pic"]["tmp_name"];     
                    $folder = "../uploads/orders/".$filename; 
                    move_uploaded_file($tempname, $folder);
                }else{
                    $filename = "";
                }
                
                if($_FILES['setup_pic']['name']!="")
                {
                    $filename2 = rand(0,99999)."_". $_FILES["setup_pic"]["name"]; 
                    $tempname2 = $_FILES["setup_pic"]["tmp_name"];     
                    $folder2 = "../uploads/orders/".$filename2; 
                    move_uploaded_file($tempname2, $folder2);
                }else{
                    $filename2 = "";
                }
                
                if($_FILES['product_pic']['name']!="")
                {
                    $filename3 = rand(0,99999)."_". $_FILES["product_pic"]["name"]; 
                    $tempname3 = $_FILES["product_pic"]["tmp_name"];     
                    $folder3 = "../uploads/orders/".$filename3; 
                    move_uploaded_file($tempname3, $folder3);
                }else{
                    $filename3 = "";
                }
				
                    
                    
                    //'e_image'  =>  $filename,
                    
						 $user_image_edit1= "UPDATE orders SET `product_pic`='$filename3',`setup_pic`='$filename2',`partner_pic`='$filename' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
		   				$user_res3 = mysqli_query($con,$user_image_edit1);	
		   				
		   				if($user_res3 == true)
		   				{
		   				    $user_image_edit_status= "UPDATE orders SET `payment_type`='6' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
    		   				$user_res_status = mysqli_query($con,$user_image_edit_status);
    		   				
    						$set['JSON_DATA'][]	= array(  
    					            'msg'	=>	'Successfully image uploaded.',
    					            'success'=>'1',
    					       
    							);
		   				}
                       
                       
		        }else{
		        	$set['JSON_DATA'][]=array('msg' => "Somethigns Want wrong2.",'success'=>'0');
		        }    
		    	
		}else{
				$set['JSON_DATA'][]=array('msg' => "All fields are required3.",'success'=>'0');
		        
		}  
		
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//satff update profile
//satff update profile
else if(isset($_GET['staff_update_profile']))
{
		if(isset($_POST['staff_id']) && !empty($_POST['staff_id'])  )
		{
		
			$sql = "SELECT * FROM staff where ID = '".$_POST['staff_id']."' ";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_assoc($res);
			
			$num_rows2 = mysqli_num_rows($res);
	    		
	        if ($num_rows2 > 0 )
	        {	
	
                        
                         
                $user_edit= "UPDATE staff SET address='".$_POST['address']."',name='".$_POST['staff_name']."', email='".$_POST['staff_email']."', mobile='".$_POST['staff_mobile']."',holder_name='".$_POST['holder_name']."',account_number='".$_POST['account_number']."',ifsc_code='".$_POST['ifsc_code']."' WHERE ID = '".$_POST['staff_id']."'";	 
		   		
		   		$user_res = mysqli_query($con,$user_edit);
                            
                        
					
		   			//INSERT INTO `staff`(`ID`, `status`, `name`, `email`, `mobile`, `password`, `city_id`, `dp`, `bb_id_card1`, `bb_id_card2`, `adhar_card1`, `adhar_card2`, `pan_card1`, `pan_card2`, `bank_details1`, `bank_details2`, `sessionid`, `ip`, `token`) 
		   			

				// 	$ext="";
				// 	if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
				// 	  $filename    = strtolower(basename($_FILES['dp']['name']));
				// 	  $ext         = substr($filename, strrpos($filename, '.') + 1);
				// 	  $namefile    = str_replace(".$ext","", $filename);
				// 	  $newfilename = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext=".".$ext;
				// 	  $newname = '../uploads/staff/'.$newfilename.$ext;
				// 	  move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
				// 	} 

				// 	if($ext!=""){$pic="$newfilename$ext";

				// 	 $user_image_edit= "UPDATE staff SET `dp`='$pic' WHERE ID='".$_POST['staff_id']."'";	 
		   			
		  // 			$user_res = mysqli_query($con,$user_image_edit);	
				// 	}



				// 	$ext11="";
				// 	if((!empty($_FILES["bb_id_card1"])) && ($_FILES['bb_id_card1']['error'] == 0)){
				// 	  $filename11    = strtolower(basename($_FILES['bb_id_card1']['name']));
				// 	  $ext11         = substr($filename11, strrpos($filename11, '.') + 1);
				// 	  $namefile11    = str_replace(".$ext11","", $filename11);
				// 	  $newfilename11 = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext11=".".$ext11;
				// 	  $newname11 = '../uploads/staff/'.$newfilename11.$ext11;
				// 	  move_uploaded_file($_FILES['bb_id_card1']['tmp_name'],$newname11);  
				// 	} 

				// 	if($ext11!=""){$pic11="$newfilename11$ext11";

				// 		 $user_image_edit1= "UPDATE staff SET `bb_id_card1`='$pic11' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit1);	
				// 	}

					

				// 	$ext1="";
				// 	if((!empty($_FILES["bb_id_card2"])) && ($_FILES['bb_id_card2']['error'] == 0)){
				// 	  $filename1    = strtolower(basename($_FILES['bb_id_card2']['name']));
				// 	  $ext1         = substr($filename1, strrpos($filename1, '.') + 1);
				// 	  $namefile1    = str_replace(".$ext1","", $filename1);
				// 	  $newfilename1 = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext1=".".$ext1;
				// 	  $newname1 = '../uploads/staff/'.$newfilename1.$ext1;
				// 	  move_uploaded_file($_FILES['bb_id_card2']['tmp_name'],$newname1);  
				// 	} 

				// 	if($ext1!=""){$pic1="$newfilename1$ext1";

				// 		$user_image_edit2= "UPDATE staff SET `bb_id_card2`='$pic1' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit2);	
				// 	}


				// 	$ext2="";
				// 	if((!empty($_FILES["adhar_card1"])) && ($_FILES['adhar_card1']['error'] == 0)){
				// 	  $filename2    = strtolower(basename($_FILES['adhar_card1']['name']));
				// 	  $ext2         = substr($filename2, strrpos($filename2, '.') + 1);
				// 	  $newfilename2    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext2=".".$ext2;
				// 	  $newname2 = '../uploads/staff/'.$newfilename2.$ext2;
				// 	  move_uploaded_file($_FILES['adhar_card1']['tmp_name'],$newname2);  
				// 	} 

				// 	if($ext2!=""){$pic2="$newfilename2$ext2";

				// 		$user_image_edit3= "UPDATE staff SET `adhar_card1`='$pic2' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit3);	
				// 	}


				// 	$ext3="";
				// 	if((!empty($_FILES["adhar_card2"])) && ($_FILES['adhar_card2']['error'] == 0)){
				// 	  $filename3    = strtolower(basename($_FILES['adhar_card2']['name']));
				// 	  $ext3         = substr($filename3, strrpos($filename3, '.') + 1);
				// 	  $newfilename3    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext3=".".$ext3;
				// 	  $newname3 = '../uploads/staff/'.$newfilename3.$ext3;
				// 	  move_uploaded_file($_FILES['adhar_card2']['tmp_name'],$newname3);  
				// 	} 

				// 	if($ext3!=""){$pic3="$newfilename3$ext3";

				// 		$user_image_edit4= "UPDATE staff SET `adhar_card2`='$pic3' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit4);	
				// 	}


				// 	$ext4="";
				// 	if((!empty($_FILES["pan_card1"])) && ($_FILES['pan_card1']['error'] == 0)){
				// 	  $filename4    = strtolower(basename($_FILES['pan_card1']['name']));
				// 	  $ext4         = substr($filename4, strrpos($filename4, '.') + 1);
				// 	  $newfilename4    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext4=".".$ext4;
				// 	  $newname4 = '../uploads/staff/'.$newfilename4.$ext4;
				// 	  move_uploaded_file($_FILES['pan_card1']['tmp_name'],$newname4);  
				// 	} 

				// 	if($ext4!=""){$pic4="$newfilename4$ext4";

				// 		$user_image_edit4= "UPDATE staff SET `pan_card1`='$pic4' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit4);	
				// 	}


				// 	$ext5="";
				// 	if((!empty($_FILES["pan_card2"])) && ($_FILES['pan_card2']['error'] == 0)){
				// 	  $filename5    = strtolower(basename($_FILES['pan_card2']['name']));
				// 	  $ext5         = substr($filename5, strrpos($filename5, '.') + 1);
				// 	  $newfilename5    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext5=".".$ext5;
				// 	  $newname5 = '../uploads/staff/'.$newfilename5.$ext5;
				// 	  move_uploaded_file($_FILES['pan_card2']['tmp_name'],$newname5);  
				// 	} 

				// 	if($ext5!=""){$pic5="$newfilename5$ext5";

				// 		$user_image_edit5= "UPDATE staff SET `pan_card2`='$pic5' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit5);	
				// 	}

				// 	$ext6="";
				// 	if((!empty($_FILES["bank_details1"])) && ($_FILES['bank_details1']['error'] == 0)){
				// 	  $filename6    = strtolower(basename($_FILES['bank_details1']['name']));
				// 	  $ext6         = substr($filename6, strrpos($filename6, '.') + 1);
				// 	  $newfilename6    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext6=".".$ext6;
				// 	  $newname6 = '../uploads/staff/'.$newfilename6.$ext6;
				// 	  move_uploaded_file($_FILES['bank_details1']['tmp_name'],$newname6);  
				// 	} 

				// 	if($ext6!=""){$pic6="$newfilename6$ext6";

				// 		$user_image_edit6= "UPDATE staff SET `bank_details1`='$pic6' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit6);	
				// 	}


				// 	$ext7="";
				// 	if((!empty($_FILES["bank_details2"])) && ($_FILES['bank_details2']['error'] == 0)){
				// 	  $filename7    = strtolower(basename($_FILES['bank_details2']['name']));
				// 	  $ext7         = substr($filename7, strrpos($filename7, '.') + 1);
				// 	  $newfilename7    = "staff-".date("ymdHis");
				// 	  //Determine the path to which we want to save this file
				// 	  $ext7=".".$ext7;
				// 	  $newname7 = '../uploads/staff/'.$newfilename7.$ext7;
				// 	  move_uploaded_file($_FILES['bank_details2']['tmp_name'],$newname7);  
				// 	} 

				// 	if($ext7!=""){$pic7="$newfilename7$ext7";

				// 		$user_image_edit7= "UPDATE staff SET `bank_details2`='$pic7' WHERE ID = '".$_POST['staff_id']."' ";	 
		   			
		  // 				$user_res = mysqli_query($con,$user_image_edit7);	
				// 	}
				
				
				$qry="SELECT * FROM `staff` where ID= '".$_POST['staff_id']."' ";
        $result=mysqli_query($con,$qry);
        $row1=mysqli_fetch_assoc($result);
        $num_rows = mysqli_num_rows($result);
          
          

	    if($_FILES['dp']['name']!="")
        {
            $filename = rand(0,99999)."_". $_FILES["dp"]["name"]; 
            $tempname = $_FILES["dp"]["tmp_name"];     
            $folder = "../uploads/staff/".$filename; 
            move_uploaded_file($tempname, $folder);
        }else{
            $filename = $row1['dp'];
        }
        
        if($_FILES['bb_id_card1']['name']!="")
        {
            $filename2 = rand(0,99999)."_". $_FILES["bb_id_card1"]["name"]; 
            $tempname2 = $_FILES["bb_id_card1"]["tmp_name"];     
            $folder2 = "../uploads/staff/".$filename2; 
            
            move_uploaded_file($tempname2, $folder2);
        }else{
            $filename2 = $row1['bb_id_card1'];
        }
        
        if($_FILES['bb_id_card2']['name']!="")
        {
            $filename3 = rand(0,99999)."_". $_FILES["bb_id_card2"]["name"]; 
            $tempname3 = $_FILES["bb_id_card2"]["tmp_name"];     
            $folder3 = "../uploads/staff/".$filename3; 
            move_uploaded_file($tempname3, $folder3);
        }else{
            $filename3 = $row1['bb_id_card2'];
        }
        
        if($_FILES['adhar_card1']['name']!="")
        {
            $filename4 = rand(0,99999)."_". $_FILES["adhar_card1"]["name"]; 
            $tempname4 = $_FILES["adhar_card1"]["tmp_name"];     
            $folder4 = "../uploads/staff/".$filename4; 
            move_uploaded_file($tempname4, $folder4);
        }else{
            $filename4 = $row1['adhar_card1'];
        }
        
        if($_FILES['adhar_card2']['name']!="")
        {
            $filename5 = rand(0,99999)."_". $_FILES["adhar_card2"]["name"]; 
            $tempname5 = $_FILES["adhar_card2"]["tmp_name"];     
            $folder5 = "../uploads/staff/".$filename5; 
            move_uploaded_file($tempname5, $folder5);
        }else{
            $filename5 =  $row1['adhar_card2'];
        }
        
        if($_FILES['pan_card1']['name']!="")
        {
            $filename6 = rand(0,99999)."_". $_FILES["pan_card1"]["name"]; 
            $tempname6 = $_FILES["pan_card1"]["tmp_name"];     
            $folder6 = "../uploads/staff/".$filename6; 
            move_uploaded_file($tempname6, $folder6);
        }else{
            $filename6 = $row1['pan_card1'];
        }

    
  
     $sql="UPDATE `staff` SET dp='$filename',`bb_id_card1`='$filename2',`bb_id_card2`='$filename3',`adhar_card1`='$filename4',`adhar_card2`='$filename5',`pan_card1`='$filename6'
    WHERE ID ='".$_POST['staff_id']."'";
     $user_res = mysqli_query($con,$sql);	   


				 
                    $qrys = "SELECT * FROM staff WHERE ID = '".$_POST['staff_id']."'"; 
        			$results = mysqli_query($con,$qrys);
        			$row1 = mysqli_fetch_assoc($results);
			
        			if($row1['dp'] != "")
				    {
				        $image = UPLOAD_PATH.'staff/'.$row1['dp'];
				    }else
				    {
				        $image = ""; 
				        
				    }
					    

					if(!empty($row1['bb_id_card1'])){
						$bb_id_card1 = UPLOAD_PATH.'staff/'.$row1['bb_id_card1'];
					}else{
						$bb_id_card1 ="";
					}

					if(!empty($row1['bb_id_card2'])){
						$bb_id_card2 = UPLOAD_PATH.'staff/'.$row1['bb_id_card2'];
					}else{
						$bb_id_card2 ="";
					}
					

					if(!empty($row1['adhar_card1'])){
						$adhar_card1 = UPLOAD_PATH.'staff/'.$row1['adhar_card1'];
					}else{
						$adhar_card1 ="";
					}

					if(!empty($row1['adhar_card2'])){
						$adhar_card2 = UPLOAD_PATH.'staff/'.$row1['adhar_card2'];
					}else{
						$adhar_card2 ="";
					}

					if(!empty($row1['pan_card1'])){
						$pan_card1 = UPLOAD_PATH.'staff/'.$row1['pan_card1'];
					}else{
						$pan_card1 ="";
					}

					if(!empty($row1['pan_card2'])){
						$pan_card2 = UPLOAD_PATH.'staff/'.$row1['pan_card2'];
					}else{
						$pan_card2 ="";
					}

					if(!empty($row1['bank_details1'])){
						$bank_details1 = UPLOAD_PATH.'staff/'.$row1['bank_details1'];
					}else{
						$bank_details1 ="";
					}

					if(!empty($row1['bank_details2'])){
						$bank_details2 = UPLOAD_PATH.'staff/'.$row1['bank_details2'];
					}else{
						$bank_details2 ="";
					}

					    
   					if($results==true)
   					{

			    		$set['JSON_DATA'][]	= array(  
			            'msg'	=>	'Your profile is updated successfully.',
			            'success'=>'1',
			            'staff_id'	=>	$row1['ID'],
						'staff_name' =>	$row1['name'],
						'staff_email'	=>	$row1['email'],
						'address'	=>	$row1['address'],
						'staff_image'	=> $image,
						'staff_pass'	=>	$row1['password'],
						'city_id'	=>	$row1['city_id'],
						'staff_phone'	=>	$row1['mobile'],
						'bb_id_card1'	=> $bb_id_card1,
						'bb_id_card2'	=> $bb_id_card2,
						'adhar_card1'	=> $adhar_card1,
						'adhar_card2'	=> $adhar_card2,
						'pan_card1'	=> $pan_card1,
						'pan_card2'	=> $pan_card2,
						'bank_details1'	=> $bank_details1,
						'bank_details2'	=> $bank_details2,
						'staff_token'	=>	$row1['token'],
						'staff_status'	=>	$row1['status'],
						);
     								
     								
   					}else{
        	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
        	        }
					
			
	        }else{
	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
	        }
			
		}else{
				$set['JSON_DATA'][]=array('msg' => "Username,email,password,mobile no fields are require ",'success'=>'0');
		}
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//staff cancel leaves
else if(isset($_GET['staff_cancel_leave']))
{


	$qry = "SELECT * FROM `staff_leaves` sl
	WHERE sl.ID='".$_POST['leaves_id']."' and sl.staff_id='".$_POST['staff_id']."' ";

	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row1 = mysqli_fetch_assoc($result);
		
         if ($num_rows > 0)
		{
		    
		    
	       $user_edit= "UPDATE staff_leaves as sl SET leave_status='4' , cancel_reason = '".$_POST['cancel_reason']."' 

	        WHERE sl.ID='".$_POST['leaves_id']."' and sl.staff_id='".$_POST['staff_id']."'  ";	 
	         $result = mysqli_query($con,$user_edit);
	         
		    
    	 
			$set['JSON_DATA'][]=array('msg'=>'Successfully Updated','success'=>'1');
		}
		else
		{
			$set['JSON_DATA'][]=array('msg'=>'Updated Fail','success'=>'0');	 
				
		}
			
		 	header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	
}



//staff add service to customer
else if(isset($_GET['staff_add_services']))
{


	$qry = "SELECT * FROM `orders` ord
	left join orders_detail on orders_detail.order_id = ord.id 
	WHERE ord.id='".$_POST['order_id']."' and ord.staff_id='".$_POST['staff_id']."' ";

	$result = mysqli_query($con,$qry);
	$num_rows = mysqli_num_rows($result);
	$row1 = mysqli_fetch_assoc($result);
		
        if ($num_rows > 0)
		{
		   
	   		


			   		$total = 0;
			    	$update_service_amount = 0;
			      	
			         
	            	$service_detail = $_POST['service_detail'];
            			$someArray = json_decode($service_detail, true);
				        for ($x = 0; $x <= count($someArray)-1 ; $x++) {
				      	
			         
			                $category_id = $someArray[$x]["category_id"];
			                $subcategory_id = $someArray[$x]["subcategory_id"];
			                $subsubcategory_id = $someArray[$x]["subsubcategory_id"];
			                $service_id = $someArray[$x]["service_id"];
			                $qty = $someArray[$x]["qty"];
			                $ori_price = $someArray[$x]["ori_price"];
			                $dis_price = $someArray[$x]["dis_price"];


			                $qrys_order_details = "SELECT * FROM orders_detail WHERE category_id='".$category_id."' and subcategory_id = '".$subcategory_id."' and subsubcategory_id = '".$subsubcategory_id."'  and service_id = '".$service_id."' and order_id='".$_POST['order_id']."' "; 		
							 //exit;   	  	
							$results_order_details = mysqli_query($con,$qrys_order_details);
							$num_rows_order_details = mysqli_num_rows($results_order_details);
							$row2_order_deyails = mysqli_fetch_assoc($results_order_details);

			                if($num_rows_order_details > 0 ){

			                	$total_qty = $row2_order_deyails['qty'] + $qty;

			                /*	$user_image_edit= "UPDATE orders_detail SET `qty`='".$total_qty."' WHERE category_id='".$category_id."' and subcategory_id = '".$subcategory_id."' and subsubcategory_id = '".$subsubcategory_id."'  and service_id = '".$service_id."' ";	*/ 
			                
			                	$user_image_edit= "UPDATE orders_detail SET `qty`='".$total_qty."'  WHERE type = '2' and service_id ='".$service_id."' and order_id='".$_POST['order_id']."' ";	

								$user_res1 = mysqli_query($con,$user_image_edit);	

			                }else{

			                 $user_insert= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) 
					 				VALUES(2,'".$_POST['order_id']."','".$category_id."','".$subcategory_id."','".$subsubcategory_id."','".$service_id."','".$qty."','".$ori_price."','".$dis_price."')"; 
						
                            
		   	  				$user_res = mysqli_query($con,$user_insert);	

			                }

							

		   	  				$totals =  $qty * $dis_price;
                            $total += $totals;


                            $update_service_amount =  $qty * $total;

                            
		   	  				
			        }
			  
                        // $row1['service_price'];
                       
			   	  		$service_amount1 = $total + $row1['service_price'];
			   	  		$service_amount2 = $update_service_amount + $row1['final_price'];

						$user_image_edit= "UPDATE orders SET `service_price`='".$service_amount1."' , `final_price`='".$service_amount2."' WHERE id='".$_POST['order_id']."' and staff_id = '".$_POST['staff_id']."' ";	 

						$user_res1 = mysqli_query($con,$user_image_edit);	

						$set['JSON_DATA'][]=array('msg'=>'Successfully Updated','success'=>'1');
			   

			
		}
		else
		{
			$set['JSON_DATA'][]=array('msg'=>'Updated Fail','success'=>'0');	 
				
		}
			
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	
}










// stock related api
//get all product
else if(isset($_GET['get_product_pagination']))
{


		$jsonObj1= array();
		
		$tableName="product";
	    $limit = 10;	
        
		$query="SELECT COUNT(*) as num FROM $tableName
		ORDER BY product.product_id DESC";
		

		$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
		$total_pages = $total_pages['num'];

		$stages = 3;
		$page=0;
		if(isset($_POST['page'])){
		$page = mysqli_real_escape_string($con,$_POST['page']);
		}
		if($page){
		$start = ($page - 1) * $limit; 
		}else{
		$start = 0; 
		}


		$query="SELECT * FROM `product`
	    ORDER BY product.product_id DESC LIMIT $start, $limit";
		
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
			$jsonObj3 = array();   

			
		    $row1['product_id'] = $data['product_id'];

			$row1['product_name'] = $data['product_name'];
			$row1['product_description'] = $data['product_description'];
            
            $row1['cdate'] = $data['cdate'];
			
			if(!empty($data['product_image'])){
          	    $product_image = UPLOAD_PATH.'products/'.$data['product_image'];
          	}else{
          	    $product_image='';
          	}
			$row1['product_image'] = $product_image;

			
 			$row1['product_status'] = $data['product_status'];
 			
 			
 			
 		  
 			
			array_push($jsonObj1,$row1);

		
		}

		$count_pages =ceil($total_pages/$limit);
	    
	    if($count_pages <= 0)
	    {
	        $count_pages1 =  1;
	    }else {
	        $count_pages1 =  ceil($total_pages/$limit);
	    }
		
		// $set['JSON_DATA'] = $jsonObj1;	

		$set['page'] = $_POST['page'];
		$set['totalimage'] = $count_pages1;
		$set['limit'] = $limit;
		$set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj1;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


else if(isset($_GET['get_product']))
{


		$jsonObj1= array();
		
		
		$query="SELECT * FROM `product`
	    ORDER BY product.product_id DESC ";
		
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
			$jsonObj3 = array();   

			
		    $row1['product_id'] = $data['product_id'];

			$row1['product_name'] = $data['product_name'];
			$row1['product_description'] = $data['product_description'];
			
			if($data['cdate'] == "")
          	{
          	    $product_date = "";
          	}else{
          	    $product_date = date("d M, Y", strtotime($data['cdate']));
          	}
            
            $row1['cdate'] = $product_date;
			
			if(!empty($data['product_image'])){
          	    $product_image = UPLOAD_PATH.'products/'.$data['product_image'];
          	}else{
          	    $product_image='';
          	}
			$row1['product_image'] = $product_image;

			
 			$row1['product_status'] = $data['product_status'];
 			
 			
 			
 		  
 			
			array_push($jsonObj1,$row1);

		
		}

		
		
		$set['JSON_DATA'] = $jsonObj1;	

		
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

// staff request send for product details
else if(isset($_GET['add_product_stock_requset_staff']))
{

	
 		    
  	if($_POST['staff_id']!="" AND $_POST['product_detail'] )
	{

		date_default_timezone_set("Asia/Calcutta"); 
		$request_date = date('Y-m-d H:i:s');
		$request_date1 = date('Y-m-d');


        

		$qry1_add_detail="INSERT INTO `product_request`( `request_staff_id`, `product_request_address`, `product_request_type`, `product_request_date`, `product_request_status`)
		VALUES (
			'".trim($_POST['staff_id'])."',
			'".$_POST['address']."',
		   	1,
			
		    '".$request_date1."',
		   	1
		)";

		$result_detail = mysqli_query($con,$qry1_add_detail);
		$last_id = mysqli_insert_id($con);

		$product_request_id = $last_id;

		$service_detail = $_POST['product_detail'];
            			$someArray = json_decode($service_detail, true);
				        for ($x = 0; $x <= count($someArray)-1 ; $x++) {
				      	
				            	
				            	
				            					                
				                $product_id = $someArray[$x]["product_id"];
				                $request_staff_quantity = $someArray[$x]["request_staff_quantity"];

				                // SELECT `request_variation_id`, `product_request_id`, `staff_id`, `product_id`, `request_staff_quantity`, `request_variation_date`, `request_variation_status` FROM `product_request_variation` WHERE 1

								$qry1_book_variation="INSERT INTO `product_request_variation`(`product_request_id`, `staff_id`, `product_id`, `request_staff_quantity`, `request_variation_date`, `request_variation_status`) 
								VALUES (
								'".$product_request_id."',
								'".$_POST['staff_id']."',
								'".$product_id."',
								'".$request_staff_quantity."',
								'".$request_date1."',
								'1'
								)"; 

								
								$result11_book_variation=mysqli_query($con,$qry1_book_variation);


				        }
	   	
        
        
         
        
        				

	
								 
		$set['JSON_DATA'][]	=	array(    
                      'msg' 	=>	"Your Product Stock Request has been submitted. Wait 24-48 Hours.",
                      'success'=>'1',     
 		);

	}else
	{
		$set['JSON_DATA'][]=array('msg' => "SomeThigns Want to wrong",'success'=>'0');
	}
			
					
				
        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}



//get all product staff request
else if(isset($_GET['get_order_staff_request']))
{


		$jsonObj1= array();
		
		$tableName="product_request";
	    $limit = 10;	
        
		$query="SELECT COUNT(*) as num FROM $tableName
		LEFT JOIN staff on staff.ID=product_request.request_staff_id
		where product_request.request_staff_id = '".$_POST['staff_id']."'
		ORDER BY product_request.product_request_id DESC";
		

		$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
		$total_pages = $total_pages['num'];

		$stages = 3;
		$page=0;
		if(isset($_POST['page'])){
		$page = mysqli_real_escape_string($con,$_POST['page']);
		}
		if($page){
		$start = ($page - 1) * $limit; 
		}else{
		$start = 0; 
		}


		$query="SELECT * FROM `product_request`
		LEFT JOIN staff on staff.ID=product_request.request_staff_id
		where product_request.request_staff_id = '".$_POST['staff_id']."'
	    ORDER BY product_request.product_request_id DESC LIMIT $start, $limit";
		
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
			$jsonObj3 = array();   

			$query1="SELECT * FROM product_request_variation
			LEFT JOIN product on product.product_id=product_request_variation.product_id
			where product_request_variation.product_request_id='".$data['product_request_id']."' ";

			$result2 = mysqli_query($con,$query1)or die(mysqli_error());

			while($data1 = mysqli_fetch_assoc($result2))
			{	

				$row2['request_variation_id'] = $data1['request_variation_id'];
				$row2['product_request_id'] = $data1['product_request_id'];
				$row2['staff_id'] = $data1['staff_id'];
				$row2['product_id'] = $data1['product_id'];
				$row2['product_name'] = $data1['product_name'];
				$row2['product_description'] = $data1['product_description'];

				if(!empty($data1['product_image'])){
	          	    $product_image = UPLOAD_PATH.'products/'.$data1['product_image'];
	          	}else{
	          	    $product_image='';
	          	}
				$row2['product_image'] = $product_image;


				$row2['request_staff_quantity'] = $data1['request_staff_quantity'];
				
				if($data1['request_variation_date'] == "")
              	{
              	    $request_date = "";
              	}else{
              	    $request_date = date("d M, Y", strtotime($data1['request_variation_date']));
              	}
          	
				$row2['request_variation_date'] = $request_date;
					
				$row2['request_variation_status'] = $data1['request_variation_status'];

				array_push($jsonObj3, $row2);   

			}
			
			
		    $row1['product_request_id'] = $data['product_request_id'];
			$row1['staff_id'] = $data['request_staff_id'];

			$row1['staff_name'] = $data['name'];
			$row1['email'] = $data['email'];
			$row1['mobile'] = $data['mobile'];


			$row1['request_staff_id'] = $data['request_staff_id'];
			$row1['request_staff_id'] = $data['request_staff_id'];


			$row1['product_request_address'] = $data['product_request_address'];
			$row1['product_request_type'] = $data['product_request_type'];
			
			if($data['product_request_date'] == "")
          	{
          	    $product_date = "";
          	}else{
          	    $product_date = date("d M, Y", strtotime($data['product_request_date']));
          	}
          	
			$row1['product_request_date'] = $product_date;
			$row1['product_request_status'] = $data['product_request_status'];
            
 			$row1['product_variant'] = $jsonObj3;
 			
 		  
 			
			array_push($jsonObj1,$row1);

		
		}

		$count_pages =ceil($total_pages/$limit);
	    
	    if($count_pages <= 0)
	    {
	        $count_pages1 =  1;
	    }else {
	        $count_pages1 =  ceil($total_pages/$limit);
	    }
		
		// $set['JSON_DATA'] = $jsonObj1;	

		$set['page'] = $_POST['page'];
		$set['totalimage'] = $count_pages1;
		$set['limit'] = $limit;
		$set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj1;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all staff inventory
else if(isset($_GET['get_order_staff_inventory']))
{


		$jsonObj1= array();
		
		$tableName="product_staff_inventory";
	    $limit = 10;	
        
		$query="SELECT COUNT(*) as num FROM $tableName
		LEFT JOIN staff on staff.ID=product_staff_inventory.staff_id
		LEFT JOIN product on product.product_id=product_staff_inventory.product_id
		WHERE product_staff_inventory.staff_id='".$_POST['staff_id']."'
		ORDER BY product_staff_inventory.staff_inventory_id DESC";
		

		$total_pages = mysqli_fetch_array(mysqli_query($con,$query));
		$total_pages = $total_pages['num'];
		
		$stages = 3;
		$page=0;
		if(isset($_POST['page'])){
		$page = mysqli_real_escape_string($con,$_POST['page']);
		}
		if($page){
		$start = ($page - 1) * $limit; 
		}else{
		$start = 0; 
		}


		$query="SELECT *,product_staff_inventory.product_id FROM `product_staff_inventory`
		LEFT JOIN staff on staff.ID=product_staff_inventory.staff_id
		LEFT JOIN product on product.product_id=product_staff_inventory.product_id
		WHERE product_staff_inventory.staff_id='".$_POST['staff_id']."'
		ORDER BY product_staff_inventory.staff_inventory_id DESC LIMIT $start, $limit";
		
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
			$jsonObj3 = array();   

			
			
			
		    $row1['staff_inventory_id'] = $data['staff_inventory_id'];
			
			$row1['product_id'] = $data['product_id'];
			$row1['product_name'] = $data['product_name'];
			$row1['product_description'] = $data['product_description'];

			if(!empty($data['product_image'])){
          	    $product_image = UPLOAD_PATH.'products/'.$data['product_image'];
          	}else{
          	    $product_image='';
          	}
			$row1['product_image'] = $product_image;



			$row1['staff_id'] = $data['staff_id'];
			$row1['staff_name'] = $data['name'];
			$row1['email'] = $data['email'];
			$row1['mobile'] = $data['mobile'];



			$row1['staff_stock_qty'] = $data['staff_stock_qty'];
			$row1['staff_sell_qty'] = $data['staff_sell_qty'];

			$row1['staff_sell_qty'] = $data['staff_sell_qty'];
			if($data['staff_stock_qty'] >=$data['staff_stock_qty']){
				$live_stock= $data['staff_stock_qty'] - $data['staff_sell_qty'];
			}else{
				$live_stock="0";
			}
			$row1['live_stock'] = $live_stock;

			$row1['staff_inventory_status'] = $data['staff_inventory_status'];
			
			if($data['staff_inventory_date'] == "")
          	{
          	    $inventory_date = "";
          	}else{
          	    $inventory_date = date("d M, Y", strtotime($data['staff_inventory_date']));
          	}
          	
			$row1['staff_inventory_date'] = $inventory_date;
            
 			
 			
 		  
 			
			array_push($jsonObj1,$row1);

		
		}

		$count_pages =ceil($total_pages/$limit);
	    
	    if($count_pages <= 0)
	    {
	        $count_pages1 =  1;
	    }else {
	        $count_pages1 =  ceil($total_pages/$limit);
	    }
		
		// $set['JSON_DATA'] = $jsonObj1;	

		$set['page'] = $_POST['page'];
		$set['totalimage'] = $count_pages1;
		$set['limit'] = $limit;
		$set['success'] = '1';
		$set['JSON_DATA'] = $jsonObj1;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}

//get all staff inventory
else if(isset($_GET['get_order_staff_all_inventory']))
{


		$jsonObj1= array();


		$query="SELECT *,product_staff_inventory.product_id FROM `product_staff_inventory`
		LEFT JOIN staff on staff.ID=product_staff_inventory.staff_id
		LEFT JOIN product on product.product_id=product_staff_inventory.product_id
		WHERE product_staff_inventory.staff_id='".$_POST['staff_id']."'
		ORDER BY product_staff_inventory.staff_inventory_id DESC";
		
		$sql = mysqli_query($con,$query)or die(mysqli_error());


		while($data = mysqli_fetch_assoc($sql))
		{
			$jsonObj3 = array();   

			
			
			
		    $row1['staff_inventory_id'] = $data['staff_inventory_id'];
			
			$row1['product_id'] = $data['product_id'];
			$row1['product_name'] = $data['product_name'];
			$row1['product_description'] = $data['product_description'];

			if(!empty($data['product_image'])){
          	    $product_image = UPLOAD_PATH.'products/'.$data['product_image'];
          	}else{
          	    $product_image='';
          	}
			$row1['product_image'] = $product_image;



			$row1['staff_id'] = $data['staff_id'];
			$row1['staff_name'] = $data['name'];
			$row1['email'] = $data['email'];
			$row1['mobile'] = $data['mobile'];



			$row1['staff_stock_qty'] = $data['staff_stock_qty'];
			$row1['staff_sell_qty'] = $data['staff_sell_qty'];

			$row1['staff_sell_qty'] = $data['staff_sell_qty'];
			if($data['staff_stock_qty'] >=$data['staff_stock_qty']){
				$live_stock= $data['staff_stock_qty'] - $data['staff_sell_qty'];
			}else{
				$live_stock="0";
			}
			$row1['live_stock'] = $live_stock;

			$row1['staff_inventory_status'] = $data['staff_inventory_status'];
			
			if($data['staff_inventory_date'] == "")
          	{
          	    $inventory_date = "";
          	}else{
          	    $inventory_date = date("d M, Y", strtotime($data['staff_inventory_date']));
          	}
			
			$row1['staff_inventory_date'] = $inventory_date;
            
 			
 			
 		  
 			
			array_push($jsonObj1,$row1);

		
		}

	
		$set['JSON_DATA'] = $jsonObj1;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


// update order product
else if(isset($_GET['update_order_product']))
{

 			$jsonObj1= array();
 			
 			$qry_chek_order = "SELECT * FROM orders WHERE id = '".$_POST['order_id']."' AND staff_id = '".$_POST['staff_id']."' "; 
    		
    		$result_check_order = mysqli_query($con,$qry_chek_order);
    		$num_rows_check = mysqli_num_rows($result_check_order);
    		$row_check_order = mysqli_fetch_assoc($result_check_order);

			date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
			$date = date('Y-m-d H:i:s');
			$date1 = date('Y-m-d');
			$date2 = date('H:i:s');
 			if($num_rows_check >0 )
 			{
 			    
 				
                        
                if(!empty($_POST['product_details']) )
                {		
    					
    					
    					
            			$product_details = $_POST['product_details'];
            			$someArray = json_decode($product_details, true);
				        for ($x = 0; $x <= count($someArray)-1 ; $x++) {
				      			
				      			$product_id = $someArray[$x]["product_id"];
				      			$request_quantity = $someArray[$x]["request_quantity"];
				      			
				    			
				    			if(!empty($request_quantity)){

									$user_edit= "UPDATE product_staff_inventory SET product_staff_inventory.staff_sell_qty = product_staff_inventory.staff_sell_qty + '".$someArray[$x]["request_quantity"]."'
									WHERE product_staff_inventory.product_id = '".$someArray[$x]["product_id"]."' and product_staff_inventory.staff_id='".$_POST['staff_id']."' ";	 

									$result123 = mysqli_query($con,$user_edit);

				    			}else{

				    			}
					    			
					    		


				        }
                       	
                        
						$vender_edit_order= "UPDATE orders SET product_details='".$product_details."' WHERE orders.id = '".$_POST['order_id']."' "; 	
                        
						$vendor_res_book = mysqli_query($con,$vender_edit_order); 
						
                		$qrys = "SELECT * FROM orders WHERE orders.id = '".$_POST['order_id']."'"; 
            			$results = mysqli_query($con,$qrys);
            			$row_last_order = mysqli_fetch_assoc($results);
                	    
        				
						$set['JSON_DATA'][]	=	array(    
						'msg' 	=>	"Staff Order product update Successfully.",
						'success'=>'1'
						);

        		}else
    			{
    				$set['JSON_DATA'][]=array('msg' => "SomeThigns Want to wrong",'success'=>'0');
    			}
			     
			}else
			{
				$set['JSON_DATA'][]=array('msg' => "This Booking Id not exists.please try another",'success'=>'0');
			}

        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}
















//staff for reachage fine and rewards list
else if(isset($_GET['get_today_staff_recharge_fine']))
{
  		$jsonObj4= array();


        
        $query="SELECT *,s.name as staffname, s.ID as staffid,rf.ID as rechargefineid,rf.type as rechargefinetype,rf.cdate as rechargefinecdate,rf.start_date as rechargefinesdate,rf.end_date as rechargefineedate,rf.status as rechargefinestatus,rf.title as rechargefinetitle,rf.description as rechargefinedesc,rf.price as rechargefineprice,rf.recharge_fine_type as recharge_fine_type
         FROM recharge_fine rf
        left join staff s on s.ID = rf.staff_id 
        where rf.status = 1 and rf.staff_id = '".$_POST['staff_id']."' and rf.recharge_fine_type = '".$_POST['rechargefine_type']."' and rf.start_date = '".$newrd."'
        ORDER BY rf.ID DESC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
			//INSERT INTO `recharge_fine`(`ID`, `status`, `staff_id`, `recharge_fine_type`, `title`, `description`, `price`, `start_date`, `end_date`, `type`) 
          	
            $row1['rechargefine_id'] = $data['rechargefineid'];
            $row1['staff_id'] = $data['staffid'];
            $row1['staff_name'] = $data['staffname'];
            $row1['rechargefine_type'] = $data['recharge_fine_type'];
            $row1['rechargefine_title'] = $data['title'];
            $row1['rechargefine_cdate'] = $data['rechargefinecdate'];
            
            if($data['rechargefinesdate'] == "")
          	{
          	    $rechanges_date = "";
          	}else{
          	    $rechanges_date = date("d M, Y", strtotime($data['rechargefinesdate']));
          	}
          	
            $row1['rechargefine_start_date'] = $rechanges_date;
            // $row1['rechargefine_end_date'] = $data['rechargefineedate'];
            $row1['rechargefine_desc'] = $data['rechargefinedesc'];
            $row1['rechargefine_price'] = $data['rechargefineprice'];
            $row1['rechargefine_status'] = $data['rechargefinestatus'];

			// 1-pay,2-paid,3-expried
           
            $row1['type'] = $data['rechargefinetype'];
          
			array_push($jsonObj4,$row1); 
		}
		  
		$set['JSON_DATA'] = $jsonObj4;	

		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();


}





//verify otp for staff
else if(isset($_GET['staff_change_type_recharge_fine']))
{
       
	    $qry = "SELECT * FROM recharge_fine WHERE recharge_fine.staff_id ='".$_POST['staff_id']."' AND  recharge_fine.ID = '".$_POST['rechargefine_id']."'  "; 
	    $result = mysqli_query($con,$qry);
	    $row = mysqli_fetch_assoc($result);
	    
	    $num_rows = mysqli_num_rows($result);
    	
	    if ($num_rows > 0)
	    {

	    		$user_image_edit2= "UPDATE recharge_fine SET `type`='4' WHERE ID='".$_POST['rechargefine_id']."' and staff_id = '".$_POST['staff_id']."' ";	 
		   			
		   		$user_res2 = mysqli_query($con,$user_image_edit2);	
			
				$set['JSON_DATA'][]=array('msg' => "Payment successfully...!",
				'success' 	=>	"1"
				);
				    	
	    }else{	
	    
	    		
	        $set['JSON_DATA'][]=array('msg' => "Something want wrong.",'success'=>'0');
	    		
	    }

    
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//logout staff
else if(isset($_GET['user_delete_account']))
{
	if($_POST['user_id']!="" )
	{
	
		$b_id = $_POST['user_id'];

		$user_edit= "UPDATE user_registration SET status = '0' WHERE ID = '".$b_id."'  "; 
        $user_res = mysqli_query($con,$user_edit);

			$set['JSON_DATA'][]	= array(  
			'msg' =>	"Logout",
			'success'=>'1'
	     	);
		  
    
     }else {
		$set['JSON_DATA'][]=array('msg' => "some thing went wrong ...!",'success'=>'0');
	}

	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}


//khushboo 04/0/2023

//add to book the services
else if(isset($_GET['add_book']))
{

 			$jsonObj1= array();

 			if($_POST['user_id']!='' && $_POST['payment_status']!=''  )
 			{
 			    $order_otp=rand(1000,9999);
				date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
				$date = date('Y-m-d H:i:s');
				$date1 = date('Y-m-d');
				$date2 = date('H:i:s');

					if($_POST['payment_status'] == 3)
					{
						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$_POST['user_id']."'
								ORDER BY cart.ID ASC";


							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
							}

							$total_time_slot = $times / 30;
        	
            			    $total_time_slot_round = round($total_time_slot);

							
							$all_timeslot = array();
                     
                            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
			    		    $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
			    		    while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
			    		    {
			    			   
			    			    $row2 = $data_timeslot['timeslot'];
			    			             
			    			    array_push($all_timeslot,$row2);

			    			}
			                    
			    			// print_r($all_timeslot);
			                $new = array();
			                foreach ($all_timeslot as $key => $value) {
			                    //echo $value;
			                if ($value === $_POST['order_time']) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $_POST['order_time'];
			                 //   array_push($new,$times1); 
			                    
			                     for ($x = 0; $x < $total_time_slot_round; $x++) {
			                        
    	                            $new[$key] = $all_timeslot[$key];
    	                            if($new[$key] == "")
    	                            {
    			                        break;
    	                            }
    	                            $key++;
			                    }
			                    
			                }
			                }
			                
			                $string_version = implode(',', $new);
			 				// echo $string_version;
			 				// print_r($new);
							// exit;

				// 		if($times >= 60)
				// 		{
				            if( $_POST['final_price']  >= MINI_ORDER_AMOUNT)
				            {
							$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
							$wallet_result = mysqli_query($con,$wallet_check);
							$wallet_row = mysqli_fetch_assoc($wallet_result);
							$wallet_amt = $wallet_row['wallet'];
							$wallet_num = mysqli_num_rows($wallet_result);
						    
                            $query_address="SELECT * FROM `address` a
                            WHERE a.ID = '".$_POST['a_id']."' and a.status = 1
                            ORDER BY a.ID DESC";
                            
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                        
                            $row_address = mysqli_fetch_assoc($sql_address);
                            
                            $address_city_id = $row_address['city_id'];
                            
							if(($wallet_num > 0 && $wallet_amt >= $_POST['final_price'] ))
							{
								$qry1="INSERT INTO `orders`(`user_id`, `staff_id`,`city_id`,`address`, `payment_type`, `message`, `dis_price`, `ori_price`,`conveyance_charges`,`safety_hygiene_charges`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`,`service_price`, `added_on`, `order_date`, `order_time`,`order_otp`)
		        				VALUES (
		        			    	'".$_POST['user_id']."',
		        			    	'".$_POST['staff_id']."',
		        			    	'".$address_city_id."',
		        			    	'".$_POST['a_id']."',
		        			    	'1',
		        			    	'".addslashes($_POST['message'])."',
		        					'".$_POST['dis_price']."',
		        					'".$_POST['ori_price']."',
		        					'".$_POST['conveyance_charges']."',
		        					'".$_POST['safety_hygiene_charges']."',
		        					'".$_POST['final_price']."',
		        					'".$_POST['payment_status']."',
		        					'1',
		        					'".$_POST['txnid']."',
		        					'".$_POST['mihpayid']."',
		        					'".$_POST['payu_status']."',
		        					'".$_POST['coupon_id']."',
		        					'".$_POST['coupon_value']."',
		        					'".$_POST['coupon_code']."',
		        					'0',
		        					'".$now."',
		        				    '".$_POST['order_date']."',
		        				    '".$string_version."',
		        				    '".$order_otp."'
		        				)"; 
			                        
		        				$result1 = mysqli_query($con,$qry1);

		        				$last_id = mysqli_insert_id($con);  

		                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
		            			$results = mysqli_query($con,$qrys);
		            			$row = mysqli_fetch_assoc($results);
	    
	                    
			                  
			                    
			            		if(!empty($last_id))
			            		{
				            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
									LEFT JOIN user_registration u ON u.ID = cart.user_id 
									LEFT JOIN services s ON s.ID = cart.services_id 
									LEFT JOIN category c ON c.ID = s.category 
									LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
									LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
									WHERE cart.user_id='".$_POST['user_id']."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}

                                  $delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' ";
			                    $result1 = mysqli_query($con,$delete);

			                	 //wallet payment
						  		if($_POST['payment_type'] == 3)
						  		{
						  			$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$_POST['user_id']."' "; 
									$wallet_result = mysqli_query($con,$wallet_check);

									$wallet_row = mysqli_fetch_assoc($wallet_result);
									$wallet_amt = $wallet_row['wallet'];
									$wallet_num = mysqli_num_rows($wallet_result);
									// echo "hello";
									if($wallet_num > 0)
									{ 
								
										$final_amount = $wallet_amt - $_POST['final_price'];
										
										$user_edit= "UPDATE user_registration SET wallet='".$final_amount."' WHERE ID = '".$_POST['user_id']."'";

										$user_res = mysqli_query($con,$user_edit);

										$description = 'Wallet payment debited';

										$childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$_POST['user_id']."','".$_POST['final_price']."','".$description."','2','3','".$date."','1')";
					            		$childuser_res = mysqli_query($con,$childuser_wallet);

									}
						  		}

						  		$order_details = array(); 

		                		$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
								WHERE orderdetails.order_id='".$last_id."'
								ORDER BY orderdetails.id ASC";

							    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

							    while($data_order_details = mysqli_fetch_array($sql_order_details))
							   	{
							   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
							   		$row1['order_id'] = $data_order_details['order_id'];
							   		$row1['category_id'] = $data_order_details['category_id'];
							   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
							   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
							   		$row1['service_id'] = $data_order_details['service_id'];
							   		$row1['qty'] = $data_order_details['qty'];
							   		$row1['ori_price'] = $data_order_details['ori_price'];
							   		$row1['dis_price'] = $data_order_details['dis_price'];

				  		 			
				 					array_push($order_details,$row1); 
						           
						  		}        

								  //notification code
								  $qry2 = "SELECT * FROM `staff`
								  WHERE staff.ID ='".$_POST['staff_id']."' ";        
								  $result2 = mysqli_query($con,$qry2);
								  $row3 = mysqli_fetch_assoc($result2);    
								  
								  // exit;
							  
								  $qry3 = "SELECT * FROM `user_registration`
								  WHERE user_registration.ID='".$_POST['user_id']."' ";        
								  $result3 = mysqli_query($con,$qry3);
								  $row4 = mysqli_fetch_assoc($result3);
							  
								if(!empty($_POST['staff_id']))
								{
									if($row['payment_type'] == 1)
									{
										$tokens = $row3['token'];
										$name = $row4['name'];
										$restro_name = $row3['name'];
										$o_date = $_POST['order_date'];
										$b_id = $last_id;
										
										$notification_click = 1;
										$title="Booking ASSIGN";
									
								// 		$body = "Hello " .$name. ",Booking with ID " .$id. " has been ASSIGN by".$restro_name;
										
										//new notification		 
										$body = "Hello! " .$restro_name. ", you have been assigned with a task for Booking ID " .$b_id. ", Kindly visit and provide the service.";
										
										send_notification($tokens,$title,$body,$b_id,$notification_click);
										
										$notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
									
										 VALUES(1,'1','2','".$_POST['staff_id']."','".$b_id."','".$title."','1','".$o_date."','".$body."','')"; 
									  // exit;
										   $notifi_res = mysqli_query($con,$notifi_insert);
										
									}

								}
								 

								

								

						  		$set['JSON_DATA'][]	=	array(    
									'msg' 	=>	"Order placed Successfully",
									'success'=>'1',
									'order_id' 	=>	$row['id'],
									'user_id' 	=>	$row['user_id'],
									'staff_id' 	=>	$row['staff_id'],
									'a_id' 	=>	$row['address'],
									'order_details' => $order_details,
									'payment_type' 	=>	$row['payment_type'],
									'message' 	=>	$row['message'],
									'dis_price' 	=>	$row['dis_price'],
									'ori_price'	=>  $row['ori_price'],
									'conveyance_charges'	=>  $row['conveyance_charges'],
									'safety_hygiene_charges'	=>  $row['safety_hygiene_charges'],
									'final_price'	=>  $row['final_price'],
									'payment_status'	=>  $row['payment_status'],
									'order_status'	=>  $row['order_status'],
									'txnid'	=>  $row['txnid'],
									'mihpayid'	=>  $row['mihpayid'],
									'payu_status'	=>  $row['payu_status'],
									'coupon_id'	=>	$row['coupon_id'],
									'coupon_value'	=>	$row['coupon_value'],
									'coupon_code'	=>	$row['coupon_code'],
									'service_price'	=>	$row['service_price'],
									'added_on'	=>	$row['added_on'],
									'order_date'	=>	$row['order_date'],
									'order_time'	=>	$row['order_time'],
								
									);

							}else{

										$set['JSON_DATA'][]=array('msg' => "Insufficient balance in your wallet...!",'success'=>'0');
						
										}
				// 		}else if($times <= 60){
				// 			$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
				// 		}
				        
				        			}else if( $_POST['final_price'] <= MINI_ORDER_AMOUNT){
							$set['JSON_DATA'][]=array('msg' => "you have to book service minimum amount 500...!",'success'=>'0');
						}
						
            		 
					}else if($_POST['payment_status'] == 1 OR $_POST['payment_status'] == 2) {

						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$_POST['user_id']."'
								ORDER BY cart.ID ASC";


							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
							}
                             //echo $times;
                            //exit;
							$total_time_slot = $times / 30;
        	               // echo $total_time_slot;
            			    $total_time_slot_round = round($total_time_slot);
                            // echo $total_time_slot_round;
							
							$all_timeslot = array();
                     
                            $query_timeslot="SELECT *,timeslot.timeslot FROM `timeslot` ORDER BY timeslot.ID ASC ";
			    		    $sql_timeslot = mysqli_query($con,$query_timeslot)or die(mysqli_error());
			    		    while($data_timeslot = mysqli_fetch_assoc($sql_timeslot))
			    		    {
			    			   
			    			    $row2 = $data_timeslot['timeslot'];
			    			             
			    			    array_push($all_timeslot,$row2);

			    			}
			                    
			    	// 		 print_r($all_timeslot);
			                $new = array();
			                foreach ($all_timeslot as $key => $value) {
			                    //echo $value;
			                if ($value === $_POST['order_time']) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $_POST['order_time'];
			                 //   array_push($new,$times1); 
			                    
			                    for ($x = 0; $x < $total_time_slot_round; $x++) {
			                        
    	                            $new[$key] = $all_timeslot[$key];
    	                           // print_r($all_timeslot[$key]);
    	                            if($new[$key] == "")
    	                            {
    			                        break;
    	                            }
    	                            $key++;
			                    }
			                    
			                }
			                }
			                
			                $string_version = implode(',', $new);
                            // echo $string_version;
                            //print_r($new);
                            // exit;
			 //              	if($times >= 60)
				// 			{
							    
							 if( $_POST['final_price']  >= MINI_ORDER_AMOUNT)
				            {   
							$query_address="SELECT * FROM `address` a
                            WHERE a.ID = '".$_POST['a_id']."' and a.status = 1
                            ORDER BY a.ID DESC";
                            
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                        
                            $row_address = mysqli_fetch_assoc($sql_address);
                            
                            $address_city_id = $row_address['city_id'];
                            

								$qry1="INSERT INTO `orders`(`user_id`,`staff_id`, `city_id`,`address`, `payment_type`, `message`, `dis_price`, `ori_price`,`conveyance_charges`,`safety_hygiene_charges`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`,`service_price`, `added_on`, `order_date`, `order_time`,`order_otp`)
			        				VALUES (
			        			    	'".$_POST['user_id']."',
			        			    	'".$_POST['staff_id']."',
			        			    	'".$address_city_id."',
			        			    	'".$_POST['a_id']."',
			        			    	'1',
			        			    	'".addslashes($_POST['message'])."',
			        					'".$_POST['dis_price']."',
			        					'".$_POST['ori_price']."',
			        					'".$_POST['conveyance_charges']."',
			        					'".$_POST['safety_hygiene_charges']."',
			        					'".$_POST['final_price']."',
			        					'".$_POST['payment_status']."',
			        					'1',
			        					'".$_POST['txnid']."',
			        					'".$_POST['mihpayid']."',
			        					'".$_POST['payu_status']."',
			        					'".$_POST['coupon_id']."',
			        					'".$_POST['coupon_value']."',
			        					'".$_POST['coupon_code']."',
			        					'0',
			        					'".$now."',
			        				    '".$_POST['order_date']."',
			        				    '".$string_version."',
			        				    '".$order_otp."'
			        				)"; 

			        			$result1 = mysqli_query($con,$qry1);
							
		                       
		                        
		                        $last_id = mysqli_insert_id($con);  

		                        $qrys = "SELECT * FROM orders WHERE id = '".$last_id."'"; 
		            			$results = mysqli_query($con,$qrys);
		            			$row = mysqli_fetch_assoc($results);
		    
		                    
			                   
			                    
			            		if(!empty($last_id))
			            		{
				            		$query1="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
									LEFT JOIN user_registration u ON u.ID = cart.user_id 
									LEFT JOIN services s ON s.ID = cart.services_id 
									LEFT JOIN category c ON c.ID = s.category 
									LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
									LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
									WHERE cart.user_id='".$_POST['user_id']."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`(`type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}
			        			
			        			 $delete = "DELETE FROM cart WHERE user_id='".$_POST['user_id']."' ";
			                    $result1 = mysqli_query($con,$delete);

			                    // INSERT INTO `orders_detail`(`id`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`)

			                    // INSERT INTO `orders`(`id`, `user_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`)

			                    $order_details = array(); 

			                	$query_order_details="SELECT *,orderdetails.id as orderdetailsid FROM `orders_detail` orderdetails
									WHERE orderdetails.order_id='".$last_id."'
									ORDER BY orderdetails.id ASC";

								    $sql_order_details = mysqli_query($con,$query_order_details)or die(mysqli_error());

								    while($data_order_details = mysqli_fetch_array($sql_order_details))
								   	{
								   		$row1['order_details_id'] = $data_order_details['orderdetailsid'];
								   		$row1['order_id'] = $data_order_details['order_id'];
								   		$row1['category_id'] = $data_order_details['category_id'];
								   		$row1['sub_category_id'] = $data_order_details['subcategory_id'];
								   		$row1['sub_sub_category_id'] = $data_order_details['subsubcategory_id'];
								   		$row1['service_id'] = $data_order_details['service_id'];
								   		$row1['qty'] = $data_order_details['qty'];
								   		$row1['ori_price'] = $data_order_details['ori_price'];
								   		$row1['dis_price'] = $data_order_details['dis_price'];
					  		 			
					 					array_push($order_details,$row1); 
							           
							  		}           


									  //notification code
									  $qry2 = "SELECT * FROM `staff`
									  WHERE staff.ID ='".$_POST['staff_id']."' ";        
									  $result2 = mysqli_query($con,$qry2);
									  $row3 = mysqli_fetch_assoc($result2);    
									  
									  // exit;
								  
									  $qry3 = "SELECT * FROM `user_registration`
									  WHERE user_registration.ID='".$_POST['user_id']."' ";        
									  $result3 = mysqli_query($con,$qry3);
									  $row4 = mysqli_fetch_assoc($result3);
								  
									if(!empty($_POST['staff_id']))
									{
										if($row['payment_type'] == 1)
										{
											$tokens = $row3['token'];
											$name = $row4['name'];
											$restro_name = $row3['name'];
											$o_date = $_POST['order_date'];
											$b_id = $last_id;
											
											$notification_click = 1;
											$title="Booking ASSIGN";
										
								// 			$body = "Hello " .$name. ",Booking with ID " .$id. " has been ASSIGN by".$restro_name;
											$body = "Hello! " .$restro_name. ", you have been assigned with a task for Booking ID " .$b_id. ", Kindly visit and provide the service.";
											 
										    //new notification			   
											send_notification($tokens,$title,$body,$b_id,$notification_click);
											
											$notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
										
											 VALUES(1,'1','2','".$_POST['staff_id']."','".$b_id."','".$title."','1','".$o_date."','".$body."','')"; 
										  // exit;
											   $notifi_res = mysqli_query($con,$notifi_insert);
											
										}
	
									}
									 

									

							  		
							  		
							  			$set['JSON_DATA'][]	=	array(    
										'msg' 	=>	"Order placed Successfully",
										'success'=>'1',
										'order_id' 	=>	$row['id'],
										'user_id' 	=>	$row['user_id'],
										'staff_id' 	=>	$row['staff_id'],
										'a_id' 	=>	$row['address'],
										'order_details' => $order_details,
										'payment_type' 	=>	$row['payment_type'],
										'message' 	=>	$row['message'],
										'dis_price' 	=>	$row['dis_price'],
										'ori_price'	=>  $row['ori_price'],
										'conveyance_charges'	=>  $row['conveyance_charges'],
										'safety_hygiene_charges'	=>  $row['safety_hygiene_charges'],
										'final_price'	=>  $row['final_price'],
										'payment_status'	=>  $row['payment_status'],
										'order_status'	=>  $row['order_status'],
										'txnid'	=>  $row['txnid'],
										'mihpayid'	=>  $row['mihpayid'],
										'payu_status'	=>  $row['payu_status'],
										'coupon_id'	=>	$row['coupon_id'],
										'coupon_value'	=>	$row['coupon_value'],
										'coupon_code'	=>	$row['coupon_code'],
										'service_price'	=>	$row['service_price'],
										'added_on'	=>	$row['added_on'],
										'order_date'	=>	$row['order_date'],
										'order_time'	=>	$row['order_time'],
										
										);
						  //		}else if($times <= 60){
						  //			$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
						  //		}
            					}else if( $_POST['final_price'] <= MINI_ORDER_AMOUNT){
            							$set['JSON_DATA'][]=array('msg' => "you have to book service minimum amount 500...!",'success'=>'0');
            						}
						
							}			

	        }else
				{
					$set['JSON_DATA'][]=array('msg' => "SomeThigns Want to wrong",'success'=>'0');
				}
                   
            
                  
		
        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
}


//test notification
else if(isset($_GET['test_noti']))
{


    $tokens = 'e9h2h33gS6iwWSmZg8FK9f:APA91bHCdX4hzA4TJlEUL-m0WANHkVkTeRDY0yhvanW_S9ohOU1SK5oKn13ZoQqBwo_IU2Gm-JmTJ15yL2etB-RZB4L0przkVUD478ZuOQlBktjZtrN9UplH5Bg5RTtkvJ5h-EIgwRx5';
    
     send_notification12($tokens);
		
			$set['JSON_DATA'][]=array('msg' => "Please enter coupon id",'success'=>'0');
		 
			header( 'Content-Type: application/json; charset=utf-8' );
 	   		echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
 			die();
		
}

//khushboo 08-08-2023

// user update profile
else if(isset($_GET['update_city']))
{
		if(isset($_POST['user_id']) && !empty($_POST['user_id'])  )
		{
		
			$sql = "SELECT * FROM user_registration where ID = '".$_POST['user_id']."' ";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_assoc($res);
			
			$num_rows2 = mysqli_num_rows($res);
	    		
	        if ($num_rows2 > 0 )
	        {	


				      $user_edit= "UPDATE user_registration SET city_id='".$_POST['city_id']."' WHERE ID = '".$_POST['user_id']."'";	 
		   			
		   			  $user_res = mysqli_query($con,$user_edit);
                            

   					if($user_res==true)
   					{

			    		$set['JSON_DATA'][]	= array(  
			            'msg'	=>	'Updated successfully.',
			            'success'=>'1',
			         
						);
     								
     								
   					}else{
        	            $set['JSON_DATA'][]=array('msg'=>'Something want wrong','success'=>'0');
        	        }
				}
			
			
		}else{
				$set['JSON_DATA'][]=array('msg' => "Username,email,password,mobile no fields are require ",'success'=>'0');
		}
	header( 'Content-Type: application/json; charset=utf-8' );
	echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	die();
}

?>