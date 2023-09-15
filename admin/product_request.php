<?php 
require('check.php');
$pageurl      = "product_request$extn";
$tblname      = "product_request";
$pagename     = "Product request";
$id           = @$_GET['id']; 
$pic_required = '';
$sessionid    = date("ymdHis"); 


$product_request_type    = get_safe_value($con,@$_POST['product_request_type']);

// INSERT INTO `product_request`(`product_request_id`, `request_staff_id`, `product_request_address`, `product_request_type`, `product_request_date`, `product_request_status`)

// Row Update Query 
 if(@$_GET['mode']=="update" && $id !=""){

  if($product_request_type == 2)
  {
    $sql="UPDATE `$tblname` SET `product_request_type`='$product_request_type' WHERE product_request_id =$id";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

      $sql_variation = "SELECT * FROM `product_request_variation`
      where product_request_variation.product_request_id = $id 
      ORDER BY product_request_variation.request_variation_id DESC";
      $result_variation = mysqli_query($con,$sql_variation);   
      $count_variation = mysqli_num_rows($result_variation);
      while($row_variation = mysqli_fetch_array($result_variation))
      {



      $sql_inventory = "SELECT * FROM `product_staff_inventory`
      where product_staff_inventory.staff_id = '".$row_variation['staff_id']."' and product_staff_inventory.product_id = '".$row_variation['product_id']."'
      ORDER BY product_staff_inventory.staff_inventory_id DESC";
      $result_inventory = mysqli_query($con,$sql_inventory);   
      $count_inventory = mysqli_num_rows($result_inventory);
      $row_inventory = mysqli_fetch_array($result_inventory);

      // exit;

      if($count_inventory > 0 )
      {
           $total_qty = $row_variation['request_staff_quantity'] + $row_inventory['staff_stock_qty'];

         $sql_update="UPDATE product_staff_inventory SET `staff_stock_qty`='$total_qty' WHERE staff_id ='".$row_variation['staff_id']."' and product_id = '".$row_variation['product_id']."' ";
        // exit;
       $result_update = mysqli_query($con,$sql_update);   

       // exit;

      }else{

          $sql_insert="INSERT INTO `product_staff_inventory`( `product_id`, `staff_id`, `staff_stock_qty`, `staff_sell_qty`, `staff_inventory_status`, `staff_inventory_date`) VALUES ('".$row_variation['product_id']."','".$row_variation['staff_id']."', '".$row_variation['request_staff_quantity']."','0',1,'".$cd."' )";
          // exit;
          $result_insert = mysqli_query($con,$sql_insert);   

        }

      }
      // exit;
  }else{
    $sql="UPDATE `$tblname` SET `product_request_type`='$product_request_type' WHERE product_request_id =$id";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

  }

  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $img_required ="";
  $sql = "SELECT * FROM `$tblname` WHERE product_request_id='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {

      $get_staff_id    = $row['request_staff_id'];
      $get_address   = $row['product_request_address'];
      $get_type    = $row['product_request_type'];
      $get_date = $row['product_request_date'];
 
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}


// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET product_request_status ='$status' WHERE product_request_id ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
   $sql = "DELETE FROM `$tblname` WHERE product_request_id='$id'";
//   $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}



//Select Query to display the records (join)
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category WHERE t1.hide='0' ORDER BY t1.ID DESC";

$sql = "SELECT * FROM `product_request`
LEFT JOIN staff on staff.ID=product_request.request_staff_id
ORDER BY product_request.product_request_id DESC";
$result = mysqli_query($con,$sql);   


