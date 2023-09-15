<?php 
require('check.php');
$pageurl = "todayorder$extn";
$pagename = "Appointment Master";
$tblname = "orders";
$id = @$_GET['id']; 
$date = date('Y-m-d');
// Delete Query
if(@$_GET['mode']=="delete" && $id !=""){
  
  // Delete Entry From My Order Section
  $sql="DELETE FROM `$tblname` WHERE id='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

  if($sql){
    // Delete Entry from Order Details Table
    $sql2="DELETE FROM `orders_detail` WHERE order_id='$id'";
    if (!mysqli_query($con,$sql2)){die('Error: ' . mysqli_error($con)); }
  }

  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Order%20Deleted%20successfully...'>";  exit(0);
} else if(@$_GET['mode']=="paid" && $id !=""){
  // $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  $sql="UPDATE `$tblname` SET status='$_GET[status]' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Status updated..'>";  exit(0);
}

//Select Query to display the records
$sql = "SELECT *,t2.name as staffname FROM `orders` t1 
LEFT JOIN `user_registration` t4 ON t1.user_id=t4.ID 
left join `staff` t2  ON t2.ID = t1.staff_id
Where t1.order_date = '".$date."'
ORDER BY t1.ID desc";
$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);


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
          <h3 class="box-title text-blue"><?php echo $pagename. ' ('. $rowcount. ') '; ?></h3>
          <a href="<?=$pageurl;?>"> <i class="fa fa-refresh text-green"></i></a>
        </div>
        <div class="box-body table-responsive no-padding" style="padding: 10px!important;">
        <?php  
          echo displayMsg(@$_GET['msg']);
          echo dangerMsg(@$_GET['msgdanger']);
          echo dupl_msg(@$_GET['dupl_msg']);
        ?>
        <form name="delete" id="frmCompare" class="frmCompare" action="" method="post"> 
          <table id="example1_samy" class="table table-bordered table-striped table-hover" style="text-align: center;">
            <thead>
              <!--<tr>-->
              <!--  <td width="45"> -->
              <!--    <div id="btnCompare" style="display: none; margin: 0px -9px;">-->
              <!--      <button name="action" value="Delete" id="on_off_btn" title="Delete" onClick="return verifCompare();"><img src="dist/img/delete.png" title="Click to Delete" /></button> &nbsp;-->
              <!--    </div>-->
              <!--  </td>-->
              <!--</tr>-->
              <tr>
                <th width="20" align="center">ID</th>
                <th width="70" align="center">Appointment ID</th>
                <th width="150">Staff Name</th>
                <th width="100">Order OTP</th>
                <th width="150">Appointment Date</th>
                <th>Appointment Details</th>
                <th>Payment</th>
                <th width="50">Total</th>
                <th width="100">Type</th>
                <th>View</th>
                <?php if($superrole==0){ ?><th>Action</th><?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result, TRUE)){ $num=$num+1; 
                // debug($row);
                ?>
              <tr>
                <td align="center"><?php echo $num; ?></td>
                <td><?= "#BS-0".$row['id']; ?></td>
                <td align="left"><?= $row['staffname']; ?></td>
                <td align="left"><?= $row['order_otp']; ?></td>
                <td align="left"><?= formatDate($row['added_on']); ?></td>
                <td align="left">
                  <span class="text-blue"><i class="fa fa-calendar text-blue"></i> <?php echo dateString($row['order_date']); ?></span><br>
                  <span class="text-red bold"><i class="fa fa-clock-o"></i> <?php 
                    if ($row['order_time'] != "") 
         			{
                        $arr1= explode(",",$row['order_time']);
                        $arr = array_filter($arr1, 'strlen');
                    }else
                    {
                        $arr = [] ;
                    }
    		        echo $arr1[0]; ?>
    		        </span>
                </td>
                <td style="text-align: left;">
                  <!-- <span class="text-blue bold"> Payment Mode : </span><?= strtoupper($row['order_status']); ?> <br /> -->
                  <span class="text-darkgreen bold">  Payment Status : </span><?php if($row['payment_status'] ==1){ echo 'Pay at place';}else if($row['payment_status'] ==2){ echo 'Online Payment';}else if($row['payment_status'] ==3){ echo 'Wallet';} ?> 
                </td>
                <td><?= RS.$row['final_price']; ?></td>
                <td align="left"><span class="bold text-red"><?php if($row['payment_type'] == 1){ echo 'Pending';}else if($row['payment_type'] == 2){ echo 'Accepted';}else if($row['payment_type'] == 3){ echo 'Rejected';}else if($row['payment_type'] == 4){ echo 'Completed';} else if($row['payment_type'] == 5){ echo 'Canceled';} ?></span></td>
                <td><a href="<?= $baseurl.'/admin/order-details'. $extn; ?>?order_id=<?= $row['id']; ?>" class="font-11"><i class="fa fa-eye"></i> View Details</a></td>
                <?php if($superrole==0){ ?>
                <td>
                  <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['id'] ?>&mode=delete" class="text-red" title="Permanent Delete"><i class="fa fa-trash-o"></i>&nbsp;</a>
                </td>
                <?php } ?> 	  
              </tr>
            <?php } ?>
            </tbody>
          </table>
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