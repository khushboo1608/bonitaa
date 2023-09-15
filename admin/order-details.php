<?php 
require('check.php');
include("../inc/GCM.php");

$pageurl = "order-details$extn";
$pagename = "Appointment Details";
$tblname = "orders";
$id = @$_GET['id']; 
$order_id = $_GET['order_id'];

date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d h:i:s");

// echo 'Hii';

// Update status query
if(@$_GET['mode']=="update" && $id !=""){
    
  // echo $order_time= $_POST['order_time'] ;
  $order_time1 = implode(',', (array)$_POST['order_time']);


  // $order_time1 = implode (',',$order_time);
  // exit;
   $sql="UPDATE `orders` SET payment_type='$_POST[update_order_status]',order_date='$_POST[order_date]', order_time='".$order_time1."' , staff_id='".$_POST['staff_id']."' WHERE id='$id'";
  
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  
    $qry1 = "SELECT * FROM `orders`
    WHERE orders.id='".$id."' ";        
    $result1 = mysqli_query($con,$qry1);
    $row2 = mysqli_fetch_assoc($result1);
    
    $qry2 = "SELECT * FROM `staff`
    WHERE staff.ID ='".$_POST['staff_id']."' ";        
    $result2 = mysqli_query($con,$qry2);
    $row3 = mysqli_fetch_assoc($result2);    
    
    // exit;

    $qry3 = "SELECT * FROM `user_registration`
    WHERE user_registration.ID='".$row2['user_id']."' ";        
    $result3 = mysqli_query($con,$qry3);
    $row4 = mysqli_fetch_assoc($result3);


    if($_POST['update_order_status'] == 2)
    {
        $tokens = $row3['token'];
        $name = $row4['name'];
        $restro_name = $row3['name'];
        $o_date = $row2['order_date'];
        $b_id = $id;
        
        $notification_click = 1;
        $title="Booking ASSIGN";
    
        //$body = "Hello " .$restro_name. ",Booking with ID " .$id. " has been ASSIGN by ADMIN";
        
        //new notification
        $body = "Hello! " .$restro_name. ", you have been assigned with a task for Booking ID " .$b_id. ", Kindly visit and provide the service.";
    			   
        send_notification($tokens,$title,$body,$b_id,$notification_click);
        
        $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
    
    	 VALUES(1,'1','2','".$_POST['staff_id']."','".$b_id."','".$title."','7','".$date."','".$body."','')"; 
      // exit;
       	$notifi_res = mysqli_query($con,$notifi_insert);
        
    }
    // exit;
    if($_POST['update_order_status'] == 2)
    {
        $tokens = $row4['token'];
        $name = $row4['name'];
        $restro_name = $row3['name'];
        $o_date = $row2['order_date'];
        $b_id = $id;
        
        $notification_click = 1;
        $title="Booking ACCEPTED";
        
        // $body = "Hello " .$name. ", Your Booking with ID " .$id. " has been ACCEPTED by " .$restro_name ;
        
        //new notification
    	$body = "Hello! " .$name. ", your Booking for BonitaA services has been accepted by our service partner " .$restro_name. ".";
        
        send_notification($tokens,$title,$body,$b_id,$notification_click);
        
        $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
        
        VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','2','".$date."','".$body."','')"; 
        
        $notifi_res = mysqli_query($con,$notifi_insert);
        
    }
    
    if($_POST['update_order_status'] == 3)
    {
        $tokens = $row4['token'];
        $name = $row4['name'];
        $restro_name = $row3['name'];
        $o_date = $row2['order_date'];
        $b_id = $id;
        
        $notification_click = 1;
        $title="BOOK REJECTED";
        
        // $body = "Hello " .$name. ", Your Booking with ID " .$id. " has been REJECTED by " .$restro_name ;
        //new notification
        $body = "Hello " .$name. ", sorry for the inconvenience caused, as your service has been rejected.";
        
        send_notification($tokens,$title,$body,$b_id,$notification_click);
        
        $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 
        
        VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','3','".$date."','".$body."','')"; 
        
        $notifi_res = mysqli_query($con,$notifi_insert);
        
    }
    
    if($_POST['update_order_status'] == 4)
    {
        $tokens = $row4['token'];
        $name = $row4['name'];
        $restro_name = $row3['name'];
        $o_date = $row2['order_date'];
        $b_id = $id;
        
        $notification_click = 1;
        $title="BOOK COMPLETED";

        $body = "Hello! " .$name. ", Booking ID ".$b_id." your booking for BonitaA services has been qently completed by our service partner ".$restro_name." . Hope to serve you again.";
				 
        send_notification($tokens,$title,$body,$b_id,$notification_click);
        
        $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 

		 VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','4','".$date."','".$body."','')"; 

   		$notifi_res = mysqli_query($con,$notifi_insert);
        
    }
    
    if($_POST['update_order_status'] == 5)
    {
        $tokens = $row4['token'];
        $name = $row4['name'];
        $restro_name = $row3['name'];
        $o_date = $row2['order_date'];
        $b_id = $id;
        
        $notification_click = 1;
        $title="BOOK CANCELLED";
      			
    //   	$body = "Hello " .$name. ",  unfortunately order has CANCELLED because of some issues. your Booking with ID " .$b_id;
			// new notification	 
			$body = "Hello! " .$restro_name. ", ".$name." with Booking ID ".$b_id." has cancelled the booking assigned to you.";		 	   
        send_notification($tokens,$title,$body,$b_id,$notification_click);
        
         $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`, `date`, `msg`, `image`) 

		 VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','5','".$date."','".$body."','')"; 

   		$notifi_res = mysqli_query($con,$notifi_insert);
        
    }

    // if($_POST['update_order_status'] == 6)
    // {
    //     $tokens = $row4['token'];
    //     $name = $row4['name'];
    //     $restro_name = $row3['name'];
    //     $o_date = $row2['order_date'];
    //     $b_id = $id;
        
    //     $notification_click = 1;
    //     $title="Booking START";
        
    //     $body = "Hello " .$name. ", Your Booking with ID " .$id. " has been started by " .$restro_name ;
        
        
    //     send_notification($tokens,$title,$body,$b_id,$notification_click);
        
    //     $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
        
    //     VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','6','".$date."','".$body."','')"; 
        
    //     $notifi_res = mysqli_query($con,$notifi_insert);
        
    // }

    // if($_POST['update_order_status'] == 7)
    // {
    //     $tokens = $row4['token'];
    //     $name = $row4['name'];
    //     $restro_name = $row3['name'];
    //     $o_date = $row2['order_date'];
    //     $b_id = $id;
        
    //     $notification_click = 1;
    //     $title="Booking END";
        
    //     $body = "Hello " .$name. ", Your Booking with ID " .$id. " has been ended by " .$restro_name ;
        
        
    //     send_notification($tokens,$title,$body,$b_id,$notification_click);
        
    //     $notifi_insert= "INSERT INTO `notification`(`status`, `click`, `type`, `user_id`, `order_id`, `tittle`, `no_type`,`date`, `msg`, `image`) 
        
    //     VALUES(1,'1','1','".$row4['ID']."','".$b_id."','".$title."','7','".$date."','".$body."','')"; 
        
    //     $notifi_res = mysqli_query($con,$notifi_insert);
        
    // }
            
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?order_id=$id&displayMsg=Order Status updated..'>";  exit(0);
   
}

// Get Coupon Related Details
$coupon_details = mysqli_fetch_assoc(mysqli_query($con,"SELECT coupon_value, coupon_code FROM `orders` WHERE id='$order_id'"));
$coupon_value = ($coupon_details['coupon_value']!="") ? $coupon_details['coupon_value'] : "0";
$coupon_code = $coupon_details['coupon_code'];

//Select all code
$selectvariable = '';
if (@$_POST['action'] == 'Delete') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or ID = '", $ids);
  $sql="DELETE FROM `$tblname` WHERE ID='$companyasend'";
  // $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$companyasend'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Selected $pagename are deleted..'>";  exit(0);
}

// Delete Query
$order_details_id = @$_GET['order_details_id'];

if(@$_GET['mode']=="delete" && $order_details_id !=""){
    
  $ori_price = @$_GET['ori_price'];
  $dis_price = @$_GET['dis_price'];
  $order_type = @$_GET['order_type'];
  $order_id = @$_GET['order_id'];
   
     $qry1 = "SELECT * FROM `orders`
    WHERE orders.id='".$order_id."' ";        
    $result1 = mysqli_query($con,$qry1);
    $row2 = mysqli_fetch_assoc($result1);
    

  $ori_finalamount = $row2['ori_price'] - $ori_price;
  $dis_finalamount = $row2['dis_price'] - $dis_price;

  $final_amout = $row2['final_price'] - $dis_price;

  $service_amount = $row2['service_price'];

  if($order_type == 1)
  {
    $sql_order="UPDATE `orders` SET dis_price='".$dis_finalamount."',ori_price='".$ori_finalamount."', final_price='".$final_amout."' WHERE id='$order_id' ";
  
    if (!mysqli_query($con,$sql_order)){die('Error: ' . mysqli_error($con)); }
      
    $sql_order_details = "DELETE FROM `orders_detail` WHERE id='$order_details_id'";
    if (!mysqli_query($con,$sql_order_details)){die('Error: ' . mysqli_error($con)); }    

  }else if($order_type == 2){
      
    $service_amount1 = $service_amount - $dis_price;
    $sql_order="UPDATE `orders` SET final_price='".$final_amout."', service_price='".$service_amount1."' WHERE id='$order_id' ";
  
    if (!mysqli_query($con,$sql_order)){die('Error: ' . mysqli_error($con)); }    
      
    $sql_order_details = "DELETE FROM `orders_detail` WHERE id='$order_details_id'";
    if (!mysqli_query($con,$sql_order_details)){die('Error: ' . mysqli_error($con)); }

  }
  
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?order_id=$order_id&msgdanger=Service%20Deleted%20successfully...'>";  exit(0);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pagename . " | $admintitle"; ?></title>
  <?php require('bootstrap.inc.php'); ?> 
  <?php require('css.inc.php'); ?> 
</head>
<?php require('skincolor.inc.php'); ?>
<div class="wrapper"> 
  <?php require('header.inc.php'); ?>
  <?php require('leftmenu.inc.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $pagename; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="<?php echo $boxcolor; ?>">
        <div class="box-header with-border">
          <h3 class="box-title text-blue"><?php echo $pagename; ?></h3>
          <a href="<?=$pageurl.'?order_id='.$_GET['order_id'];?>"> <i class="fa fa-refresh text-green"></i></a>
        </div>
        <div class="box-body table-responsive no-padding" style="padding: 10px!important;">
        <?php  
          echo displayMsg(@$_GET['msg']);
          echo dangerMsg(@$_GET['msgdanger']);
          echo dupl_msg(@$_GET['dupl_msg']);
        ?>
          <form method="POST" class="checkout woocommerce-checkout form-inline" action="<?= $pageurl; ?>?mode=update&id=<?= $_GET['order_id']; ?>">
            <div class="col2-set" id="customer_details" style="overflow-x:auto;">
              <table class="table table-hover table-bordered">
                <thead class="bg-dark text-white">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Sub category Name</th>
                    <th scope="col">Sub sub Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Service Name</th>
                    <!--<th scope="col">Service Type</th>-->
                    <th scope="col">Service Duration</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Original Price</th>
                    <th scope="col">Discount Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $final_price = 0;
                  $ori_price = 0;
                  $num = 0;
                   $sql = mysqli_query($con,"SELECT t1.*,t2.pic as serviceimage,t2.title as servicename,t4.name as user_name,t4.mobile as user_mobile,t8.name as statename,t9.name as cityname,t3.final_price as finalprice,t7.pincode as pincode,t3.order_date as order_date,t3.order_time as order_time,t3.message as message,t2.duration as duration,t5.subcategory as subcat_name,t2.type as servicetype,t3.payment_type as payment_type,t7.houser_no as houser_no,t7.lendmark as lendmark,t7.adderss as adderss,t3.staff_id as staffid,t10.name as pincodename,t3.service_price as service_price,t3.partner_pic,t3.setup_pic,t3.product_pic,t3.product_details,t11.category as categoryname,t6.subsubcategory_name as subsubname,t3.dis_price as orderdis_price,t3.ori_price as orderori_price FROM `orders_detail` t1 
                      LEFT JOIN `services` t2 ON t2.ID=t1.service_id 
                      LEFT JOIN `orders` t3 ON t3.ID=t1.order_id 
                      LEFT JOIN `user_registration` t4 ON t4.ID=t3.user_id 
                      LEFT JOIN `category` t11 ON t2.category = t11.ID 
                      LEFT JOIN `subcategory` t5 ON t2.subcategory = t5.ID 
                      LEFT JOIN `subsubcategory` t6 ON t2.subsubcategory = t6.ID 
                      LEFT JOIN `address` t7 ON t7.ID=t3.address 
                      LEFT JOIN `state` t8 ON t8.ID=t7.state_id 
                      LEFT JOIN `city` t9 ON t9.ID=t7.city_id 
                      LEFT JOIN `pincode` t10 ON t10.ID = t7.pincode
                      WHERE t1.order_id='$order_id' ");
                  while($row = mysqli_fetch_assoc($sql)){ 

                    $settings_details = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `settings` WHERE settings.ID = '1' ORDER BY settings.ID desc"));

                    
                    
                    $ori_price       = $ori_price+($row['ori_price']*$row['qty']);
                    $final_price       = $final_price+($row['dis_price']*$row['qty']);

                    if($row['type'] == 1)
                    {  
                      $order_type = 'User addon service';
                      $order_dis_price1 = 0;

                    }else  if($row['type'] == 2){
                       $order_type = 'Partner addon service';
                       $order_dis_price1    = $row['orderdis_price'];
                     
                    }

                 
                  $num = $num+1;
                  // debug($row);
                  $partner_pic               = ($row['partner_pic']!="") ? $row['partner_pic'] : "noimg.webp";
                  $setup_pic               = ($row['setup_pic']!="") ? $row['setup_pic'] : "noimg.webp";
                  $product_pic               = ($row['product_pic']!="") ? $row['product_pic'] : "noimg.webp";


                  $pic               = ($row['serviceimage']!="") ? $row['serviceimage'] : "noimg.webp";
                  $safetyCharges     = $settings_details['text1'];
                  $conveyanceCharges = $settings_details['text2'];
                 

                  $categoryname             = $row['categoryname'];
                  $subcategoryname             = $row['subcat_name'];
                  $subsubcategoryname             = $row['subsubname'];
                  
                  $uname             = $row['user_name'];
                  $umobile           = $row['user_mobile'];
                  $state             = $row['statename'];
                  $city              = $row['cityname'];
                  $pincode           = $row['pincodename'];
                  $order_date        = $row['order_date'];
                  $order_times        = $row['order_time'];
                  $specialinst       = $row['message'];
                  $orderType = $row['payment_type'];
                  $staff_id = $row['staffid'];
                  $final_amount = $row['finalprice'];

                  $order_details_id = $row['id'];

                  $product_details = $row['product_details'];

                  $address       = $row['houser_no'].','.$row['lendmark'].','.$row['adderss'];
                
                  $service_amount = $row['service_price'];
                  $service_final_amount = $row['service_price'] + $final_price;
                  
                  $order_ori_price       = $row['orderori_price'];
                  $order_dis_price        = $row['orderdis_price'];
                 

                  
                  ?>
                  <tr valign="middle" class="text-center">
                    <td><?= $num; ?></td>
                    <td><?= $order_type; ?></td>
                    <td><?= $categoryname; ?></td>
                    <td><?= $subcategoryname; ?></td>
                    <td><?= $subsubcategoryname; ?></td>
                    <td><img src="<?= UPLOAD_PATH.'service/'. $pic; ?>" width="50"></td>
                    <td align="left"><b><?= $row['servicename']; ?></b></td>
                    <!--<td align="left"><?= $row['subcat_name']; ?> <b>[<?= $row['servicetype']; ?>]</b></td>-->
                    <td><?= $row['duration']; ?></td>
                    <td><?= $row['qty']; ?></td>
                    <td><?= RS. $row['ori_price']; ?></td>
                    <td><?= RS. $row['dis_price']; ?></td>
                    <td><?= RS. $row['dis_price'] * $row['qty']; ?></td>
                    
                    <td><a onClick="return verifCompare();" href="<?= $pageurl; ?>?order_details_id=<?php echo $order_details_id; ?>&order_id=<?php echo $order_id; ?>&ori_price=<?php echo $row['qty']*$row['ori_price']; ?>&dis_price=<?php echo $row['qty']*$row['dis_price']; ?>&order_type=<?php echo $row['type']; ?>&mode=delete" class="text-red" title="Delete"><i class="fa fa-trash-o"></i>&nbsp;</a></td>
                  </tr>
                  <?php } ?>
                  <tr valign="middle" class="text-center">
                    <td colspan="9" class="bold">Total Amount</td>
                     <td></td>
                     <td></td>
                    <td class="bold"><del><?= RS.$order_ori_price; ?></del><?= RS.$order_dis_price; ?></td>
                  </tr>

                  <tr valign="middle" class="text-center" style="background-color: #f5f5f5;">
                    <td colspan="9" class="bold">Addition Service Amount</td>
                     <td></td>
                     <td></td>
                    <td class="bold"><?= RS.$service_amount; ?></td>
                  </tr>

                  <tr valign="middle" class="text-center" >
                    <td colspan="9" class="bold">Previous Service Amount</td>
                     <td></td>
                     <td></td>
                    <td class="bold"><?= RS.$order_dis_price1; ?></td>
                  </tr>
                  
                  <tr valign="middle" class="text-center">
                    <td colspan="9" class="text-danger bold">Safety & Hygiene Charges </td>
                     <td></td>
                     <td></td>
                    <td class="bold"><?= RS.$safetyCharges; ?></td>
                  </tr>
                  
                  <tr valign="middle" class="text-center">
                    <td colspan="9" class="text-danger bold">Conveyance Charges </td>
                     <td></td>
                     <td></td>
                    <td class="bold"><?= RS.$conveyanceCharges; ?></td>
                  </tr>
                  <?php
                  if(!empty($coupon_value)):
                  ?>
                  <tr valign="middle" class="text-center">
                      <td colspan="9" class="bold">Coupon Code <span class="text-danger">(<?= $coupon_code; ?>)</span> </td>
                      <td></td>
                      <td></td>
                    <td class="bold"><b>(-) </b><?= RS.$coupon_value; ?></td>
                  </tr>
                  <?php endif; ?>
                  <tr valign="middle" class="text-center">
                    <td colspan="10" class="text-left">
                      <!--<?php if(!empty($specialinst)): ?>-->
                      <!--  <span><b>Special Instructions:</b> <?= $specialinst ?></span>-->
                      <!--<?php endif; ?>-->
                    </td>
                    <td colspan="1" class="bold label-danger text-white">Total Price</td>
                    <td class="bold label-danger text-white"><?= RS.($final_amount ); ?></td>
                  </tr>
                </tbody>
              </table>
              <?php if(!empty($specialinst)): ?>
                <span><b>Special Instructions:</b> <?= $specialinst ?></span>
              <?php endif; ?>
              <div class="col-md-8">
                <h3>Staff Upload Image</h3>
                <table class="table table-hover table-bordered">
                  <tr>
                    <th>
                      Partner Image
                    </th>
                    <th>
                      Setup Image
                    </th>
                    <th>
                      Product Image
                    </th>
                  </tr>
                  <tr>
                    <td>
                     
                        <a href="<?= UPLOAD_PATH.'orders/'.$partner_pic; ?>" target="_blank">
                        <img src="<?= UPLOAD_PATH.'orders/'.$partner_pic; ?>" width="200" style="max-height: 150px;">
                    </td>  
                    <td>
                      
                        <a href="<?= UPLOAD_PATH.'orders/'.$setup_pic; ?>" target="_blank">
                        <img src="<?= UPLOAD_PATH.'orders/'.$setup_pic; ?>" width="200" style="max-height: 150px;">
                    </td>  
                    <td>
                     
                        <a href="<?= UPLOAD_PATH.'orders/'.$product_pic; ?>" target="_blank">
                        <img src="<?= UPLOAD_PATH.'orders/'.$product_pic; ?>" width="200" style="max-height: 150px;">
                    </td> 
                  </tr>
                </table>
              </div>

              <div class="col-md-8">
                <h3> Product Used </h3>
                <table class="table table-hover table-bordered">
                  <tr>
                    <th>
                      Id
                    </th>
                    <th>
                      Product Name
                    </th>
                    <th>
                      Product Image
                    </th>
                    <th>
                      Product Description
                    </th>
                  </tr>
                    <?php
                    if($product_details == "")
                    {

                    }else{

                      $num = 0;
                      $someArray = json_decode($product_details, true);

                      for ($x = 0; $x <= count($someArray)-1 ; $x++) {
                        $num=$num+1; 
                        $query2="SELECT * FROM product WHERE product_id='".$someArray[$x]["product_id"]."' ";
                        $result2 = mysqli_query($con,$query2);
                        $row2 = mysqli_fetch_assoc($result2);

                        $product_name = $row2['product_name'];
                        $product_desc = $row2['product_description'];
                        $product_image = $row2['product_image'];

                        

                      
                      
                    ?>
                    <tr>
                      <td><?php echo $num; ?></td>
                      <td><?= $product_name; ?></td>
                      <td>
                        <a href="<?= UPLOAD_PATH.'products/'.$product_image; ?>" target="_blank">
                        <img src="<?= UPLOAD_PATH.'products/'.$product_image; ?>" width="200" style="max-height: 150px;">
                      </td>
                      <td><?= $product_desc; ?></td>
                    </tr>

                    <?php } }?>
                </table>
              </div>

              <div class="col-md-12">
                <h4>User Info</h4>
                <p><b>Name : </b><?= $uname; ?> [<a href="tel:<?= $umobile?>">Calling no: <?= $umobile; ?></a>]</p>
                <p><b>Address : </b><?= $address; ?></p>
                <p><b>State Name : </b><?= $state; ?>
                <p><b>City Name : </b><?= $city; ?>
                <p><b>Pincode : </b><?= $pincode; ?>
                <p><b>Order Status : </b>
                  <?php
                  if($orderType =="1"){
                    echo '<small class="label label-warning">Pending</small>';
                  }else if($orderType =="2"){
                    echo '<small class="label label-warning">Accepted</small>';
                  }else if($orderType =="3"){
                    echo '<small class="label label-danger">Rejected</small>';
                  }else if($orderType =="4"){
                    echo '<small class="label bg-green">Completed</small>';
                  }else if($orderType =="5"){
                    echo '<small class="label bg-green">Canceled</small>';
                  }else if($orderType =="6"){
                    echo '<small class="label bg-red">Started Job</small>';
                  }else if($orderType =="7"){
                    echo '<small class="label bg-blue">Ended Job</small>';
                  }
                  // echo $fetch['name'];
                  ?>
                </p>
                <div>
                 
                  <label for="staff_id">Select Staff <span class="text-red">*</span></label>
                  <select class="form-control" name="staff_id" required>
                    <option class="text-blue bold">Select Staff </option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,name FROM `staff` ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID'] == $staff_id){
                          echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <br />
               
                <div >
                    <label for="update_order_status">Change Appointment Status <span class="text-red">*</span></label>
                    <select class="form-control" name="update_order_status" required>
                      <option class="text-blue bold">Select Status</option>
                      <option value="1" <?php if(@$orderType=="1"){?> selected="selected"<?php } ?>>Pending</option>
                      <option value="2" <?php if(@$orderType=="2"){?> selected="selected"<?php } ?>>Accepted</option>
                      <option value="6" <?php if(@$orderType=="6"){?> selected="selected"<?php } ?>>Started Job</option>
                      <option value="7" <?php if(@$orderType=="7"){?> selected="selected"<?php } ?>>Ended Job</option>
                      <option value="3" <?php if(@$orderType=="3"){?> selected="selected"<?php } ?>>Rejected</option>
                      <option value="4" <?php if(@$orderType=="4"){?> selected="selected"<?php } ?>>Completed</option>
                      <option value="5" <?php if(@$orderType=="5"){?> selected="selected"<?php } ?>>Canceled</option>
                    </select>
                    
                </div>
                <br />
                <label for="order_date">Reschedule Date <span class="text-red">*</span></label>
                <input type="date" class="form-control" name="order_date" value="<?= @$order_date; ?>" placeholder="Select Date">
                <br />
                <br />
                <label for="order_time">Reschedule Time <span class="text-red">*</span></label>
                <select class="form-control" id="order_time[]" name="order_time[]" multiple="multiple">
                  <option class="text-blue bold">Select Time </option>
       

                    <?php
                                
                      $qry1="SELECT * FROM `timeslot` ORDER BY `timeslot`.`ID` ASC";
                      $results1=mysqli_query($con,$qry1);
                        while ($row1=mysqli_fetch_array($results1)) 
                        {
                        
                          $places1 = explode (',',$order_times);
                          print_r($places1);
                          ?>
                      <?php if (in_array($row1['timeslot'], $places1))  {
                              
                      $str_flag = "selected";
            
                        }else
                        {
                        $str_flag = "";
                        }?>
                      
                        <option value="<?php echo $row1['timeslot'];?>" <?php echo $str_flag;?>  >  <?php echo $row1['timeslot'];?> </option>
                      
                      <?php }
                                 
                    ?>

                </select>

                <div class="col-md-12" style="text-align-last: center;"><input type="submit" class="btn btn-primary" value="Update"></div>
                
                
              </div>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer include  -->
<?php require('footer.inc.php'); ?>
</div>
<!-- ./wrapper -->
<?php require('plugin.inc.php'); ?>
<?php require('script.inc.php'); ?>
<!-- Page script -->
</body>
</html>