//Select all code
$selectvariable = '';
if (@$_POST['action'] == 'Delete') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or staff_inventory_id = '", $ids);
  // $sql="DELETE FROM `$tblname` WHERE ID='$companyasend'";
  $sql="UPDATE `$tblname` SET hide ='1' WHERE staff_inventory_id='$companyasend'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Selected $pagename are deleted..'>";  exit(0);
}
else if (@$_POST['action'] == 'ON') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or staff_inventory_id = '", $ids);
  $sql="UPDATE `$tblname` SET status ='1' WHERE staff_inventory_id='$companyasend'";
  if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Status%20updated...'>"; exit(0);
} else if (@$_POST['action'] == 'OFF') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or staff_inventory_id = '", $ids);
  $sql="UPDATE `$tblname` SET status ='0' WHERE staff_inventory_id='$companyasend'";
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
          <h3 class="box-title text-blue">View <?php echo $pagename; ?></h3>

          <div class="box-tools pull-left">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus text-blue"></i></button>
          </div>
        </div>

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
                

                <div class="form-group col-md-4">
                  <label for="staff_id">Select Staff </label>
                  <select class="form-control" name="staff_id" disabled>
                    <option class="text-blue bold">Select Staff</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,name FROM `staff` where status=1 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_staff_id){
                          echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>


                <div class="form-group col-md-4">
                  <label for="title">Request Address <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="product_request_address" placeholder="Enter Address" value="<?= @$get_address; ?>" readonly>
                </div>

                <div class="form-group col-md-4">
                  <label for="title">Request Date <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="product_request_address" placeholder="Enter Address" value="<?= @$get_date; ?>" readonly>
                </div>

                <?php if(@$get_type == 3){ ?>

                <div class="form-group col-md-4">
                  <label for="type">Request Status </label>
                  <select name="product_request_type" id="product_request_type" class="form-control" disabled>
                    <option value="">Select Type</option>
                    <!-- 1=pending,2=accepted,3=rejected  -->
                    <option value="1" <?php if(@$get_type=="1"){?> selected="selected"<?php } ?>>Pending</option>
                    <option value="2" <?php if(@$get_type=="2"){?> selected="selected"<?php } ?>>Accepted</option>
                    <option value="3" <?php if(@$get_type=="3"){?> selected="selected"<?php } ?>>Rejected</option>
                  </select>
                </div>

                <?php }else{ ?>
                <div class="form-group col-md-4">
                  <label for="type">Request Status </label>
                  <select name="product_request_type" id="product_request_type" class="form-control" >
                    <option value="">Select Type</option>
                    <!-- 1=pending,2=accepted,3=rejected  -->
                    <option value="1" <?php if(@$get_type=="1"){?> selected="selected"<?php } ?>>Pending</option>
                    <option value="2" <?php if(@$get_type=="2"){?> selected="selected"<?php } ?>>Accepted</option>
                    <option value="3" <?php if(@$get_type=="3"){?> selected="selected"<?php } ?>>Rejected</option>
                  </select>
                </div>

              <?php } ?>
                
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


        <!-- /.box-header -->
        
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
          <table id="example1_samy" class="table table-bordered table-striped table-hover" style="text-align: center;">
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
                <th width="30">ID</th>
                <th width="50">staff Name</th>
                <th width="50">Request Address</th>
                <th width="20">Type</th>
                <th width="120">Date</th>
                <th width="20">Status</th>
                <th width="20"></th>
                <th width="20">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1;
               ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?= $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <td><?php echo $num; ?></td>

                <td style="text-align: left;"><?php echo $row['name']; ?></td>
                <td style="text-align: left;"><?php echo $row['product_request_address']; ?></td>
             

                <td style="text-align: left;"><?php if($row['product_request_type'] == 1){echo 'Pending';}else if($row['product_request_type'] == 2){echo 'Accepted';}else if($row['product_request_type'] == 3){echo 'Rejected';} ?></td>
                <td style="text-align: left;"><?php echo $row['product_request_date']; ?></td>
               
                <td>
                  <?php  
                    if($row['product_request_status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['product_request_id']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['product_request_id']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                
                <td><a href="<?= $baseurl.'/admin/product_request_variation'. $extn; ?>?id=<?= $row['product_request_id']; ?>" class="font-11"><i class="fa fa-eye"></i> View Details</a></td>
                
                
                <td>
                  <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['product_request_id'] ?>" title="Edit"><i class="fa fa-edit"></i>&nbsp;</a>
                  <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['product_request_id'] ?>&mode=delete" class="text-red" title="Delete"><i class="fa fa-trash-o"></i>&nbsp;</a>
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
<!-- <script type='text/javascript'>
 CKEDITOR.replace('details',{
  width :'98%', height:180,
  toolbar : [
['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
  filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
   }); 
</script> -->

