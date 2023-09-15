<?php 
require('check.php');
$pageurl = "locations$extn";
$tblname = "location";
$pagename = "Location";
$id = @$_GET['id']; 
$img_required = '';

// Get POST Values
$state = get_safe_value($con,@$_POST['state']);
$city  = get_safe_value($con,@$_POST['city']);

// Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "location-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/location/'.$newfilename.$ext;
  move_uploaded_file($_FILES['cover_img']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  

// Insert new entry Query
if(@$_GET['mode']=="addnew"){

  // check for duplicate entry is there or not
  $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE city='$city'");
  $check = mysqli_num_rows($sql);
  if($check>0){
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=$pagename Already Exist...'>";  exit(0);
  }else{
    $sql = "INSERT INTO `$tblname`(`state`, `city`, `pic`, `createdon`, `rd`, `date`, `time`) 
    VALUES ('$state', '$city', '$pic', '$now', '$rd', '$dd', '$dt')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Added%20Successfully...'>";  exit(0);
  }
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `state`='$state', `city`='$city', `modifiedon`='$now' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "location-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/location/'.$newfilename.$ext;
  move_uploaded_file($_FILES['cover_img']['tmp_name'],$newname);  
} 
  if($ext!=""){$pic="$newfilename$ext";
    $sqlx="UPDATE `$tblname` SET `pic`='$pic' WHERE ID='$id'"; 
    if (!mysqli_query($con,$sqlx)){die('Error: ' . mysqli_error($con)); } 
  } 
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
  // $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $img_required ="";
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id' ";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
      echo $get_state = $row['state'];
      $get_city  = $row['city'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT $tblname.*, courses.title FROM $tblname, courses WHERE $tblname.course_id=courses.ID ORDER BY $tblname.ID desc";
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category_id WHERE t1.hide='0' ORDER BY t1.ID DESC";
$sql = "SELECT * FROM `$tblname` WHERE hide='0' ORDER BY ID DESC";
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
                <div class="form-group">
                  <label for="state">Select State <span class="text-red">*</span></label>
                  <select name="state" id="state" class="form-control">
                    <option value="">Select State</option>
                    <option value="Andhra Pradesh" <?php if($get_state=="Andhra Pradesh"){ echo 'selected'; } ?> >Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands" <?php if($get_state=="Andaman and Nicobar Islands"){?> selected="selected"<?php } ?>>Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh" <?php if($get_state=="Arunachal Pradesh"){?> selected="selected"<?php } ?>>Arunachal Pradesh</option>

                    <option value="Assam" <?php if($get_state=="Assam"){?> selected="selected"<?php } ?>>Assam</option>
                    <option value="Bihar" <?php if($get_state=="Bihar"){?> selected="selected"<?php } ?>>Bihar</option>
                    <option value="Chandigarh" <?php if($get_state=="Chandigarh"){?> selected="selected"<?php } ?>>Chandigarh</option>
                    <option value="Chhattisgarh" <?php if($get_state=="Chhattisgarh"){?> selected="selected"<?php } ?>>Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli" <?php if($get_state=="Dadar and Nagar Haveli"){?> selected="selected"<?php } ?>>Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu" <?php if($get_state=="Daman and Diu"){?> selected="selected"<?php } ?>>Daman and Diu</option>
                    <option value="Delhi" <?php if($get_state=="Delhi"){?> selected="selected"<?php } ?>>Delhi</option>
                    <option value="Lakshadweep" <?php if($get_state=="Lakshadweep"){?> selected="selected"<?php } ?>>Lakshadweep</option>
                    <option value="Puducherry" <?php if($get_state=="Puducherry"){?> selected="selected"<?php } ?>>Puducherry</option>
                    <option value="Goa" <?php if($get_state=="Goa"){?> selected="selected"<?php } ?>>Goa</option>
                    <option value="Gujarat" <?php if($get_state=="Gujarat"){?> selected="selected"<?php } ?>>Gujarat</option>
                    <option value="Haryana" <?php if($get_state=="Haryana"){?> selected="selected"<?php } ?>>Haryana</option>
                    <option value="Himachal Pradesh" <?php if($get_state=="Himachal Pradesh"){?> selected="selected"<?php } ?>>Himachal Pradesh</option>
                    <option value="Jammu and Kashmir" <?php if($get_state=="Jammu and Kashmir"){?> selected="selected"<?php } ?>>Jammu and Kashmir</option>
                    <option value="Jharkhand" <?php if($get_state=="Jharkhand"){?> selected="selected"<?php } ?>>Jharkhand</option>
                    <option value="Karnataka" <?php if($get_state=="Karnataka"){?> selected="selected"<?php } ?>>Karnataka</option>
                    <option value="Kerala" <?php if($get_state=="Kerala"){?> selected="selected"<?php } ?>>Kerala</option>
                    <option value="Madhya Pradesh" <?php if($get_state=="Madhya Pradesh"){?> selected="selected"<?php } ?>>Madhya Pradesh</option>
                    <option value="Maharashtra" <?php if($get_state=="Maharashtra"){?> selected="selected"<?php } ?>>Maharashtra</option>
                    <option value="Manipur" <?php if($get_state=="Manipur"){?> selected="selected"<?php } ?>>Manipur</option>
                    <option value="Meghalaya" <?php if($get_state=="Meghalaya"){?> selected="selected"<?php } ?>>Meghalaya</option>
                    <option value="Mizoram" <?php if($get_state=="Mizoram"){?> selected="selected"<?php } ?>>Mizoram</option>
                    <option value="Nagaland" <?php if($get_state=="Nagaland"){?> selected="selected"<?php } ?>>Nagaland</option>
                    <option value="Odisha" <?php if($get_state=="Odisha"){?> selected="selected"<?php } ?>>Odisha</option>
                    <option value="Punjab" <?php if($get_state=="Punjab"){?> selected="selected"<?php } ?>>Punjab</option>
                    <option value="Rajasthan" <?php if($get_state=="Rajasthan"){?> selected="selected"<?php } ?>>Rajasthan</option>
                    <option value="Sikkim" <?php if($get_state=="Sikkim"){?> selected="selected"<?php } ?>>Sikkim</option>
                    <option value="Tamil Nadu" <?php if($get_state=="Tamil Nadu"){?> selected="selected"<?php } ?>>Tamil Nadu</option>
                    <option value="Telangana" <?php if($get_state=="Telangana"){?> selected="selected"<?php } ?>>Telangana</option>
                    <option value="Tripura" <?php if($get_state=="Tripura"){?> selected="selected"<?php } ?>>Tripura</option>
                    <option value="Uttar Pradesh" <?php if($get_state=="Uttar Pradesh"){?> selected="selected"<?php } ?>>Uttar Pradesh</option>
                    <option value="Uttarakhand" <?php if($get_state=="Uttarakhand"){?> selected="selected"<?php } ?>>Uttarakhand</option>
                    <option value="West Bengal" <?php if($get_state=="West Bengal"){?> selected="selected"<?php } ?>>West Bengal</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">City <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="city" value="<?= @$get_city; ?>" autocomplete="off" placeholder="Enter City Name">
                </div>
                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">City Image (Size: 250x250px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="cover_img" id="cover_img" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
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
                <th width="40">Status</th>
                <th width="80">Img</th>
                <th>City</th>
                <th>State</th>
                <th width="200">Created by</th>
                <th width="20">#</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; 
              while($row=mysqli_fetch_array($result)){ $num=$num+1; 
                $cpic = ($row['pic']!="") ? $row['pic'] : "noimg.webp";
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
                <td align="center">
                  <a href="<?= UPLOAD_PATH.'location/'.$cpic; ?>" target="_blank">
                  <img src="<?= UPLOAD_PATH.'location/'.$cpic; ?>" width="50" height="50" style="border-radius:10%;"></a>
                </td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['state']; ?></td>
                <td title="Modified on: <?php echo $row['modifiedon']; ?>"><?php echo formatDate($row['createdon']); ?></td>
                <td>
                  <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['ID'] ?>" title="Edit"><i class="fa fa-edit"></i>&nbsp;</a>
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