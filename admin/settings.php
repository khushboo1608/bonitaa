<?php 
require('check.php');
$pageurl      = "settings$extn";
$tblname      = "settings";
$pagename     = "Settings";
$id           = @$_GET['id']; 
$img_required = 'required';
$sessionid    = date("ymdHis"); 


// Get POST Values
$email_from    = get_safe_value($con,@$_POST['email_from']);
$firebase_server_key    = get_safe_value($con,@$_POST['firebase_server_key']);
$onesignal_app_id    = get_safe_value($con,@$_POST['onesignal_app_id']);
$onesignal_rest_key    = get_safe_value($con,@$_POST['onesignal_rest_key']);
$app_name    = get_safe_value($con,@$_POST['app_name']);
$app_logo    = get_safe_value($con,@$_POST['app_logo']);
$app_email    = get_safe_value($con,@$_POST['app_email']);
$app_author    = get_safe_value($con,@$_POST['app_author']);
$app_contact    = get_safe_value($con,@$_POST['app_contact']);
$app_website    = get_safe_value($con,@$_POST['app_website']);
$app_description    = get_safe_value($con,@$_POST['app_description']);
$app_developed_by    = get_safe_value($con,@$_POST['app_developed_by']);
$app_version    = get_safe_value($con,@$_POST['app_version']);
$app_update_status    = get_safe_value($con,@$_POST['app_update_status']);
$app_maintenance_status    = get_safe_value($con,@$_POST['app_maintenance_status']);
$app_maintenance_description    = get_safe_value($con,@$_POST['app_maintenance_description']);
$app_update_description    = get_safe_value($con,@$_POST['app_update_description']);
$app_update_cancel_button    = get_safe_value($con,@$_POST['app_update_cancel_button']);
$app_update_factor_button    = get_safe_value($con,@$_POST['app_update_factor_button']);
$factor_apikey    = get_safe_value($con,@$_POST['factor_apikey']);
$payment_type    = get_safe_value($con,@$_POST['payment_type']);
$payment_test_id    = get_safe_value($con,@$_POST['payment_test_id']);
$payment_live_id    = get_safe_value($con,@$_POST['payment_live_id']);
$payment_mode    = get_safe_value($con,@$_POST['payment_mode']);
$map_api_key    = get_safe_value($con,@$_POST['map_api_key']);
$razorpay_key    = get_safe_value($con,@$_POST['razorpay_key']);
$text1    = get_safe_value($con,@$_POST['text1']);
$text2    = get_safe_value($con,@$_POST['text2']);
$text4    = get_safe_value($con,@$_POST['text4']);
$text5    = get_safe_value($con,@$_POST['text5']);
$text6    = get_safe_value($con,@$_POST['text6']);
$text7    = get_safe_value($con,@$_POST['text7']);
$text8    = get_safe_value($con,@$_POST['text8']);
$text9    = get_safe_value($con,@$_POST['text9']);
$text10    = get_safe_value($con,@$_POST['text10']);
$text11    = get_safe_value($con,@$_POST['text11']);
$text12    = get_safe_value($con,@$_POST['text12']);

// Row Update Query 
// if(@$_GET['mode']=="update" && $id !=""){
if(isset($_POST['submit']))
{
  $img_required ="";


   $sql="UPDATE `$tblname` SET `email_from`='$email_from',`firebase_server_key`='$firebase_server_key',`onesignal_app_id`='$onesignal_app_id'
  ,`onesignal_rest_key`='$onesignal_rest_key',`app_name`='$app_name',`app_email`='$app_email',`app_author`='$app_author',`app_contact`='$app_contact',`app_website`='$app_website',
  `app_description`='$app_description',`app_developed_by`='$app_developed_by',`app_version`='$app_version',`app_update_status`='$app_update_status',`app_maintenance_status`='$app_maintenance_status',
  `app_maintenance_description`='$app_maintenance_description',`app_update_description`='$app_update_description',`app_update_cancel_button`='$app_update_cancel_button',`factor_apikey`='$factor_apikey',
  `payment_type`='$payment_type',`payment_test_id`='$payment_test_id',`payment_live_id`='$payment_live_id',`payment_mode`='$payment_mode',`map_api_key`='$map_api_key',`razorpay_key`='$razorpay_key',
  `text1`='$text1',`text2`='$text2',`text4`='$text4',`text5`='$text5',`text6`='$text6',`text7`='$text7',`text8`='$text8',`text9`='$text9',`text10`='$text10',`text11`='$text11',`text12`='$text12'

   WHERE ID ='1' ";

  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

  // Edit Image Upload Code
  $ext="";
  if((!empty($_FILES["app_logo"])) && ($_FILES['app_logo']['error'] == 0)){
    $filename    = strtolower(basename($_FILES['app_logo']['name']));
    $ext         = substr($filename, strrpos($filename, '.') + 1);
    $namefile    = str_replace(".$ext","", $filename);
    $newfilename = "admin-".date("ymdHis");
    //Determine the path to which we want to save this file
    $ext=".".$ext;
    $newname = '../uploads/'.$newfilename.$ext;
    move_uploaded_file($_FILES['app_logo']['tmp_name'],$newname);  
  } 
    if($ext!=""){$pic="$newfilename$ext";
      $sqlx="UPDATE `$tblname` SET `app_logo`='$pic' WHERE ID='1' "; 
      if (!mysqli_query($con,$sqlx)){die('Error: ' . mysqli_error($con)); } 
    } 
    
    if((!empty($_FILES["app_qr"])) && ($_FILES['app_qr']['error'] == 0)){
    $filename1    = strtolower(basename($_FILES['app_qr']['name']));
    $ext         = substr($filename1, strrpos($filename1, '.') + 1);
    $namefile    = str_replace(".$ext","", $filename1);
    $newfilename1 = "admin-".date("ymdHis");
    //Determine the path to which we want to save this file
    $ext=".".$ext;
    $newname1 = '../uploads/'.$newfilename1.$ext;
    move_uploaded_file($_FILES['app_qr']['tmp_name'],$newname1);  
  } 
    if($ext!=""){$pic1="$newfilename1$ext";
      $sqlx1="UPDATE `$tblname` SET `text3`='$pic1' WHERE ID='1' "; 
      if (!mysqli_query($con,$sqlx1)){die('Error: ' . mysqli_error($con)); } 
    } 

  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}


