<?php require('check.php'); 

$pageurl      = "stafforderfilter";
$tblname      = "orders";
$pagename     = "Staff Book List";
$id           = @$_GET['id']; 
$pic_required = '';
$sessionid    = date("ymdHis"); 


if(isset($_GET['city_id']) and isset($_GET['staff_id']) and isset($_GET['sdate']) and isset($_GET['edate']))
{
    $s_o_date1=date_create($_GET['sdate']);
    $s_o_date12 = date_format($s_o_date1,"Y-m-d");
    
    $e_o_date1=date_create($_GET['edate']);
    $e_o_date2 = date_format($e_o_date1,"Y-m-d");
    if($_GET['city_id'] == 0 and $_GET['staff_id'] == 0 )
    {

        //Select Query to display the records
        $sql = "SELECT *,t2.name as staffname FROM `orders` t1 
        LEFT JOIN `user_registration` t4 ON t1.user_id=t4.ID 
        left join `staff` t2  ON t2.ID = t1.staff_id
        where t1.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'
        ORDER BY t1.ID desc";
    
    }else if($_GET['sdate'] != "" and $_GET['edate'] != "" ){
        
        //Select Query to display the records
        // $sql = "SELECT *,t2.name as staffname FROM `orders` t1 
        // LEFT JOIN `user_registration` t4 ON t1.user_id=t4.ID 
        // left join `staff` t2  ON t2.ID = t1.staff_id
        // where t1.city_id='".$_GET['city_id']."' AND t1.staff_id='".$_GET['staff_id']."'
        // ORDER BY t1.ID desc";
        
         $sql = "SELECT *,t2.name as staffname FROM `orders` t1 
        LEFT JOIN `user_registration` t4 ON t1.user_id=t4.ID 
        left join `staff` t2  ON t2.ID = t1.staff_id
        where t1.city_id='".$_GET['city_id']."' AND t1.staff_id='".$_GET['staff_id']."' and t1.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'
        ORDER BY t1.ID desc";
        
    }else{
        
        //Select Query to display the records
       
    }
}

$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);
    
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
        
        <form role="form" method="GET" action="" enctype="multipart/form-data">    
            <div class="box-body">
                 <div class="form-group col-md-3">
                  <label for="city_id">City Name <span class="text-red">*</span></label>
                  <select class="form-control" name="city_id" required id="city_id">
                    <option class="text-blue bold" value="0">Select City</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,name FROM `city` Where city.status=1  ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        // echo 'c_id:'.$get_cid;
                        if($row['ID']==$_GET['city_id']){
                          echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="staff_id">Staff Name <span class="text-red">*</span></label>
                  <select class="form-control" name="staff_id" id="staff_id">
                    <option value="0">Select Staff</option>
                    <?php
                    // echo $get_cid;
                          if( @$_GET['city_id'] ) {
                            $res = mysqli_query($con,"SELECT ID,name FROM `staff` WHERE staff.status=1 ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$_GET['staff_id']){
                                echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                              }
                              else{
                                echo "<option value=".$row['ID'].">".$row['name']."</option>";
                              }
                            }
                          }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="startdate">Start Date: <span class="text-red">*</span></label>
                    <input type="date" class="form-control" name="sdate" id="sdate" value="<?= @$_GET['sdate']; ?>" autocomplete="off" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="enddate">End Date: <span class="text-red">*</span></label>
                    <input type="date" class="form-control" name="edate" id="edate" value="<?= @$_GET['edate']; ?>" autocomplete="off" required>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" name="search_filter" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        
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
                <td align="left"><span class="bold text-red"><?php if($row['payment_type'] == 1){ echo 'Pending';}else if($row['payment_type'] == 2){ echo 'Accected';}else if($row['payment_type'] == 3){ echo 'Rejected';}else if($row['payment_type'] == 4){ echo 'Completed';} else if($row['payment_type'] == 5){ echo 'Canceled';} ?></span></td>
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

<script>
  $(document).ready(function(){
    jQuery('#city_id').change(function(){

    var get_sid = "";

      var id=jQuery(this).val();
    //   console.log("Category ID: "+ id);
      if(id=='-1'){
        jQuery('#staff_id').html('<option value="0">Select Staff </option>');
      }else{
        $("#divLoading").addClass('show');
        jQuery('#staff_id').html('<option value="0">Select Staff </option>');
        jQuery.ajax({
          type:'post',
          url:'get_data3.php?mode=staff',
          data:'id='+id+'&get_sid='+get_sid,
          // data:'id='+id,
          success:function(result){
            $("#divLoading").removeClass('show');
            jQuery('#staff_id').append(result);
          }
        });
      }
    });
  });
</script>