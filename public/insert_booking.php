<?php

include('../inc/config.php'); 

session_start();

if (isset($_POST['payment_status']) and isset($_POST['address']) and isset($_POST['timezone']) and isset($_POST['timezone']) )
{
    $payment_status = $_POST['payment_status'];
    $instructions = $_POST['instructions'];
    $address = $_POST['address'];
    $timezone = $_POST['timezone'];
    $promocode = $_POST['promocode'];
    $user_id = $_SESSION['user_id']; 
    $date12 = $_POST['date'];
    $order_otp=rand(1000,9999);
    
        $recommended = $_POST['recommended']; 

            $jsonObj1= array();

 			if($user_id!='' && $payment_status!=''  )
 			{
 			    
				date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
				$date = date('Y-m-d H:i:s');
				$date1 = date('Y-m-d');
				$date2 = date('H:i:s');

					if($payment_status == 3)
					{
						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$user_id."'
								ORDER BY cart.ID ASC";

                            $total = 0;
                            $totals_is_various = 0;

							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
								
								 $totals_is_various1 = $data1["cart_services_qty"] * $data1["cart_services_ori_amount"];
                                 $totals_is_various += $totals_is_various1;
                
                                 $totals = $data1["cart_services_qty"] * $data1["cart_services_dis_amount"];
                                 $total += $totals;
                                 
                                 if ($total == "") {
                                  $total1 = '0';
                                } else {
                                  $total1 = $total;
                                }
                
                                if ($totals_is_various == "") {
                                  $totals_is_various1 = '0';
                                } else {
                                  $totals_is_various1 = $totals_is_various;
                                }
                
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
			                if ($value === $timezone) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $timezone;
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
				        
							$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$user_id."' "; 
							$wallet_result = mysqli_query($con,$wallet_check);
							$wallet_row = mysqli_fetch_assoc($wallet_result);
							$wallet_amt = $wallet_row['wallet'];
							$wallet_num = mysqli_num_rows($wallet_result);
						    
						   $final_amount = 0;   
						    
						    $query = "SELECT * FROM coupon_master 
                            WHERE status = 1
                            and coupon_master.coupon_promocode = '".$promocode."'
                            ORDER BY coupon_master.`ID` ASC ";
                            
                            $result = $con->query($query);
                            $row1 = mysqli_fetch_assoc($result);
                            $num_rows2 = mysqli_num_rows($result);
                            if ($num_rows2 > 0 )
                            {
                                
                                $coupon_id = $row1['ID'];

                                if($total1 >= $row1['coupon_minamount'])
                                {
                
                                    if($row1['coupon_type'] == 1)
                                    {
                                        $total_price_min = $total1 * $row1['coupon_price'];
                                        $amount = $total_price_min / 100;
                    
                                        if($amount >= $row1['coupon_maxamount'])
                                        {
                                            
                                            $coupon_amount1 = $total1 - $row1['coupon_maxamount'];
                                            $coupon_amount =$row1['coupon_maxamount'];
                                            $final_amount = $coupon_amount1+APP_conveyance + APP_safety_hygiene;
                                        }else{
                                            $coupon_amount1 = $total1 - $amount;
                                            $coupon_amount = $amount;
                                            $final_amount = $coupon_amount1 + APP_conveyance + APP_safety_hygiene; 
                                        }
                                        
                                    }else if($row1['coupon_type'] == 2)
                                    {
                                        $coupon_amount1 = $total1 - $row1['coupon_price'];
                                        $coupon_amount = $row1['coupon_price'];
                                        $final_amount = $coupon_amount1 + APP_conveyance + APP_safety_hygiene;
                                    }
                                }
                            }else{
                                 $final_amount = $total1 + APP_conveyance + APP_safety_hygiene;
                                 $coupon_id = 0;
                                 $coupon_amount = 0;
                            }
                            if( $final_amount  >= MINI_ORDER_AMOUNT)
				        {
                            $query_address="SELECT * FROM `address` a
                            WHERE a.ID = '".$address."' and a.status = 1
                            ORDER BY a.ID DESC";
                            
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                        
                            $row_address = mysqli_fetch_assoc($sql_address);
                            
                            $address_city_id = $row_address['city_id'];
                            

							if(($wallet_num > 0 && $wallet_amt >= $final_amount ))
							{
								$qry1="INSERT INTO `orders`(`user_id`,`staff_id`, `city_id` ,`address`, `payment_type`, `message`, `dis_price`, `ori_price`,`conveyance_charges`,`safety_hygiene_charges`,`final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`,`order_otp`)
		        				VALUES (
		        			    	'".$user_id."',
		        			    	'".$recommended."',
		        			    	'".$address_city_id."',
		        			    	'".$address."',
		        			    	'1',
		        			    	'".$instructions."',
		        					'".$total1."',
		        					'".$totals_is_various1."',
		        					'".APP_conveyance."',
		        					'".APP_safety_hygiene."',
		        					'".$final_amount."',
		        					'".$payment_status."',
		        					'1',
		        					'',
		        					'',
		        					'',
		        					'".$coupon_id."',
		        					'".$coupon_amount."',
		        					'".$promocode."',
		        					'".$now."',
		        				    '".$date12."',
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
									WHERE cart.user_id='".$user_id."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`( `type`,`order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}

                                 $delete = "DELETE FROM cart WHERE user_id='".$user_id."' ";
			                    $result1 = mysqli_query($con,$delete);

			                	 //wallet payment
						  		if($payment_status == 3)
						  		{
						  			$wallet_check = "SELECT * FROM user_registration WHERE ID = '".$user_id."' "; 
									$wallet_result = mysqli_query($con,$wallet_check);

									$wallet_row = mysqli_fetch_assoc($wallet_result);
									$wallet_amt = $wallet_row['wallet'];
									$wallet_num = mysqli_num_rows($wallet_result);
									// echo "hello";
									if($wallet_num > 0)
									{ 
								
										$final_amount1 = $wallet_amt - $final_amount;
										
										$user_edit= "UPDATE user_registration SET wallet='".$final_amount1."' WHERE ID = '".$user_id."'";

										$user_res = mysqli_query($con,$user_edit);

										$description = 'Wallet payment debited';

										$childuser_wallet= "INSERT INTO `wallet_history`(`wh_user_id`, `wh_amount`, `description`,`wh_transaction_type`, `wh_type`, `wallet_date`, `wallet_status`) VALUES('".$user_id."','".$final_amount."','".$description."','2','3','".$date."','1')";
					            		$childuser_res = mysqli_query($con,$childuser_wallet);

									}
						  		}
						  		
						  		if($results == true)
						  		{
						  		    echo 'success';
						  		}else{
						  		    echo 'failed';
						  		}

							}else{
                                
                                echo 'wallet';
								//$set['JSON_DATA'][]=array('msg' => "Insufficient balance in your wallet...!",'success'=>'0');
							}
						}else if( $_POST['final_price'] <= MINI_ORDER_AMOUNT){
						    echo 'service_min_time';
				            //$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
						}
						
            		  
					}else if($payment_status == 1 OR $payment_status == 2) {

						$times = 0;

						$query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus,s.duration as duration FROM `cart` as cart
								LEFT JOIN user_registration u ON u.ID = cart.user_id 
								LEFT JOIN services s ON s.ID = cart.services_id 
								LEFT JOIN category c ON c.ID = s.category 
								LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
								LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
								WHERE cart.user_id='".$user_id."'
								ORDER BY cart.ID ASC";

                    
							$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
							
							$total = 0;
                            $totals_is_various = 0;
                            
							$index = 1;
							while($data1 = mysqli_fetch_array($sql_cart))
							{
								$times += $data1['duration']*$data1['cart_services_qty'];
								
								$totals_is_various1 = $data1["cart_services_qty"] * $data1["cart_services_ori_amount"];
                                $totals_is_various += $totals_is_various1;
                
                                $totals = $data1["cart_services_qty"] * $data1["cart_services_dis_amount"];
                                $total += $totals;
                                 
                                if ($total == "") {
                                  $total1 = '0';
                                } else {
                                  $total1 = $total;
                                }
                
                                if ($totals_is_various == "") {
                                  $totals_is_various1 = '0';
                                } else {
                                  $totals_is_various1 = $totals_is_various;
                                }
                                
							}
							
				// 			echo "Total time";
				// 		    echo $times;

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
			                if ($value === $timezone) {
			                    // echo  $key;
			                    // $search = $key;
			                 //  	$times1 = $timezone;
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

			 //              	if($times >= 60)
				// 			{
				
				                
    				 			$final_amount = 0;   
    						    
    						    $query = "SELECT * FROM coupon_master 
                                WHERE status = 1
                                and coupon_master.coupon_promocode = '".$promocode."'
                                ORDER BY coupon_master.`ID` ASC ";
                                
                                $result = $con->query($query);
                                $row1 = mysqli_fetch_assoc($result);
                                $num_rows2 = mysqli_num_rows($result);
                                if ($num_rows2 > 0 )
                                {
                                    
                                    $coupon_id = $row1['ID'];
    
                                    if($total1 >= $row1['coupon_minamount'])
                                    {
                    
                                        if($row1['coupon_type'] == 1)
                                        {
                                            $total_price_min = $total1 * $row1['coupon_price'];
                                            $amount = $total_price_min / 100;
                        
                                            if($amount >= $row1['coupon_maxamount'])
                                            {
                                                
                                                $coupon_amount1 = $total1 - $row1['coupon_maxamount'];
                                                $coupon_amount =$row1['coupon_maxamount'];
                                                 $final_amount = $coupon_amount1+APP_conveyance + APP_safety_hygiene;
                                            }else{
                                                $coupon_amount1 = $total1 - $amount;
                                                $coupon_amount = $amount;
                                                 $final_amount = $coupon_amount1 + APP_conveyance + APP_safety_hygiene; 
                                            }
                                            
                                        }else if($row1['coupon_type'] == 2)
                                        {
                                            $coupon_amount1 = $total1 - $row1['coupon_price'];
                                            $coupon_amount = $row1['coupon_price'];
                                            $final_amount = $coupon_amount1 + APP_conveyance + APP_safety_hygiene;
                                        }
                                    }
                                }else{
                                    $final_amount = $total1 + APP_conveyance + APP_safety_hygiene;
                                    $coupon_id = 0;
                                    $coupon_amount = 0;
                                }
                                
                                if( $final_amount  >= MINI_ORDER_AMOUNT)
							    {
                                $query_address="SELECT * FROM `address` a
                                WHERE a.ID = '".$address."' and a.status = 1
                                ORDER BY a.ID DESC";
                                
                                $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
                            
                                $row_address = mysqli_fetch_assoc($sql_address);
                                
                                $address_city_id = $row_address['city_id'];
                            
                            

								 $qry1="INSERT INTO `orders`(`user_id`,`staff_id`, `city_id`, `address`, `payment_type`, `message`, `dis_price`, `ori_price`, `conveyance_charges`,`safety_hygiene_charges`, `final_price`, `payment_status`, `order_status`, `txnid`, `mihpayid`, `payu_status`, `coupon_id`, `coupon_value`, `coupon_code`, `added_on`, `order_date`, `order_time`,`order_otp`)
			        				VALUES (
			        			    	'".$user_id."',
			        			    		'".$recommended."',
			        			    	'".$address_city_id."',
			        			    	'".$address."',
			        			    	'1',
			        			    	'".$instructions."',
			        					'".$total1."',
			        					'".$totals_is_various."',
			        					'".APP_conveyance."',
			        					'".APP_safety_hygiene."',
			        					'".$final_amount."',
			        					'".$payment_status."',
			        					'1',
			        					'',
			        					'',
			        					'',
			        					'".$coupon_id."',
			        					'".$coupon_amount."',
			        					'".$promocode."',
			        					'".$now."',
			        				    '".$date12."',
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
									WHERE cart.user_id='".$user_id."'
									ORDER BY cart.ID ASC";


								    $sql1 = mysqli_query($con,$query1)or die(mysqli_error());
								    $index = 1;
								    while($data1 = mysqli_fetch_array($sql1))
								   	{

							            $insertsql= "INSERT INTO `orders_detail`( `type`, `order_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `service_id`, `qty`, `ori_price`, `dis_price`) VALUES ('1','".$last_id."','".$data1['catid']."','".$data1['subid']."','".$data1['subsubid']."','".$data1['services_id']."','".$data1['cart_services_qty']."','".$data1['cart_services_ori_amount']."', '".$data1['cart_services_dis_amount']."')";

							            $sql2 = mysqli_query($con,$insertsql)or die(mysqli_error());

										$index++;
							  		}                           

			        			}
			        			
			        			$delete = "DELETE FROM cart WHERE user_id='".$user_id."' ";
			                    $result1 = mysqli_query($con,$delete);
                                // exit;
                                if($results == true)
                                {
                                    echo 'success';
                                }else{
                                    echo 'failed';
                                }
							  	
						  		}else if($_POST['final_price'] <= MINI_ORDER_AMOUNT){
						  		    echo 'service_min_time';
						  //			$set['JSON_DATA'][]=array('msg' => "you have to book service minimum 1 hours...!",'success'=>'0');
						  		}	
							}			

	        }else
			{
				echo 'failed';
			}
                   
}else{
   echo 'failed';
}
?>