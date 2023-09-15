<?php 
require('check.php');
$pageurl = "lesson_content$extn";
$tblname = "lesson_content";
$pagename = "Lesson Content";
$id = @$_GET['id']; 

// Image Upload Code
$uploaded=0;
$ext="";

if((!empty($_FILES["uploaded_file"])) && ($_FILES["uploaded_file"]["error"] == 0)){
  $filename    = strtolower(basename($_FILES["uploaded_file"]["name"]));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = date("dmyHis");

  //Determine the path to which we want to save this file
  $ext = ".".$ext;
  // $newname = dirname(__FILE__).'../../uploads/ebooks/'.$newfilename.$ext; // windows hosting
  $newname = "../../uploads/ebooks/".$newfilename.$ext; // linux hosting
  move_uploaded_file($_FILES["uploaded_file"]["tmp_name"],$newname);
  $uploaded_file = $newfilename.$ext;
} 

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
  $courseid      = get_safe_value($con,$_POST['course_id']);
  $lesson_catid  = get_safe_value($con,$_POST['lesson_categoryid']);
  $lcon_title    = get_safe_value($con,$_POST['lesson_content_title']);
  $video_url     = get_safe_value($con,$_POST['video_url']);
  $video_timing  = get_safe_value($con,$_POST['video_timing']);
  $content_type  = get_safe_value($con,$_POST['content_type']);

  $sql = "INSERT INTO `$tblname`(status, course_id, lesson_categoryid, lesson_content_title, video_url, video_timing, type, filename, createdon) 
  VALUES ('1','$courseid', '$lesson_catid', '$lcon_title', '$video_url', '$video_timing', '$content_type', '$uploaded_file', '$now')";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Lesson%20Content%20Uploaded%20Successfully...'>";  exit(0);
  }

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
  $courseid     = get_safe_value($con,$_POST['course_id']);
  $lesson_catid = get_safe_value($con,$_POST['lesson_categoryid']);
  $lcon_title   = get_safe_value($con,$_POST['lesson_content_title']);
  $video_url    = get_safe_value($con,$_POST['video_url']);
  $video_timing = get_safe_value($con,$_POST['video_timing']);
  $content_type  = get_safe_value($con,$_POST['content_type']);

  // check File is selected or not by user at the time of edit
  if($_FILES["uploaded_file"]["name"]!=''){
  $sql= "UPDATE `$tblname` SET `course_id`='$courseid', `lesson_categoryid`='$lesson_catid', `lesson_content_title`='$lcon_title', `video_url`='$video_url', `video_timing`='$video_timing', `type`='$content_type', `filename`='$uploaded_file' ,`modifiedon`='$now' WHERE ID =$id";
  }else{
    $sql= "UPDATE `$tblname` SET `course_id`='$courseid', `lesson_categoryid`='$lesson_catid', `lesson_content_title`='$lcon_title', `video_url`='$video_url', `video_timing`='$video_timing', `type`='$content_type', `modifiedon`='$now' WHERE ID =$id";
  }


  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Lesson%20Content%20Updated%20Successfully...'>";  exit(0);
}

