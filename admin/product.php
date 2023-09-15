<?php 
require('check.php');
$pageurl      = "product$extn";
$tblname      = "product";
$pagename     = "product";
$id           = @$_GET['id']; 
$product_image_required = '';
$sessionid    = date("ymdHis"); 


// Get POST Values
$product_name     = get_safe_value($con,@$_POST['product_name']);
$product_description    = get_safe_value($con,@$_POST['product_description']);



// Image Upload Code
$ext="";
if((!empty($_FILES["product_image"])) && ($_FILES['product_image']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['product_image']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "products-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/products/'.$newfilename.$ext;
  move_uploaded_file($_FILES['product_image']['tmp_name'],$newname);  
} 
if($ext==""){$product_image="";} else {$product_image="$newfilename$ext";} 

// Insert new entry Query
if(@$_GET['mode']=="addnew"){

  date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30)
  $date = date('Y-m-d');

  $sql = "INSERT INTO `$tblname`(`product_status`, `product_name`, `product_description`, `cdate`, `product_image`) VALUES ('1', '$product_name', '$product_description', '$date' , '$product_image')";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Service%20Added%20Successfully...'>";  exit(0);
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `product_name`='$product_name', `product_description`='$product_description' WHERE product_id =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["product_image"])) && ($_FILES['product_image']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['product_image']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "products-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/products/'.$newfilename.$ext;
  move_uploaded_file($_FILES['product_image']['tmp_name'],$newname);  
} 
  if($ext!=""){$product_image="$newfilename$ext";
    $sqlx="UPDATE `$tblname` SET `product_image`='$product_image' WHERE product_id='$id'"; 
    if (!mysqli_query($con,$sqlx)){die('Error: ' . mysqli_error($con)); } 
  } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}

// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET product_status ='$status' WHERE product_id ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
   $sql = "DELETE FROM `$tblname` WHERE product_id='$id'";
//   $sql="UPDATE `$tblname` SET hide ='1' WHERE product_id='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}

// feature Update Query




//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $product_image_required = '';
  $sql = "SELECT * FROM `$tblname` WHERE product_id='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
      // debug($row);
      $get_product_name      = $row['product_name'];
      $get_product_description     = $row['product_description'];
      $get_product_image      = $row['product_image'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category WHERE t1.hide='0' ORDER BY t1.ID DESC";

$sql = "SELECT t1.* FROM `$tblname` t1 
ORDER BY t1.product_id DESC";
$result = mysqli_query($con,$sql);   


//Select all code
$selectvariable = '';
if (@$_POST['action'] == 'Delete') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or product_id = '", $ids);
  // $sql="DELETE FROM `$tblname` WHERE product_id='$companyasend'";
  $sql="UPDATE `$tblname` SET hide ='1' WHERE product_id='$companyasend'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Selected $pagename are deleted..'>";  exit(0);
}
else if (@$_POST['action'] == 'ON') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or product_id = '", $ids);
  $sql="UPDATE `$tblname` SET product_status ='1' WHERE product_id='$companyasend'";
  if (!mysqli_query($con,$sql)) {die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Status%20updated...'>"; exit(0);
} else if (@$_POST['action'] == 'OFF') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or product_id = '", $ids);
  $sql="UPDATE `$tblname` SET product_status ='0' WHERE product_id='$companyasend'";
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
                

                

                <div class="form-group col-md-12">
                  <label for="title">Product Name <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="<?= @$get_product_name; ?>" required autocomplete="off">
                </div>
                
                
                          
                <div class="form-group col-md-12">
                  <label for="product_description">Description <span class="text-red">*</span></label>
                  
                  <textarea id="tinyeditor1" name="product_description" rows="5" class="form-control" placeholder="Enter Description"><?= @$get_product_description; ?></textarea>
                </div> 
                <!-- <div class="form-group col-md-12">
                  <label for="short_description">Long Description <span class="text-red">*</span></label>
                  <textarea id="tinyeditor" name="long_description" rows="5" class="form-control" placeholder="Enter Long Description"><?= @$get_long_desc; ?></textarea>
                </div>  -->
                


                <div class="form-group col-md-6">
                  <label for="product_image"> <span class="text-red">Upload only Image (size : 400 * 265)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="product_image" id="product_image" class="img" style="width:250px;" <?= $product_image_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'products/'.$get_product_image; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                <th width="50">Status</th>
                <th width="150">Product Name</th>
                <th width="20">Img</th>
                <th width="20"></th>
                <th width="20">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1;
                $product_image = ($row['product_image']!="") ? $row['product_image'] : "noimg.webp";
               ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?= $row['product_id'] ?>" style="cursor:pointer;"></td> -->
                <td><?php echo $num; ?></td>
                
                
                <td>
                  <?php  
                    if($row['product_status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['product_id']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['product_id']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                
                <td style="text-align: left;"><?php echo $row['product_name']; ?></td>
                
                <td align="center">
                <?php if($row['product_image'] !=""){ ?>
                  <a href="<?= UPLOAD_PATH.'products/'.$product_image; ?>" target="_blank">
                    <img src="<?= UPLOAD_PATH.'products/'.$product_image; ?>" width="50" height="50" style="border-radius:10%;">
                  </a>
                <?php } ?>
                </td>
                
                <td><a href="<?= $baseurl.'/admin/product_request'. $extn; ?>?product_id=<?= $row['product_id']; ?>" class="font-11"><i class="fa fa-eye"></i> View Details</a></td>

                <td>
                  <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['product_id'] ?>" title="Edit"><i class="fa fa-edit"></i>&nbsp;</a>
                  <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['ID'] ?>&mode=delete" class="text-red" title="Delete"><i class="fa fa-trash-o"></i>&nbsp;</a>
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




