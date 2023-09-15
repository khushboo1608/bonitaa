<?php
require('check.php');
$pageurl = "staff$extn";
$pagename = "Staff";
$tblname = "staff";
$id = @$_GET['id'];
$img_required = 'required';

// Get POST Values
// $CID       = get_safe_value($con,@$_POST['category_id']);
$stafffullname = get_safe_value($con,@$_POST['staff_fullname']);
$staffmobile   = get_safe_value($con,@$_POST['staff_mobile']);
$staffemail    = get_safe_value($con,@$_POST['staff_email']);
$staffpass     = get_safe_value($con,@$_POST['staff_pass']);
$staffcity     = get_safe_value($con,@$_POST['staff_city']);
$staffaddress     = get_safe_value($con,@$_POST['staff_address']);
$staffholdername     = get_safe_value($con,@$_POST['holder_name']);
$staffaccountnumber     = get_safe_value($con,@$_POST['account_number']);
$staffifsccode     = get_safe_value($con,@$_POST['ifsc_code']);
$sessionid = date('YmdHis');


// Image Upload Code
// $ext="";
// if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
//   $filename    = strtolower(basename($_FILES['dp']['name']));
//   $ext         = substr($filename, strrpos($filename, '.') + 1);
//   $namefile    = str_replace(".$ext","", $filename);
//   $newfilename = "staff-".date("ymdHis");
//   //Determine the path to which we want to save this file
//   $ext=".".$ext;
//   $newname = '../uploads/staff/'.$newfilename.$ext;
//   move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
// } 
// if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  


        

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
    
     if($_FILES['image_url']['name']!="")
        {
            $filename = rand(0,99999)."_". $_FILES["image_url"]["name"]; 
            $tempname = $_FILES["image_url"]["tmp_name"];     
            $folder = "../uploads/staff/".$filename; 
            move_uploaded_file($tempname, $folder);
        }else{
            $filename = "";
        }
        
        if($_FILES['bb_id_card1']['name']!="")
        {
            $filename2 = rand(0,99999)."_". $_FILES["bb_id_card1"]["name"]; 
            $tempname2 = $_FILES["bb_id_card1"]["tmp_name"];     
            $folder2 = "../uploads/staff/".$filename2; 
            move_uploaded_file($tempname2, $folder2);
        }else{
            $filename2 = "";
        }
        
        if($_FILES['bb_id_card2']['name']!="")
        {
            $filename3 = rand(0,99999)."_". $_FILES["bb_id_card2"]["name"]; 
            $tempname3 = $_FILES["bb_id_card2"]["tmp_name"];     
            $folder3 = "../uploads/staff/".$filename3; 
            move_uploaded_file($tempname3, $folder3);
        }else{
            $filename3 = "";
        }
        
        if($_FILES['adhar_card1']['name']!="")
        {
            $filename4 = rand(0,99999)."_". $_FILES["adhar_card1"]["name"]; 
            $tempname4 = $_FILES["adhar_card1"]["tmp_name"];     
            $folder4 = "../uploads/staff/".$filename4; 
            move_uploaded_file($tempname4, $folder4);
        }else{
            $filename4 = "";
        }
        
        if($_FILES['adhar_card2']['name']!="")
        {
            $filename5 = rand(0,99999)."_". $_FILES["adhar_card2"]["name"]; 
            $tempname5 = $_FILES["adhar_card2"]["tmp_name"];     
            $folder5 = "../uploads/staff/".$filename5; 
            move_uploaded_file($tempname5, $folder5);
        }else{
            $filename5 =  "";
        }
        
        if($_FILES['pan_card1']['name']!="")
        {
            $filename6 = rand(0,99999)."_". $_FILES["pan_card1"]["name"]; 
            $tempname6 = $_FILES["pan_card1"]["tmp_name"];     
            $folder6 = "../uploads/staff/".$filename6; 
            move_uploaded_file($tempname6, $folder6);
        }else{
            $filename6 = "";
        }

  // check for duplicate entry is there or not
  $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE mobile='$staffmobile' ");
  $check = mysqli_num_rows($sql);
  if($check>0){
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=Staff mobile number is already exist...'>";  exit(0);
  }else{
    $sql = "INSERT INTO `$tblname`(`status`,`name`, `email`, `mobile`, `password`,`city_id`, `dp`,`address` ,`bb_id_card1`,`bb_id_card2`,`adhar_card1`,`adhar_card2`,`pan_card1`,`holder_name`,`account_number`,`ifsc_code`,`sessionid`, `ip`) 
    VALUES ('1','$stafffullname', '$staffemail', '$staffmobile', '$staffpass','$staffcity', '$filename','$staffaddress', '$filename2' , '$filename3' , '$filename4' ,'$filename5' , '$filename6','$staffholdername','$staffaccountnumber' ,'$staffifsccode', '$sessionid', '$ipa')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Staff%20Created%20Successfully...'>";  exit(0);
  }
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
  $img_required ="";
  
  
        $qry="SELECT * FROM `$tblname` where ID='$id' ";
        $result=mysqli_query($con,$qry);
        $row1=mysqli_fetch_assoc($result);
        $num_rows = mysqli_num_rows($result);
          
          

	    if($_FILES['image_url']['name']!="")
        {
            $staff_image = rand(0,99999)."_". $_FILES["image_url"]["name"]; 
            $tempname = $_FILES["image_url"]["tmp_name"];     
            $folder = "../uploads/staff/".$staff_image; 
            move_uploaded_file($tempname, $folder);
        }else{
            $staff_image = $row1['dp'];
        }
        
        if($_FILES['bb_id_card1']['name']!="")
        {
            $filename2 = rand(0,99999)."_". $_FILES["bb_id_card1"]["name"]; 
            $tempname2 = $_FILES["bb_id_card1"]["tmp_name"];     
            $folder2 = "../uploads/staff/".$filename2; 
            
            move_uploaded_file($tempname2, $folder2);
        }else{
            $filename2 = $row1['bb_id_card1'];
        }
        
        if($_FILES['bb_id_card2']['name']!="")
        {
            $filename3 = rand(0,99999)."_". $_FILES["bb_id_card2"]["name"]; 
            $tempname3 = $_FILES["bb_id_card2"]["tmp_name"];     
            $folder3 = "../uploads/staff/".$filename3; 
            move_uploaded_file($tempname3, $folder3);
        }else{
            $filename3 = $row1['bb_id_card2'];
        }
        
        if($_FILES['adhar_card1']['name']!="")
        {
            $filename4 = rand(0,99999)."_". $_FILES["adhar_card1"]["name"]; 
            $tempname4 = $_FILES["adhar_card1"]["tmp_name"];     
            $folder4 = "../uploads/staff/".$filename4; 
            move_uploaded_file($tempname4, $folder4);
        }else{
            $filename4 = $row1['adhar_card1'];
        }
        
        if($_FILES['adhar_card2']['name']!="")
        {
            $filename5 = rand(0,99999)."_". $_FILES["adhar_card2"]["name"]; 
            $tempname5 = $_FILES["adhar_card2"]["tmp_name"];     
            $folder5 = "../uploads/staff/".$filename5; 
            move_uploaded_file($tempname5, $folder5);
        }else{
            $filename5 =  $row1['adhar_card2'];
        }
        
        if($_FILES['pan_card1']['name']!="")
        {
            $filename6 = rand(0,99999)."_". $_FILES["pan_card1"]["name"]; 
            $tempname6 = $_FILES["pan_card1"]["tmp_name"];     
            $folder6 = "../uploads/staff/".$filename6; 
            move_uploaded_file($tempname6, $folder6);
        }else{
            $filename6 = $row1['pan_card1'];
        }

    
        // echo $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE mobile='$staffmobile' and ID != '".$id."' ");
        
        $qry="SELECT * FROM `$tblname` WHERE mobile='$staffmobile' and ID != '".$id."' ";
        $result=mysqli_query($con,$qry);
        $check = mysqli_num_rows($result);
        if($check>0){
          echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=Staff mobile number is already exist...'>";  exit(0);
        }else{
     $sql="UPDATE `$tblname` SET `name`='$stafffullname', `email`='$staffemail', `mobile`='$staffmobile', `password`='$staffpass',`city_id`='$staffcity',`address`='$staffaddress',`holder_name`='$staffholdername',`account_number`='$staffaccountnumber',`ifsc_code`='$staffifsccode',`dp`='$staff_image',`bb_id_card1`='$filename2',`bb_id_card2`='$filename3',`adhar_card1`='$filename4',`adhar_card2`='$filename5',`pan_card1`='$filename6'
    WHERE ID = '".$id."' ";
  
//   exit;
  
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
        
        
        // $sqlx8= "UPDATE `$tblname` SET `dp`='$filename',`bb_id_card1`='$filename2',`bb_id_card2`='$filename3',`adhar_card1`='$filename4',`adhar_card2`='$filename5',`pan_card1`='$filename6' WHERE ID='$id' ";  
       
    //   exit;
    
        //if (!mysqli_query($con,$sqlx8)){die('Error: ' . mysqli_error($con)); }             

        echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}
}


