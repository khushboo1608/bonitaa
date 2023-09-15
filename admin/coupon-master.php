<?php 
require('check.php');
$pageurl = "coupon-master$extn";
$tblname = "coupon_master";
$pagename = "Coupon";
$id = @$_GET['id']; 
$img_required = '';

// Get POST Values
$CID       = get_safe_value($con,@$_POST['category_id']);
$cname     = get_safe_value($con,@$_POST['coupon_name']);
$ccode    = get_safe_value($con,@$_POST['coupon_promocode']);
$cminamount     = get_safe_value($con,@$_POST['coupon_minamount']);
$cmaxamount = get_safe_value($con,@$_POST['coupon_maxamount']);
$ctype = get_safe_value($con,@$_POST['coupon_type']);
$cperuser = get_safe_value($con,@$_POST['coupon_peruser']);
$cprice = get_safe_value($con,@$_POST['coupon_price']);
$csdate = get_safe_value($con,@$_POST['coupon_start_date']);
$cedate = get_safe_value($con,@$_POST['coupon_end_date']);

// Insert new entry Query
if(@$_GET['mode']=="addnew"){

  // check for duplicate entry is there or not
  $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE coupon_promocode='$ccode'");
  $check = mysqli_num_rows($sql);
  if($check>0){
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=$pagename Already Exist...'>";  exit(0);
  }else{

    $sql = "INSERT INTO `$tblname`(`status`, `category_id`, `coupon_name`, `coupon_promocode`, `coupon_minamount`, `coupon_maxamount`, `coupon_type`, `coupon_peruser`, `coupon_price`, `coupon_start_date`, `coupon_end_date`)

    VALUES ('1','0', '$cname','$ccode','$cminamount','$cmaxamount','$ctype','$cperuser','$cprice', '$csdate', '$cedate')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Created%20Successfully...'>";  exit(0);
  }
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `category_id`='0', `coupon_name`='$cname', `coupon_promocode`='$ccode', `coupon_minamount`='$cminamount', `coupon_maxamount`='$cmaxamount', `coupon_type`='$ctype', `coupon_peruser`='$cperuser', `coupon_price`='$cprice', `coupon_start_date`='$csdate', `coupon_end_date`='$cedate'
   WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}

// Status Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
}


