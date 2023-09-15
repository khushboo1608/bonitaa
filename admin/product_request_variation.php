<?php 
require('check.php');
$pageurl      = "product_request_variation$extn";
$tblname      = "product_request_variation";
$pagename     = "Product request variation";
$id           = @$_GET['id']; 
$pic_required = '';
$sessionid    = date("ymdHis"); 



// Statue Update Query
 if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET request_variation_status ='$status' WHERE request_variation_id ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
   $sql = "DELETE FROM `$tblname` WHERE request_variation_id = '$id'";
//   $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}



//Select Query to display the records (join)
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category WHERE t1.hide='0' ORDER BY t1.ID DESC";

$sql = "SELECT * FROM `product_request_variation`
    LEFT JOIN staff on staff.ID=product_request_variation.staff_id
    LEFT JOIN product on product.product_id=product_request_variation.product_id
    where product_request_variation.product_request_id = '".$_GET['id']."'
ORDER BY product_request_variation.request_variation_id DESC";
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse"></button>
          </div>
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
                <th width="50">Product Name</th>
                <th width="20">Product Quantity</th>
                <th width="120">Date</th>
                <th width="20">Status</th>
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
                <td style="text-align: left;"><?php echo $row['product_name']; ?></td>
                <td style="text-align: left;"><?php echo $row['request_staff_quantity']; ?></td>
             

                <td style="text-align: left;"><?php echo $row['request_variation_date']; ?></td>
               
                <td>
                  <?php  
                    if($row['request_variation_status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['request_variation_id']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['request_variation_id']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                
                
                
                
                <td>
                  <!-- <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['request_variation_id'] ?>" title="Edit"><i class="fa fa-edit"></i>&nbsp;</a> -->
                  <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['request_variation_id'] ?>&mode=delete" class="text-red" title="Delete"><i class="fa fa-trash-o"></i>&nbsp;</a>
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