// Delete Query
if(@$_GET['mode']=="delete" && $id !=""){
  $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  // $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Staff%20Deleted%20successfully...'>";  exit(0);
}
// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Staff%20Status%20updated%20Successfully !!'>"; exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $img_required ="";
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
      $get_fullname = $row['name'];
      $get_mobile   = $row['mobile'];
      $get_email    = $row['email'];
      $get_userpass = $row['password'];
      $get_address = $row['address'];
      $get_pic      = $row['dp'];
      $get_city      = $row['city_id'];
      $get_bb_id_card1      = $row['bb_id_card1'];
      $get_bb_id_card2      = $row['bb_id_card2'];
      $get_adhar_card1      = $row['adhar_card1'];
      $get_adhar_card2      = $row['adhar_card2'];
      $get_pan_card1      = $row['pan_card1'];
      
      $get_holder_name      = $row['holder_name'];
      $get_account_number      = $row['account_number'];
      $get_ifsc_code      = $row['ifsc_code'];

    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}


//Select Query to display the records
$sql    = "SELECT *,c.name as cityname,s.ID,s.status,s.name as staffname FROM `$tblname` s
left join city c on c.ID = s.city_id
ORDER BY s.ID desc";
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
                <div class="form-group col-md-6">
                  <label> Full Name <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="staff_fullname" value="<?= @$get_fullname; ?>" placeholder="Enter Staff Full Name" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Mobile No<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="staff_mobile" value="<?= @$get_mobile; ?>" placeholder="Enter Staff Mobile No." required>
                </div>
                <div class="form-group col-md-6">
                  <label>Email ID<span class="em font-12">(Optional)</span></label>
                  <input type="email" class="form-control" name="staff_email" value="<?= @$get_email; ?>" placeholder="Enter Staff Email ID">
                </div>
                <div class="form-group col-md-6">
                  <label>Password<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="staff_pass" value="<?= @$get_userpass; ?>" placeholder="Enter Staff Password" required>
                </div>

                <div class="form-group col-md-6">
                  <label>Address<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="staff_address" value="<?= @$get_address; ?>" placeholder="Enter Staff Address" required>
                </div>
                
                <div class="form-group col-md-6">
                  <label>Account Holder Name<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="holder_name" value="<?= @$get_holder_name; ?>" placeholder="Enter Account Holder name" required>
                </div>
                
                <div class="form-group col-md-6">
                  <label>Account Number<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="account_number" value="<?= @$get_account_number; ?>" placeholder="Enter Account number" required>
                </div>
                
                <div class="form-group col-md-6">
                  <label>IFSC Code<span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="ifsc_code" value="<?= @$get_ifsc_code; ?>" placeholder="Enter IFSC code" required>
                </div>
                
                

                <div class="form-group col-md-6">
                  <label for="staff_city">Select City <span class="text-red">*</span></label>
                  <select class="form-control" name="staff_city" id="staff_city" required>
                    <option class="text-blue bold">Select City</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,name FROM `city` ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_city){
                          echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
              <div class="box-body">
                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">Cover Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="image_url" id="image_url" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_pic; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
                <?php } ?>
              </div>

                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">BB ID Card Front Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="bb_id_card1" id="bb_id_card1" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_bb_id_card1; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
                <?php } ?>

                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">BB ID Card Back Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="bb_id_card2" id="bb_id_card2" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_bb_id_card2; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
                <?php } ?>




                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">Adhar Card Front Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="adhar_card1" id="adhar_card1" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_adhar_card1; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
                <?php } ?>

                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">Adhar Card Back Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="adhar_card2" id="adhar_card2" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_adhar_card2; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
                <?php } ?>





                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">Pan Card Front Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="pan_card1" id="pan_card1" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'staff/'.$get_pan_card1; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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

      
        <div class="<?php echo $boxcolor; ?>">
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
                        <button name="action" value="Delete" id="on_off_btn" title="Delete" onClick="return verifCompare();"><img src="dist/img/delete.png" title="Click to Delete" /></button> &nbsp;
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <!-- <td width="10"><input type='checkbox' id='selectall' title='Select All' style='cursor:pointer;'/></td></td> -->
                    <th width="10">S.NO</th>
                    <th width="30">Status</th>
                    <th width="50">Name</th>
                    <!-- <th>Login info</th> -->
                    <th width="150">Info</th>
                    <th width="50">City Name</th>
                    <th width="50">Img</th>
                    <th width="20">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1; ?>
                  <tr>
                    <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td> -->
                    <td><?php echo $num; ?></td>
                    <td align="center">
                      <?php
                      if($row['status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                      }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                      }
                      ?>
                    </td>
                    <td align="left"><?php echo $row['staffname']; ?></td>
                    <td align="left">
                      <i class="fa fa-envelope text-blue"></i> <span class="text-blue bold"><?php echo $row['email']; ?></span><br>
                      <i class="fa fa-phone text-red"></i><span class="text-red"> <?php echo $row['mobile']; ?></span><br>
                      <i class="fa fa-key text-green"></i><span title="User Password" class="text-green bold"> <?php echo $row['password']; ?></span>
                    </td>
                    <td align="left"><?php echo $row['cityname']; ?></td>
                    <td align="center">
                    <?php if($row['dp'] !=""){ ?>
                      <img src="<?= UPLOAD_PATH.'staff/'.$row['dp']; ?>" width="50" height="50" style="border-radius:10%;">
                    <?php } ?>
                    </td>
                    
                    <!-- <td align="left"><?php echo $row['createdon']; ?><br><span style="font-style: italic; color: green;">IP: <?php echo $row['ip']; ?></span></td> -->
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