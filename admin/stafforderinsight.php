<?php require('check.php'); 

$pageurl      = "stafforderinsight$extn";
$tblname      = "orders";
$pagename     = "Staff Book Insight";
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
        
        // 1=Pending,2=Accepted,3=Rejected,4=Completed,5=Canceled
        
       
		$query2 = "SELECT COUNT(*)
		as num FROM orders where orders.order_date = '".$newrd."' ";
		$total_pages2 = mysqli_fetch_array(mysqli_query($con,$query2));
		$today_order = $total_pages2['num'];
		
        
        $query1 = "SELECT COUNT(*)
		as num FROM orders where orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages1 = mysqli_fetch_array(mysqli_query($con,$query1));
		$total_order = $total_pages1['num'];

		$query3 = "SELECT COUNT(*) 
		as num FROM orders where orders.payment_type = 1 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'  ";
		$total_pages3 = mysqli_fetch_array(mysqli_query($con,$query3));
		$total_todaypending_order = $total_pages3['num'];     
        
		$query4 = "SELECT COUNT(*)
		as num FROM orders where orders.payment_type = 2 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages4 = mysqli_fetch_array(mysqli_query($con,$query4));
		$total_todayaccept_order = $total_pages4['num'];  
        
	
		$query8 = "SELECT COUNT(*)
		as num FROM orders where orders.payment_type = 3 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages8 = mysqli_fetch_array(mysqli_query($con,$query8));
		$total_todayreject_order = $total_pages8['num'];  


		$query7 = "SELECT COUNT(*)
		as num FROM orders where orders.payment_type = 4 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages7 = mysqli_fetch_array(mysqli_query($con,$query7));
		$total_todaydelivered_order = $total_pages7['num'];  

		$query6 = "SELECT COUNT(*)
		as num FROM orders where  orders.payment_type = 5 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages6 = mysqli_fetch_array(mysqli_query($con,$query6));
		$total_todaycancle_order = $total_pages6['num'];     
        
        
        $query9 = "SELECT SUM(final_price) as num FROM orders where orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'  and payment_type = 4  ";
        $total_pages9 = mysqli_fetch_array(mysqli_query($con,$query9));
        $total_amount_order = $total_pages9['num'];
        
    }else if($_GET['sdate'] != "" and $_GET['edate'] != "" ){
        
        $query1 = "SELECT COUNT(*)
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages1 = mysqli_fetch_array(mysqli_query($con,$query1));
		$total_order = $total_pages1['num'];
		
		$query2 = "SELECT COUNT(*)
		as num FROM orders where orders.order_date = '".$newrd."' ";
		$total_pages2 = mysqli_fetch_array(mysqli_query($con,$query2));
		$today_order = $total_pages2['num'];

		$query3 = "SELECT COUNT(*) 
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 1 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'  ";
		$total_pages3 = mysqli_fetch_array(mysqli_query($con,$query3));
		$total_todaypending_order = $total_pages3['num'];     
        
		$query4 = "SELECT COUNT(*)
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 2 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages4 = mysqli_fetch_array(mysqli_query($con,$query4));
		$total_todayaccept_order = $total_pages4['num'];  
        
	
		$query8 = "SELECT COUNT(*)
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 3 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages8 = mysqli_fetch_array(mysqli_query($con,$query8));
		$total_todayreject_order = $total_pages8['num'];  


		$query7 = "SELECT COUNT(*)
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 4 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages7 = mysqli_fetch_array(mysqli_query($con,$query7));
		$total_todaydelivered_order = $total_pages7['num'];  

		$query6 = "SELECT COUNT(*)
		as num FROM orders where orders.city_id='".$_GET['city_id']."' AND orders.staff_id='".$_GET['staff_id']."' and orders.payment_type = 5 and orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."' ";
		$total_pages6 = mysqli_fetch_array(mysqli_query($con,$query6));
		$total_todaycancle_order = $total_pages6['num'];     
        
        
        $query9 = "SELECT SUM(final_price) as num FROM orders where orders.order_date BETWEEN '".$_GET['sdate']."' AND '".$_GET['edate']."'  and payment_type = 4 and orders.staff_id='".$_GET['staff_id']."' AND orders.city_id='".$_GET['city_id']."' ";
        $total_pages9 = mysqli_fetch_array(mysqli_query($con,$query9));
        $total_amount_order = $total_pages9['num']; 
        
    }else{
        
       
        
        
    }
    
}





?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $admintitle; ?> | Dashboard</title>
  <?php require('bootstrap.inc.php'); ?>  
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
      <h1>  Staff Insight <!-- <small>Version 1.0</small> --> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <form role="form" method="GET" action="" enctype="multipart/form-data">    
        <div class="box-body">
             <div class="form-group col-md-3">
              <label for="city_id">City Name <span class="text-red">*</span></label>
              <select class="form-control" name="city_id" required id="city_id">
                <option class="text-blue bold" value="0">Select City</option>
                <?php  
                  $res = mysqli_query($con,"SELECT ID,name FROM `city` ORDER BY ID ASC");
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
                        $res = mysqli_query($con,"SELECT ID,name FROM `staff` ORDER BY ID ASC");
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
        
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-th-large"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Book</span>
                <span class="info-box-number"><?php echo $total_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Today Book</span>
                <span class="info-box-number"><?php echo $today_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
            
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Book Pending</span>
                <span class="info-box-number"><?php echo $total_todaypending_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Book Accepted</span>
                <span class="info-box-number"><?php echo $total_todayaccept_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Book Completed</span>
                <span class="info-box-number"><?php echo $total_todaydelivered_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Book Cancled</span>
                <span class="info-box-number"><?php echo $total_todaycancle_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Book Rejected</span>
                <span class="info-box-number"><?php echo $total_todayreject_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Amount</span>
                <span class="info-box-number"><?php echo $total_amount_order; ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <!-- /.box -->
          
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <?php /* ?>
          <div class="box box-info">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: flex; justify-content: center;height: 300px;">
              <h1 style="margin-top: 120px;">Welcome to <?= $webtitle; ?> Dashboard</h1>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
            <!-- /.box-footer -->
          </div>
          <?php */ ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer include  -->
<?php require('footer.inc.php'); ?>  
</div>
<!-- ./wrapper -->  
<?php require('plugin.inc.php'); ?>
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
