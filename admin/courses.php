<?php 
require('check.php');
$pageurl = "courses$extn";
$tblname = "courses";
$pagename = "Courses";
$id = @$_GET['id']; 
$pic_required = 'required';
$get_zoomid = "2523451388";
$get_zoompassword = "133682";

// Image Upload Code
$uploaded=0;
$ext="";

if((!empty($_FILES["course_img"])) && ($_FILES["course_img"]["error"] == 0)){
  $filename    = strtolower(basename($_FILES["course_img"]["name"]));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = date("dmyHis");

  //Determine the path to which we want to save this file
  $ext = ".".$ext;
  $newname = dirname(__FILE__).'../../uploads/images/'.$newfilename.$ext;
  move_uploaded_file($_FILES["course_img"]["tmp_name"],$newname);
  $finalname = $newfilename.$ext;
} 

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
  $title    = get_safe_value($con,$_POST['coursetitle']);
  $mrp      = get_safe_value($con,$_POST['mrp']);  
  $amt      = get_safe_value($con,$_POST['amount']);  
  $desc     = get_safe_value($con,$_POST['description']);
  $category = get_safe_value($con,$_POST['category']);
  $zoomid   = get_safe_value($con,$_POST['zoomid']);
  $zoompassword   = get_safe_value($con,$_POST['zoompassword']);
  $zoomclass   = get_safe_value($con,$_POST['zoomclass']);
  $videourl = get_safe_value($con,$_POST['videourl']);

  // url Creation code by function
  $url = createUrl($title);

  // check for duplicate entry is there or not
  $sqlview = mysqli_query($con,"SELECT * FROM `$tblname` WHERE title='$title'");
  $check = mysqli_num_rows($sqlview);
  if($check>0){
  	echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=Course Already Exist...'>";  exit(0);
  }else{
	  $sql = "INSERT INTO `$tblname`(status, title, amount, pic, description, category, zoomid, videoid, url, createdon,zoompw,class_details) 
    VALUES ('1', '$title', '$amt', '$finalname', '$desc', '$category', '$zoomid', '$videourl', '$url', '$now','$zoompassword','$zoomclass')";
	  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
	  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Courses%20Added%20Successfully...'>";  exit(0);
	}
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
  $pic_required = '';
  $title        = get_safe_value($con,$_POST['coursetitle']);
  $mrp          = get_safe_value($con,$_POST['mrp']);  
  $amt          = get_safe_value($con,$_POST['amount']);  
  $desc         = get_safe_value($con,$_POST['description']);
  $category     = get_safe_value($con,$_POST['category']);
  $zoomid       = get_safe_value($con,$_POST['zoomid']);
  $zoompassword = get_safe_value($con,$_POST['zoompassword']);
  $zoomclass    = get_safe_value($con,$_POST['zoomclass']);
  $videourl     = get_safe_value($con,$_POST['videourl']);

  // url Creation code by function
  $url = createUrl($title);  

  // check for duplicate entry is there or not
  $sqlview = mysqli_query($con,"SELECT * FROM `$tblname` WHERE title='$title'");
  $check   = mysqli_num_rows($sqlview);
  if($check>0){

    // if we try to update course wtihout changing the title
    if(isset($id) && $id!=''){
      $getData = mysqli_fetch_assoc($sqlview);
      if($id == $getData['ID']){

        // check image is selected or not by user at the time of edit
        if($_FILES["course_img"]['name']!=''){
          $sql="UPDATE `$tblname` SET title='$title', amount='$amt', pic='$finalname', description='$desc', zoomid='$zoomid', videoid='$videourl', category='$category', url='$url', modifiedon='$now',zoompw='$zoompassword', class_details='$zoomclass' WHERE ID =$id";
        } else {
          $sql="UPDATE `$tblname` SET title='$title', amount='$amt', description='$desc', category='$category', zoomid='$zoomid', videoid='$videourl', url='$url', modifiedon='$now',zoompw='$zoompassword', class_details='$zoomclass' WHERE ID =$id";
        }

        if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
        echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Course%20Updated%20Successfully...'>";  exit(0);
      }else{
        echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=Course already exist...'>";  exit(0);
      }
    }else{
      echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=Course already exist...'>";  exit(0);
    }
  }else{
    $sql="UPDATE `$tblname` SET title='$title', amount='$amt', description='$desc', category='$category', zoomid='$zoomid', videoid='$videourl', url='$url', modifiedon='$now' WHERE ID =$id";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Course%20Updated%20Successfully...'>";  exit(0);
  }
}

// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Course%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
  $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  // $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Course%20Deleted%20successfully...'>";  exit(0);
}

//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $pic_required = '';
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
	  while($row = mysqli_fetch_array($result)) {
      $get_title    = $row['title'];
      $get_mrp      = $row['mrp'];
      $get_amount   = $row['amount'];
      $get_desc     = $row['description'];
      $get_category = $row['category'];
      $get_pic      = $row['pic'];
      $get_zoomid   = $row['zoomid'];
	  $get_zoompassword   = $row['zoompw'];
	  $get_zoomclass   = $row['class_details'];
      $get_videoid  = $row['videoid'];
	  }
	}else{
		echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
	}
}

