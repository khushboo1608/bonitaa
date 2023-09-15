<?php 
require('check.php');
$pageurl = "changepassword$extn";
$pagename = "Change Password";
$tblname = "admin";
$id = @$_GET['id']; 


//Select Query to display the records
$sql    = "SELECT * FROM `$tblname`";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
  $expassword=$row['password']; 
}

if(@$_GET['mode'] =="update" && $_POST['ppassword']=="$expassword"){ 
  $sql1="UPDATE admin SET password ='$_POST[password]' where ID='$superid'";
  if (!mysqli_query($con,$sql1)){die('Error: ' . mysqli_error($con));  }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Password%20Updated%20Successfully...'>";  exit(0);
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
        </div>
        <div class="box-body" style="padding: 10px!important;">
        <?php  
          echo displayMsg(@$_GET['msg']);
          echo dangerMsg(@$_GET['msgdanger']);
          echo dupl_msg(@$_GET['dupl_msg']);
        ?>
        <form name="form" id="form" action="changepassword<?= $extn; ?>?mode=update" method="post">
        <div class="row">
          <div class="col-md-3">
            <label for="currentpassword">Current Password<span style="color:#FF0000">*</span></label>
            <input type="hidden" class="form-control"  name="expassword1" id="expassword1" value="<?php echo $expassword ?>" />
            <input type="password" class="form-control" name="ppassword" id="ppassword">
          </div>
          <div class="col-md-3">
            <label for="currentpassword">New Password<span style="color:#FF0000">*</span></label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="col-md-3">
            <label for="currentpassword">Confirm Password<span style="color:#FF0000">*</span></label>
            <input type="text" class="form-control" name="cppassword" id="cppassword">
          </div>
          <div class="col-md-3">
            <input type="submit" name="submit" class="btn btn-primary" value="Change Password" onClick="return goforpassword();" style="cursor:pointer; margin-top: 22px;">
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
<!-- NOTE : dist/js/FieldValidation.js <-- this  file is mandatory for this script -->
<!-- script for change password field check  whether fields are fill or empty -->
<script language="javascript" type="text/javascript">
  function goforpassword(){
    if(isblank(document.getElementById("ppassword"))){
      alert("Error! You must enter your current password..."); 
      document.getElementById("ppassword").focus();
      return false;
    }
    if(document.getElementById("ppassword").value != document.getElementById("expassword1").value ){
      alert("Error! You must enter a valid current password..."); 
      document.getElementById("ppassword").focus();
      return false;
    }
    if(isblank(document.getElementById("password"))){
      alert("Error! You must enter new password..."); 
      document.getElementById("password").focus();
      return false;
    }
    if(isblank(document.getElementById("cppassword"))){
      alert("Error! You must enter confirm password..."); 
      document.getElementById("cppassword").focus();
      return false;
    }
    if(document.getElementById("cppassword").value != document.getElementById("password").value )
    {
      alert("Error! You must enter same password..."); 
      document.getElementById("cppassword").focus();
      return false;
    }
  }
 </script>
 <!-- change password script END