// Status Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Lesson%20Content%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
  $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  // $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Lesson%20Content%20Deleted%20successfully...'>";  exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $file_required = '';
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
      $get_courseid    = $row['course_id'];
      $get_lessoncatid = $row['lesson_categoryid'];
      $get_title       = $row['lesson_content_title'];
      $get_vurl        = $row['video_url'];
      $get_vtiming     = $row['video_timing'];
      $get_contenttype = $row['type'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
$sql = "SELECT $tblname.*, courses.title, lesson_category.name FROM $tblname, courses, lesson_category WHERE $tblname.course_id=courses.ID AND $tblname.lesson_categoryid=lesson_category.ID ORDER BY $tblname.ID desc";
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
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Selected Lesson Category are deleted..'>";  exit(0);
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

// Get Courses in dropdown
$sql="SELECT ID,title FROM courses";
$cresult = mysqli_query($con,$sql);   
while($row=mysqli_fetch_array($cresult)){ 
  $arrCourse[] = $row;
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
      <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
      <div class="<?= $boxcolor; ?>">
      <?php }else{ ?>
      <div class="<?= $boxcolor; ?> collapsed-box">
      <?php } ?>
        <div class="box-header with-border" data-widget="collapse" style="cursor: pointer;">
          <h3 class="box-title text-blue">Add <?php echo $pagename; ?></h3>

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
                  <label for="course">Course <span class="text-red">*</span></label>
                  <select class="form-control" name="course_id" required id="course_id">
                    <option value="-1" class="text-blue bold">Select Course</option>
                    <?php
                    foreach($arrCourse as $course){
                      if($course['ID']==$get_courseid){
                        echo "<option selected value=".$course['ID']." style='background: grey; color:white;'>".$course['title']."</option>";  
                      }else{
                        echo "<option value=".$course['ID'].">".$course['title']."</option>";  
                      }
                    }
                    ?>
                  </select>
                </div>    
                <div class="form-group col-md-6">
                  <label for="lessoncategory">Lesson Category <span class="text-red">*</span></label>
                  <select class="form-control" name="lesson_categoryid" id="lesson_categoryid" required>
                    <option>Select Lesson Category ID</option>
                  </select>
                </div>                             
                <div class="form-group col-md-12">
                  <label for="name">Lesson Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="lesson_content_title" value="<?= @$get_title; ?>" autocomplete="off" placeholder="Lesson Content Title" required>
                </div>  
                <div class="form-group col-md-12">
                  <label for="Topic">Content Type <span class="text-red">*</span></label>
                  <select class="form-control" name="content_type" id="content_type" required>
                    <option value="-1" class="text-blue bold">Select Type</option>
                    <option value="0" <?php if($get_contenttype=='0'){ ?> selected <?php } ?>>Video</option>
                    <option value="1" <?php if($get_contenttype=='1'){ ?> selected <?php } ?>>PDF</option>
                  </select>
                </div>                   
                <div class="form-group col-md-6">
                  <label for="name">Video URL <small>(For Video)</small><span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="video_url" value="<?= @$get_vurl; ?>" autocomplete="off" placeholder="Video URL" >
                </div> 
                <div class="form-group col-md-6">
                  <label for="name">Video Timing <small>(For Video)</small><span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="video_timing" value="<?= @$get_vtiming; ?>" autocomplete="off" placeholder="Video Timing">
                </div>  
                <div class="form-group col-md-12">
                  <label for="uploadPDF"> Upload PDF <small>(For PDF)</small> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="uploaded_file" id="uploaded_file" class="img" style="width:250px;" <?php echo $file_required; ?>>
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
<div id="divLoading"></div>
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
                <td><input type='checkbox' id='selectall' title='Select All' style='cursor:pointer;'/></td></td>
                <th width="20">ID</th>
                <th width="20">Status</th>
                <th width="200">Details</th>
                <th>Lesson Details</th>
                <th width="70">Created by</th>
                <th width="20">#</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; 
              while($row=mysqli_fetch_array($result)){ $num=$num+1; ?>
              <tr>
                <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td>
                <th><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                <td style="text-align: left;">
                  <span class="text-blue bold ps12">Course: </span><?php echo $row['title']; ?><br>
                  <span class="text-red bold ps12">Lesson Category: </span><?php echo $row['name']; ?><br>
                </td>                
                <td>
                  <span class="text-blue bold ps12">Title: </span><?php echo $row['lesson_content_title']; ?><br>
                  <?php if($row['video_url']!=''){ ?>
                  <span class="text-red bold ps12">Video URL: </span><?php echo $row['video_url']; ?><br>
                  <span class="text-green bold ps12">Video Timing: </span><?php echo $row['video_timing']; ?><br>
                  <?php }else{ ?>
                  <span class="text-green bold ps14"><i class="fa fa-download"></i> PDF</span>
                  <a href="<?php echo IMG_SITE_PATH.'ebooks/'.$row['filename'];?>" target="_new"><?php echo $row['filename']; ?></a><br>
                  <?php } ?>
                </td>
                <td title="Modified on: <?php echo $row['modifiedon']; ?>"><?php echo $row['createdon']; ?></td>
                <td>
                  <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['ID'] ?>" title="Edit"><i class="fa fa-pencil"></i>&nbsp;</a>
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
    
<script>
  $(document).ready(function(){
    jQuery('#course_id').change(function(){

    var get_lessoncatid = "<?php echo $get_lessoncatid; ?>";
    console.log(get_lessoncatid);

      var id=jQuery(this).val();
      console.log(id);
      if(id=='-1'){
        jQuery('#lesson_categoryid').html('<option value="-1">Select Lesson Category</option>');
      }else{
        $("#divLoading").addClass('show');
        jQuery('#lesson_categoryid').html('<option value="-1">Select Lesson Category</option>');
        jQuery.ajax({
          type:'post',
          url:'get_data.php',
          data:'id='+id+'&get_lessoncatid='+get_lessoncatid,
          data:'id='+id,
          success:function(result){
            $("#divLoading").removeClass('show');
            jQuery('#lesson_categoryid').append(result);
          }
        });
      }
    });
  });
  </script>