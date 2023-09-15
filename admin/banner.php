<?php 
require('check.php');
$pageurl      = "banner$extn";
$tblname      = "banner";
$pagename     = "Banner";
$id           = @$_GET['id']; 
$img_required = 'required';
$sessionid    = date("ymdHis"); 

// Get POST Values
$type    = get_safe_value($con,@$_POST['type']);
$category_id    = get_safe_value($con,@$_POST['category_id']);
$title    = get_safe_value($con,@$_POST['title']);
$subtitle = get_safe_value($con,@$_POST['subtitle']);
$sort     = get_safe_value($con,@$_POST['sort']);

// Image Upload Code
$ext="";
if((!empty($_FILES["banner_img"])) && ($_FILES['banner_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['banner_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "B-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/banner/'.$newfilename.$ext;
  move_uploaded_file($_FILES['banner_img']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
    $sql = "INSERT INTO `$tblname`(`status`,`type`,`category_id`,`title`, `subtitle`, `pic`, `createdon`, `sort`,`sessionid`) 
    VALUES ('1', '$type', '$category_id', '$title', '$subtitle', '$pic', '$now', '$sort','$sessionid')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Upload%20Successfully...'>";  exit(0);
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `title`='$title',`type`='$type' ,`category_id`='$category_id',`subtitle`='$subtitle', `sort`='$sort', `modifiedon`='$now' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["banner_img"])) && ($_FILES['banner_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['banner_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "B-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/banner/'.$newfilename.$ext;
  move_uploaded_file($_FILES['banner_img']['tmp_name'],$newname);  
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
   $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
//   $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
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
      $get_type    = $row['type'];
      $get_category_id    = $row['category_id'];
      $get_title    = $row['title'];
      $get_subtitle = $row['subtitle'];
      $get_sort     = $row['sort'];
      $get_banner   = $row['pic'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT $tblname.*, courses.title FROM $tblname, courses WHERE $tblname.course_id=courses.ID ORDER BY $tblname.ID desc";
$sql = "SELECT *,c.category as cname,b.pic as bimage,b.ID,b.status FROM `$tblname` b 
LEFT JOIN category c ON c.ID = b.category_id
WHERE b.hide = 0
ORDER BY b.ID DESC";
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
  $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$companyasend'";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
       $("#type").change(function(){
       var type=$("#type").val();
          
          if(type=="1" )
          { 
            //alert(type);
            $(".category_id").hide();
          } 
          else if(type=="2")
          {
             $(".category_id").show();
          }
     });
    });
</script>

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

                <div class="form-group col-md-4">
                  <label for="type">Type <span class="text-red">*</span></label>
                  <select name="type" id="type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="1" <?php if(@$get_type=="1"){?> selected="selected"<?php } ?>>None</option>
                    <option value="2" <?php if(@$get_type=="2"){?> selected="selected"<?php } ?>>Category</option>
                  </select>
                </div>

                <?php if(@$get_type['type'] == 2 ){ ?>

                  <div class="form-group col-md-4 category_id" style="display:block;">
                  <label for="category_id">Select Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required>
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` WHERE category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_category_id){
                          echo "<option selected value=".$row['ID'].">".$row['category']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['category']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>

                <?php }else{ ?>
                  <div class="form-group col-md-4 category_id" style="display:none">
                  <label for="category_id">Select Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required>
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` WHERE category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_category_id){
                          echo "<option selected value=".$row['ID'].">".$row['category']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['category']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <?php } ?>
                

                <div class="form-group col-md-4">
                  <label for="name">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="title" value="<?= @$get_title; ?>" autocomplete="off" placeholder="Banner Title" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Sub Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="subtitle" value="<?= @$get_subtitle; ?>" autocomplete="off" placeholder="Banner Sub Title" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Sort <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="sort" value="<?= @$get_sort; ?>" autocomplete="off" placeholder="Sort Value" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">Banner Image (Size: 1600x670 px WEBP Format)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="banner_img" id="banner_img" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'banner/'.$get_banner; ?>" width="200" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                <th width="20">Sort</th>
                <th>Title & Subtitle</th>
                <th width="200">Banner</th>
                <th width="140">Created by</th>
                <th width="20">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; 
              while($row=mysqli_fetch_array($result)){ $num=$num+1; 
                $cpic = ($row['bimage']!="") ? $row['bimage'] : "noimg.webp";
                ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <td align="center"><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['status']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                <td align="center"><?php echo $row['sort']; ?></td>
                <td valign="middle">
                  <span class="text-green bold font-15">Type: </span><span><?php if($row['type'] ==1){ echo 'None';}else if($row['type'] ==2){ echo 'Only Category';}?></span><br>
                  <span class="text-purple bold font-15">Category Name: </span><span><?php echo $row['cname']; ?></span><br>
                  <span class="text-red bold font-15">Title: </span><?php echo $row['title']; ?><br>
                  <span class="text-blue bold font-15">Sub Title: </span><span><?php echo $row['subtitle']; ?></span><br>


                </td>
                <td align="center">
                  <a href="<?= UPLOAD_PATH.'banner/'.$cpic; ?>" target="_blank">
                    <img src="<?= UPLOAD_PATH.'banner/'.$cpic; ?>" width="200" style="max-height: 150px;">
                  </a>
                </td>
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