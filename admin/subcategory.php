<?php 
require('check.php');
$pageurl = "subcategory$extn";
$tblname = "subcategory";
$pagename = "Sub Category";
$id = @$_GET['id']; 
$img_required = '';

// Get POST Values
$CID   = get_safe_value($con,@$_POST['category_id']);
$title = get_safe_value($con,@$_POST['subcategory']);
$desc  = get_safe_value($con,@$_POST['description']);
$slug  = createUrl($title);

// Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "subcat-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/subcategory/'.$newfilename.$ext;
  move_uploaded_file($_FILES['cover_img']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  

// Insert new entry Query
if(@$_GET['mode']=="addnew"){

  // check for duplicate entry is there or not
  $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE subcategory='$title'");
  $check = mysqli_num_rows($sql);
  if($check>0){
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=$pagename Already Exist...'>";  exit(0);
  }else{
    $sql = "INSERT INTO `$tblname`(`category_id`, `subcategory`, `description`, `subcategoryurl`, `pic`, `createdon`, `rd`, `date`, `time`, `sort`) 
    VALUES ('$CID', '$title', '$desc', '$slug', '$pic', '$now', '$rd', '$dd', '$dt', '1')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Created%20Successfully...'>";  exit(0);
  }
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `category_id`='$CID', `subcategory`='$title', `description`='$desc', `subcategoryurl`='$slug', `modifiedon`='$now' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "subcat-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/subcategory/'.$newfilename.$ext;
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
      $get_cid         = $row['category_id'];
      $get_subcategory = $row['subcategory'];
      $get_desc        = $row['description'];
      $get_pic      = $row['pic'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT $tblname.*, courses.title FROM $tblname, courses WHERE $tblname.course_id=courses.ID ORDER BY $tblname.ID desc";
// $sql = "SELECT * FROM `$tblname` WHERE hide='0' ORDER BY ID DESC";
$sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category_id WHERE t1.hide='0' and t2.hide='0' ORDER BY t1.ID DESC";
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
                  <label for="category_id">Select Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required>
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` where category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_cid){
                          echo "<option selected value=".$row['ID'].">".$row['category']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['category']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Sub Category <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="subcategory" value="<?= @$get_subcategory; ?>" autocomplete="off" placeholder="Sub Category Title">
                </div>
                <!--<div class="form-group">-->
                <!--  <label for="desc">Description <i class="font-12">[Optional] </i></label>-->
                <!--  <textarea name="description" id="details" rows="5" class="form-control" placeholder="Enter Category Description Here"><?=  @$get_desc; ?></textarea>-->
                <!--  <script type='text/javascript'>-->
                <!--   CKEDITOR.replace('details',{-->
                <!--    width :'98%', height:180,-->
                <!--    toolbar : [-->
                <!--  ['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],-->
                <!--  filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',-->
                <!--    filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'-->
                <!--     }); -->
                <!--  </script>-->
                <!--</div>-->
                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">Cover Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="cover_img" id="cover_img" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                 <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'subcategory/'.$get_pic; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                <th width="20">Img</th>
                <th>Details</th>
                <th width="140">Created by</th>
                <th width="20">Action</th>
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
                    <?php if($cpic !=""){ ?>
                         <a href="<?= UPLOAD_PATH.'subcategory/'.$cpic; ?>" target="_blank">
                         <img src="<?= UPLOAD_PATH.'subcategory/'.$cpic; ?>" width="50" height="50" style="border-radius:10%;"></a>
                    <?php } ?>
                        
                 
                </td>
                <td>
                  <span class="text-blue bold ps12">Category:</span> <?php echo $row['category']; ?> <br>
                  <span class="text-green bold ps12">SubCategory:</span> <?php echo $row['subcategory']; ?> <br>
                  <span class="text-red bold ps12">Slug: </span><?php echo $row['subcategoryurl']; ?><br>
                  <?php if($row['description']!=""){ ?>
                  <span class="text-blue bold ps12">Description: </span><span class="ps13"><?php echo $row['description']; ?></span>
                  <?php } ?>
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