// Delete OR hide Query
else if(@$_GET['mode']=="delete" && $id !=""){
   $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  //$sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $img_required ="";
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
    //INSERT INTO `coupon_master`(`ID`, `status`, `category_id`, `coupon_name`, `coupon_promocode`, `coupon_minamount`, `coupon_maxamount`, `coupon_type`, `coupon_peruser`, `coupon_price`, `coupon_start_date`, `coupon_end_date`)

      $get_ccid     = $row['category_id'];
      $get_cname     = $row['coupon_name'];
      $get_ccode     = $row['coupon_promocode'];
      $get_cminamount     = $row['coupon_minamount'];
      $get_cmaxamount     = $row['coupon_maxamount'];
      $get_ctype     = $row['coupon_type'];
      $get_cperuser     = $row['coupon_peruser'];
      $get_cprice    = $row['coupon_price'];
      $get_csdate     = $row['coupon_start_date'];
      $get_cedate = $row['coupon_end_date'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records
$sql = "SELECT *,c.ID,c.status,cat.category as catname FROM `$tblname` c
LEFT JOIN category cat ON cat.ID = c.category_id
ORDER BY c.ID DESC";
$result = mysqli_query($con,$sql);   


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
else if (@$_POST['action'] == 'ON') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or ID = '", $ids);
  $sql="UPDATE `$tblname` SET status ='1' WHERE ID='$companyasend'";
  if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Status%20updated...'>"; exit(0);
} else if (@$_POST['action'] == 'OFF') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or ID = '", $ids);
  $sql="UPDATE `$tblname` SET status ='0' WHERE ID='$companyasend'";
  if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Status%20updated...'>";   exit(0);}
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

      <!-- SELECT2 EXAMPLE -->
      <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { $add_edit = "Edit"; ?>
      <div class="<?= $boxcolor; ?>">
      <?php }else{ $add_edit = "Add"; ?>
      <div class="<?= $boxcolor; ?> collapsed-box">
      <?php } ?>
        <div class="box-header with-border" data-widget="collapse" style="cursor: pointer;">
          <h3 class="box-title text-blue"><?= $add_edit; ?> <?php echo $pagename; ?></h3>

          <div class="box-tools pull-left">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus text-blue"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <!-- form start -->
            <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
            <form role="form" method="POST" action="<?= $pageurl; ?>?mode=update&id=<?= @$_GET['id'] ?>" enctype="multipart/form-data">
            <?php } else {?>
            <form role="form" method="POST" action="<?= $pageurl; ?>?mode=addnew" enctype="multipart/form-data">
            <?php } ?>
              <div class="box-body">

                <!--<div class="form-group col-md-6">-->
                <!--  <label for="category_id">Category <span class="text-red">*</span></label>-->
                <!--  <select class="form-control" name="category_id" required id="category_id">-->
                <!--    <option class="text-blue bold">Select Category</option>-->
                    <?php  
                    //   $res = mysqli_query($con,"SELECT ID,category FROM `category` ORDER BY ID ASC");
                    //   while ($row = mysqli_fetch_array($res)) {
                    //     // echo 'c_id:'.$get_cid;
                    //     if($row['ID']==$get_ccid){
                    //       echo "<option selected value=".$row['ID'].">".$row['category']."</option>";  
                    //     }
                    //     else{
                    //       echo "<option value=".$row['ID'].">".$row['category']."</option>";
                    //     }
                    //   }
                    ?>
                <!--  </select>-->
                <!--</div>-->


                <div class="form-group col-md-6">
                  <label>Coupon Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coupon_name" value="<?= @$get_cname; ?>" placeholder="Enter Title">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon Code <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coupon_promocode" value="<?= @$get_ccode; ?>" placeholder="Enter Coupon Code">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon Min Amount<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coupon_minamount" value="<?= @$get_cminamount; ?>" placeholder="Enter Coupon Minimum Value">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon Max Amount<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coupon_maxamount" value="<?= @$get_cmaxamount; ?>" placeholder="Enter Coupon Maximum Value">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon Price<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coupon_price" value="<?= @$get_cprice; ?>" placeholder="Enter Coupon Price">
                </div>

                <div class="form-group col-md-6">
                  <label for="type">Coupon Type <span class="text-red">*</span></label>
                  <select name="coupon_type" class="form-control">
                    <option value="">Select Coupon Type</option>
                    <option value="1" <?php if(@$get_ctype=="1"){?> selected="selected"<?php } ?>>Percentage</option>
                    <option value="2" <?php if(@$get_ctype=="2"){?> selected="selected"<?php } ?>>Price</option>
                  </select>
                </div>


                <div class="form-group col-md-6">
                  <label>Coupon Per User<span class="text-red">*</span></label>
                  <input type="number" class="form-control" name="coupon_peruser" value="<?= @$get_cperuser; ?>" placeholder="Enter Coupon Per User">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon Start Date<span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="coupon_start_date" value="<?= @$get_csdate; ?>" placeholder="Select Start Date">
                </div>

                <div class="form-group col-md-6">
                  <label>Coupon End Date<span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="coupon_end_date" value="<?= @$get_cedate ; ?>" placeholder="Select End Date">
                </div>



              </div>
              <!-- /.box-body -->
              <div align="right" class="box-footer">
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <button type="submit" class="<?= $btncolor; ?>"><i class="fa fa-save"></i>&nbsp; Update</button>
                <?php }else{ ?>
                <button type="submit" class="<?= $btncolor; ?>"><i class="fa fa-save"></i>&nbsp; Save</button>
                <?php } ?>
              </div>
            </form>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <div class="box">
        <div class="box-body table-responsive no-padding" style="padding: 10px!important;">
        <?php  
          echo displayMsg(@$_GET['msg']);
          echo dangerMsg(@$_GET['msgdanger']);
          echo dupl_msg(@$_GET['dupl_msg']);
        ?>
        <form name="delete" id="frmCompare" class="frmCompare" action="" method="post"> 
          <table id="example1_samy" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <td width="45"> 
                  <div id="btnCompare" style="display: none; margin: 0px -9px;">
                    <button name="action" value="ON" id="on_off_btn" title="Status ON" onClick="return verifCompare();"><img src="dist/img/green.png" title="Click to Activate" data-toggle='tooltip' /></button>&nbsp;
                    <button name="action" value="OFF" id="on_off_btn" title="Status OFF" onClick="return verifCompare();"><img src="dist/img/red.png" name="action"  style="cursor:pointer" value="OFF" title="Click to Deactivate" data-toggle='tooltip' /></button>&nbsp;
                    <button name="action" value="Delete" id="on_off_btn" title="Delete" onClick="return verifCompare();"><img src="dist/img/delete.png" title="Click to Delete" /></button> &nbsp;
                  </div>
                </td>
              </tr>
              <tr>
                <!-- <td><input type='checkbox' id='selectall' title='Select All' style='cursor:pointer;'/></td></td> -->
                <th align="center" width="20">ID</th>
                <th width="20">Status</th>
                <!--<th width="20">Category Name</th>-->
                <th width="20">Coupon Name</th>
                <th width="20">Coupon Code</th>
                <th width="150">Coupon Price</th>
                <th width="150">Coupon Start Date</th>
                <th width="100">Coupon End Date</th>
                <th width="120">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; 
              while($row=mysqli_fetch_array($result)){ $num=$num+1; 
                ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <th align="center"><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                <!--<td align="left"><?= $row['catname']; ?></td>-->
                <td align="left"><?= $row['coupon_name']; ?></td>
                <td align="left"><?= $row['coupon_promocode']; ?></td>
                <td align="center"><?= RS.$row['coupon_price']; ?></td>
                <td align="left"><?= $row['coupon_start_date']; ?></td>
                <td align="left"><?= $row['coupon_end_date']; ?></td>
                <td>
                  <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['ID'] ?>" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit </a>
                  <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['ID'] ?>&mode=delete" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i> Delete</a>
                </td>
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