//Select query when we click on pencil for edit existing entry
 
  $img_required ="";
  $sql = "SELECT * FROM `$tblname` WHERE ID='1' ";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {

      $get_email_from    = $row['email_from'];
      $get_firebase_server_key    = $row['firebase_server_key'];
      $get_onesignal_app_id    = $row['onesignal_app_id'];
      $get_onesignal_rest_key    = $row['onesignal_rest_key'];
      $get_app_name    = $row['app_name'];
      $get_app_logo    = $row['app_logo'];
      $get_app_email    = $row['app_email'];
      $get_app_author    = $row['app_author'];
      $get_app_contact    = $row['app_contact'];
      $get_app_website    = $row['app_website'];
      $get_app_description    = $row['app_description'];
      $get_app_developed_by    = $row['app_developed_by'];
      $get_app_version    = $row['app_version'];
      $get_app_update_status    = $row['app_update_status'];
      $get_app_maintenance_status    = $row['app_maintenance_status'];
      $get_app_maintenance_description    = $row['app_maintenance_description'];
      $get_app_update_description    = $row['app_update_description'];
      $get_app_update_cancel_button    = $row['app_update_cancel_button'];
      $get_app_update_factor_button    = $row['app_update_factor_button'];
      $get_factor_apikey    = $row['factor_apikey'];
      $get_payment_type    = $row['payment_type'];
      $get_payment_test_id    = $row['payment_test_id'];
      $get_payment_live_id    = $row['payment_live_id'];
      $get_payment_mode    = $row['payment_mode'];
      $get_map_api_key    = $row['map_api_key'];
      $get_razorpay_key    = $row['razorpay_key'];
      $get_text1    = $row['text1'];
      $get_text2    = $row['text2'];
      $get_text3    = $row['text3'];
      $get_text4    = $row['text4'];
      $get_text5    = $row['text5'];
      $get_text6    = $row['text6'];
      $get_text7    = $row['text7'];
      $get_text8    = $row['text8'];
      $get_text9    = $row['text9'];
      $get_text10    = $row['text10'];
      $get_text11    = $row['text11'];
      $get_text12    = $row['text12'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }


//Select Query to display the records (join)
// $sql = "SELECT $tblname.*, courses.title FROM $tblname, courses WHERE $tblname.course_id=courses.ID ORDER BY $tblname.ID desc";
$sql = "SELECT * FROM `$tblname` WHERE ID = '1' ";
$result = mysqli_query($con,$sql);   


//Select all code
$selectvariable = '';
if (@$_POST['action'] == 'Delete') {
  for ($i=0; $i < count($_POST['ids']);$i++) {
    $selectvariable =$_POST['ids'][$i].", ".$selectvariable;
  }
  $ids = substr($selectvariable, 0, -2);
  $companyasend = str_replace(", ","' or ID = '", $ids);
  // $sql="DELETE FROM `$tblname` WHERE ID='$companyasend'";
  $sql="UPDATE `$tblname` SET status ='1' WHERE ID='$companyasend'";
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

      <div class="<?= $boxcolor; ?>">
      <?php  $add_edit = "Edit"; ?>

        <div class="box-header with-border" data-widget="collapse" style="cursor: pointer;">
          <h3 class="box-title text-blue"><?= $add_edit; ?> <?php echo $pagename; ?></h3>

          <div class="box-tools pull-left">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus text-blue"></i></button>
          </div>
        </div>
        <div class="box-body table-responsive no-padding" style="padding: 10px!important;">
        <?php  
          echo displayMsg(@$_GET['msg']);
          echo dangerMsg(@$_GET['msgdanger']);
          echo dupl_msg(@$_GET['dupl_msg']);
        ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <!-- form start -->
            
            <form role="form" action="<?= $pageurl; ?>" name="settings_from" method="POST" enctype="multipart/form-data">
              <h3 class="text-blue">General Settings</h3>
              <div class="box-body">

                <div class="form-group col-md-4">
                  <label for="name">Host Email <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="email_from" value="<?= @$get_email_from; ?>" autocomplete="off" placeholder="Email id" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">App Name <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_name" value="<?= @$get_app_name; ?>" autocomplete="off" placeholder="App Name" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Author <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_author" value="<?= @$get_app_author; ?>" autocomplete="off" placeholder="Author Name" >
                </div>

                <div class="form-group col-md-4">
                  <label for="name">Contact <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_contact" value="<?= @$get_app_contact; ?>" autocomplete="off" placeholder="Contact Number" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Email <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_email" value="<?= @$get_app_email; ?>" autocomplete="off" placeholder="App Email id" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Website <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_website" value="<?= @$get_app_website; ?>" autocomplete="off" placeholder="App Website" >
                </div>

                <div class="form-group col-md-4">
                  <label for="name">Developed By <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="app_developed_by" value="<?= @$get_app_developed_by; ?>" autocomplete="off" placeholder="App Developer By" >
                </div>

                <div class="form-group col-md-5">
                  <label for="app_description">App Description <span class="text-red">*</span></label>
                  <textarea id="tinyeditor" name="app_description" rows="5" class="form-control" placeholder="App Description"><?= @$get_app_description; ?></textarea>
                </div> 
                <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">App Logo (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="app_logo" id="app_logo" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <div class="form-group col-md-2">
                  <img src="<?= UPLOAD_PATH.''.$get_app_logo; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>

              </div>

              <h3 class="text-blue">App Settings</h3>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="name">Maintenance <span class="text-red">*</span></label>
                  <select name="app_maintenance_status" class="form-control">
                    <option value="">Select Service Type</option>
                    <option value="0" <?php if(@$get_app_maintenance_status=="0"){?> selected="selected"<?php } ?>>No</option>
                    <option value="1" <?php if(@$get_app_maintenance_status=="1"){?> selected="selected"<?php } ?>>Yes</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">New App Version Code <span class="text-red">*[Note : How to get version code]</span></label>
                  <input type="text" class="form-control" name="app_version" value="<?= @$get_app_version; ?>" autocomplete="off" placeholder="App Version" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Maintenance Cancel Option<span class="text-red">*[Note : Cancel button option will show in app update popup]</span></label>
                  <select name="app_maintenance_status" class="form-control">
                    <option value="">Select Service Type</option>
                    <option value="0" <?php if(@$get_app_maintenance_status=="0"){?> selected="selected"<?php } ?>>No</option>
                    <option value="1" <?php if(@$get_app_maintenance_status=="1"){?> selected="selected"<?php } ?>>Yes</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="name">Maintenance Description <span class="text-red">*</span></label>
                  <!-- <input type="text" class="form-control" name="app_maintenance_description" value="<?= @$get_app_maintenance_description; ?>" autocomplete="off" placeholder="App Maintenance Description" > -->
                  <textarea id="tinyeditor" name="app_maintenance_description" rows="5" class="form-control" placeholder="App Maintenance Description"><?= @$get_app_maintenance_description; ?></textarea>
                </div>

                <div class="form-group col-md-4">
                  <label for="name">Update Description <span class="text-red">*</span></label>
                  <!-- <input type="text" class="form-control" name="app_update_description" value="<?= @$get_app_update_description; ?>" autocomplete="off" placeholder="App Update Description" > -->
                  <textarea id="tinyeditor" name="app_update_description" rows="5" class="form-control" placeholder="App Update Description"><?= @$get_app_update_description; ?></textarea>
                </div>
                

              </div>

              <h3 class="text-blue">Notification Settings</h3>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="name">OneSignal App ID <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="onesignal_app_id" value="<?= @$get_onesignal_app_id; ?>" autocomplete="off" placeholder="App Onesingle App id" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">OneSignal Rest Key <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="onesignal_rest_key" value="<?= @$get_onesignal_rest_key; ?>" autocomplete="off" placeholder="App Onesingle Rest key" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Server Key <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="firebase_server_key" value="<?= @$get_firebase_server_key; ?>" autocomplete="off" placeholder="App Server key" >
                </div>
              </div>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="name">2 Factor API Key <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="factor_apikey" value="<?= @$get_factor_apikey; ?>" autocomplete="off" placeholder="App Factor key" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">2 Factor Option <span class="text-red">*[Note : This button option will show in live or not 2 Factor]</span></label>
                  <select name="app_update_factor_button" class="form-control">
                    <option value="">Select Service Type</option>
                    <option value="0" <?php if(@$get_app_update_factor_button=="0"){?> selected="selected"<?php } ?>>No</option>
                    <option value="1" <?php if(@$get_app_update_factor_button=="1"){?> selected="selected"<?php } ?>>Yes</option>
                  </select>
                </div>
                 
                <div class="form-group col-md-4">
                  <label for="name">Map API Key <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="map_api_key" value="<?= @$get_map_api_key; ?>" autocomplete="off" placeholder="App Map API key" >
                </div>
              </div>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="name">Razor Pay Key <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="razorpay_key" value="<?= @$get_razorpay_key; ?>" autocomplete="off" placeholder="App Razorpay key" >
                </div>
              </div>
              
              <h3 class="text-blue">Charges Settings</h3>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="name">Safety & Hygiene Charges <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="text1" value="<?= @$get_text1; ?>" autocomplete="off" placeholder="App Safety & Hygiene Charges" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Conveyance Charges <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="text2" value="<?= @$get_text2; ?>" autocomplete="off" placeholder="Conveyance Charges" >
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Minimum Order Amount <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="text12" value="<?= @$get_text12; ?>" autocomplete="off" placeholder="Minimum Order Amount" >
                </div>
              </div>
              
              <h3 class="text-blue">QR Upload</h3>
              <div class="box-body">
               <div class="form-group col-md-3">
                  <label for="course_img"> <span class="text-red">QR Code (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="app_qr" id="app_qr" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <div class="form-group col-md-2">
                  <img src="<?= UPLOAD_PATH.''.$get_text3; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
                </div>
               </div>
              
              <h3 class="text-blue">Pages Details</h3>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="desc">App About us: <i class="font-12">[Optional] </i></label>
                  <textarea name="text4" id="details1" rows="5" class="form-control" placeholder="Enter Category Description Here"><?=  @$get_text4; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details1',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                  
                </div>
                
                <div class="form-group col-md-4">
                  <label for="desc">App Contact us: <i class="font-12">[Optional] </i></label>
                  <textarea name="text5" id="details2" rows="5" class="form-control" placeholder="Enter Category Description Here"><?=  @$get_text5; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details2',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                  
                </div>
                
                <div class="form-group col-md-4">
                  <label for="desc">App Privacy Policy: <i class="font-12">[Optional] </i></label>
                  <textarea name="text6" id="details3" rows="5" class="form-control" placeholder="Enter Category Description Here"><?=  @$get_text6; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details3',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                  
                </div>
                
                <div class="form-group col-md-4">
                  <label for="desc">App Terms Condition: <i class="font-12">[Optional] </i></label>
                  <textarea name="text7" id="details4" rows="5" class="form-control" placeholder="Enter Description Here"><?=  @$get_text7; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details4',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="desc">App Cancellation/Refund Policies: <i class="font-12">[Optional] </i></label>
                  <textarea name="text8" id="details5" rows="5" class="form-control" placeholder="Enter Description Here"><?=  @$get_text8; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details5',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                </div>
                
              
              </div>

              <h3 class="text-blue">Extra Details</h3>
              <div class="box-body">
                <div class="form-group col-md-4">
                  <label for="desc">App Company Info: <i class="font-12">[Optional] </i></label>
                  <textarea name="text9" id="details6" rows="5" class="form-control" placeholder="Enter Description Here"><?=  @$get_text9; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details6',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                  </div>

                <div class="form-group col-md-4">
                  <label for="desc">App BB Agrement: <i class="font-12">[Optional] </i></label>
                  <textarea name="text10" id="details7" rows="5" class="form-control" placeholder="Enter Description Here"><?=  @$get_text10; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details7',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                </div>

                <div class="form-group col-md-4">
                  <label for="desc">App fee & fine: <i class="font-12">[Optional] </i></label>
                  <textarea name="text11" id="details8" rows="5" class="form-control" placeholder="Enter Description Here"><?=  @$get_text11; ?></textarea>
                  <script type='text/javascript'>
                   CKEDITOR.replace('details8',{
                    width :'98%', height:180,
                    toolbar : [
                  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
                  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
                    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                     }); 
                  </script>
                </div>

                </div>
                


              <!-- /.box-body -->
              <div align="right" class="box-footer">

                <button type="submit" name="submit" class="<?= $btncolor; ?>"><i class="fa fa-save"></i>&nbsp; Update</button>
                
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