//Select Query to display the records
$sql    = "SELECT * FROM `$tblname` ORDER BY ID desc";
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
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Selected Courses are deleted..'>";  exit(0);
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
                <div class="form-group col-md-12">
                  <label for="coursetitle">Course Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="coursetitle" placeholder="Course title" value="<?= @$get_title; ?>" required autocomplete="off">
                </div>
                <div class="form-group col-md-3">
                  <label for="mrp"> Mrp <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="mrp" value="<?= @$get_mrp; ?>" placeholder="Enter Amount"  autocomplete="off" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="amount">Amount <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="amount" value="<?= @$get_amount; ?>" placeholder="Enter Amount"  autocomplete="off" required>
                </div>                
                <div class="form-group col-md-6">
                  <label for="category">Category <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="category" value="<?= @$get_category; ?>" placeholder="Enter Category Name" autocomplete="off" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="zoomid">Zoom ID </label>
                  <input type="text" class="form-control" name="zoomid" value="<?= @$get_zoomid; ?>" placeholder="Enter Zoom ID" autocomplete="off">
                </div>
	               <div class="form-group col-md-6">
                  <label for="zoompassword">Zoom Password </label>
                  <input type="text" class="form-control" name="zoompassword" value="<?= @$get_zoompassword; ?>" placeholder="Enter Zoom Password" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="zoomclass">Zoom Class Details </label>
                  <input type="text" class="form-control" name="zoomclass" value="<?= @$get_zoomclass; ?>" placeholder="Zoom Class Details" autocomplete="off">
                </div>	
							
                <div class="form-group col-md-6">
                  <label for="videourl">Video URL </label>
                  <input type="text" class="form-control" name="videourl" value="<?= @$get_videoid; ?>" placeholder="Enter Video URL" autocomplete="off">
                </div>                
                <div class="form-group col-md-12">
                  <label for="description"> Description <span class="text-red">*</span></label>
                  <textarea id="courseeditorid" name="description" rows="5" class="form-control" placeholder="Enter Course Description" required><?= @$get_desc; ?></textarea>
                </div> 
                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">Upload only Image (size : 400 * 265)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="course_img" id="course_img" class="img" style="width:250px;" <?= $pic_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-6">
                  <img src="<?php echo IMG_SITE_PATH.'images/'.$get_pic; ?>" width="100" height="100" alt="Image not found" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                <td><input type='checkbox' id='selectall' title='Select All' style='cursor:pointer;'/></td></td>
                <th width="30">ID</th>
                <th width="50">Status</th>
                <th width="20">Img</th>
                <th>Course Details</th>
                <th width="70">Created by</th>
                <th width="20">#</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1; ?>
              <tr>
                <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td>
                <td><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                <td align="center"><img src="<?php echo IMG_SITE_PATH.'images/'.$row['pic']; ?>" width="50" height="50" style="border-radius:10%;"></td>
                <td style="text-align: left;">
                  <span class="text-red bold ps12">Title:</span> <?php echo $row['title']; ?> <br><br>
                  <span class="text-blue bold ps12">Description: </span> <?php echo $row['description']; ?> <br>
                  <span class="text-yellow bold ps12">Category: </span> <?php echo $row['category']; ?> <br>
                  <span class="text-red bold ps13">MRP: </span> <span class="ps14 bold"><?php echo '&#8377; '.$row['mrp'].'/-'; ?></span> <br>
                  <span class="text-green bold ps13">Amount: </span> <span class="ps14 bold"><?php echo '&#8377; '.$row['amount'].'/-'; ?></span> <br>
                  <span class="text-blue bold ps13">Zoom ID: </span> <?php echo $row['zoomid']; ?> <br>
				  <span class="text-blue bold ps13">Zoom Password : </span> <?php echo $row['zoompw']; ?> <br>
				  <span class="text-blue bold ps13">Zoom Class Details : </span> <?php echo $row['class_details']; ?> <?php if($row['liveclass_status']=="1"){?><a href="joinclass.php?mode=pause&id=<?php echo $row['ID'] ?>"><span class="label label-danger">PAUSE CLASS</span></a><?php } else {?><a href="joinclass.php?mode=join&id=<?php echo $row['ID'] ?>&zoomid=<?php echo $row['zoomid'] ?>" target="_blank"><span class="label label-success">JOIN CLASS</span></a><?php } ?><br>
                  <span class="text-danger bold ps13">VideoURL: </span> <a href="<?php echo $row['videoid'];?>" target="_new"><?php echo $row['videoid']; ?></a> <br>
                  <span class="text-blue bold ps13">URL: </span> <?php echo $row['url']; ?> <br>
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
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('courseeditorid')
  })
</script>