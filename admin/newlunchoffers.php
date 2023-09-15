<?php 
require('check.php');
$pageurl      = "newlunchoffers$extn";
$tblname      = "new_lunch";
$pagename     = "New Lunch Offers";
$id           = @$_GET['id']; 
$pic_required = '';
$sessionid    = date("ymdHis"); 


// Get POST Values
$category_id = get_safe_value($con,@$_POST['category_id']);
$sub_category_id    = get_safe_value($con,@$_POST['subcategory_id']);
$sub_sub_sub_category_id = get_safe_value($con,@$_POST['subsubcategory_id']);
$title     = get_safe_value($con,@$_POST['title']);
$click     = get_safe_value($con,@$_POST['click']);
$sort     = get_safe_value($con,@$_POST['sort']);
$height     = get_safe_value($con,@$_POST['height']);
$width     = get_safe_value($con,@$_POST['width']);


// Image Upload Code
$ext="";
if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['pic']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "newlunchoffers-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/new_lunch_offers/'.$newfilename.$ext;
  move_uploaded_file($_FILES['pic']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";} 

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
 $sql = "INSERT INTO `$tblname`(`status`,`category_id`,`subcategory_id`, `subsubcategory_id`, `title`,`click`,`pic`,`height`,`width`,`createdon`,`sort`) 
    VALUES ('1', '$category_id', '$sub_category_id', '$sub_sub_sub_category_id','$title','$click','$height','$width','$pic', '$now', '$sort')";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Added%20Successfully...'>";  exit(0);
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
    $sql="UPDATE `$tblname` SET `title`='$title',`click`='$click',`category_id`='$category_id',`subcategory_id`='$sub_category_id',`subsubcategory_id`='$sub_sub_sub_category_id', `sort`='$sort', `modifiedon`='$now',`height`='$height',`width`='$width' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["pic"])) && ($_FILES['pic']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['pic']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "newlunchoffers-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/new_lunch_offers/'.$newfilename.$ext;
  move_uploaded_file($_FILES['pic']['tmp_name'],$newname);  
} 
  if($ext!=""){$pic="$newfilename$ext";
    $sqlx="UPDATE `$tblname` SET `pic`='$pic' WHERE ID='$id'"; 
    if (!mysqli_query($con,$sqlx)){die('Error: ' . mysqli_error($con)); } 
  } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}

// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){ 
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
}

// Delete Query
else if(@$_GET['mode']=="delete" && $id !=""){
   $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
//   $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=$pagename%20Deleted%20successfully...'>";  exit(0);
}





//Select query when we click on pencil for edit existing entry
else if(@$_GET['mode']=="edit" && $id!="") { 
  $pic_required = '';
  $sql = "SELECT * FROM `$tblname` WHERE ID='$id'";
  $result = mysqli_query($con,$sql);
  $count = mysqli_num_rows($result);
  if($count>0){
    while($row = mysqli_fetch_array($result)) {
      // debug($row);
      $get_click    = $row['click'];
      $get_category_id    = $row['category_id'];
      $get_subcat_id    = $row['subcategory_id'];
      $get_subsubcat_id    = $row['subsubcategory_id'];
      $get_title    = $row['title'];
      $get_sort     = $row['sort'];
      $get_pic   = $row['pic'];
      $get_height   = $row['height'];
      $get_width   = $row['width'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category WHERE t1.hide='0' ORDER BY t1.ID DESC";

$sql = "SELECT *,c.ID,subcat.ID,subsubcat.ID,c.category as cname,n.pic as oimage,n.ID,n.status,subcat.subcategory as subcat_name,subsubcat.subsubcategory_name as subsubsubcat_name,n.modifiedon,n.height,n.width FROM `new_lunch` n 
LEFT JOIN category c ON c.ID = n.category_id 
LEFT JOIN subcategory subcat ON subcat.ID = n.subcategory_id 
LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = n.subsubcategory_id 
WHERE n.hide = 0 ORDER BY n.ID DESC";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
       $("#click").change(function(){
       var click=$("#click").val();
          
          if(click=="0" )
          { 
            //alert(type);
            $(".category_id").hide();
            $(".subcategoryid").hide();
            $(".subsubcategoryid").hide();
          } 
          else if(click=="1")
          {
             $(".category_id").show();
             $(".subcategoryid").show();
             $(".subsubcategoryid").show();
          }else{
            
            $(".category_id").hide();
            $(".subcategoryid").hide();
            $(".subsubcategoryid").hide();
          }
     });
    });
</script>

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


             
                
                <div class="form-group col-md-4">
                  <label for="type">Type Clickable <span class="text-red">*</span></label>
                  <select name="click" id="click" class="form-control">
                    <option >Select Type</option>
                    <option value="1" <?php if(@$get_click=="1"){?> selected="selected"<?php } ?>>Clickable</option>
                    <option value="0" <?php if(@$get_click=="0"){?> selected="selected"<?php } ?>>None</option>
                  </select>
                </div>

                <?php if(@$get_click['click'] == "1" ){ ?>

                 <div class="form-group col-md-4 category_id" style="display:block">
                  <label for="category_id">Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required id="category_id">
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` where category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        // echo 'c_id:'.$get_cid;
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

                <div class="form-group col-md-4 subcategoryid" style="display:block">
                  <label for="subcategoryid">Subcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subcategory_id" id="subcategoryid">
                    <option>Select SubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_category_id ) {
                            $res = mysqli_query($con,"SELECT ID,subcategory FROM `subcategory` where subcategory.hide=0 and subcategory.ID='".$get_subcat_id."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_subcat_id){
                                echo "<option selected value=".$row['ID'].">".$row['subcategory']."</option>";  
                              }
                              else{
                                echo "<option value=".$row['ID'].">".$row['subcategory']."</option>";
                              }
                            }
                          }
                    ?>
                  </select>
                </div>

                <div class="form-group col-md-4 subcategoryid" style="display:block">
                  <label for="subcategoryid">SubSubcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subsubcategory_id" id="subsubcategoryid">
                    <option>Select SubSubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_subcat_id ) {
                            $res = mysqli_query($con,"SELECT ID,subsubcategory_name FROM `subsubcategory` where subsubcategory.hide=0 and subsubcategory.ID='".$get_subsubcat_id."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_subsubcat_id){
                                echo "<option selected value=".$row['ID'].">".$row['subsubcategory_name']."</option>";  
                              }
                              else{
                                echo "<option value=".$row['ID'].">".$row['subsubcategory_name']."</option>";
                              }
                            }
                          }
                    ?>
                  </select>
                </div>
                <?php }else{ ?>

                  <div class="form-group col-md-4 category_id" style="display:none">
                  <label for="category_id">Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required id="category_id">
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` where category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        // echo 'c_id:'.$get_cid;
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

                <div class="form-group col-md-4 subcategoryid" style="display:none">
                  <label for="subcategoryid">Subcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subcategory_id" id="subcategoryid">
                    <option>Select SubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_category_id ) {
                            $res = mysqli_query($con,"SELECT ID,subcategory FROM `subcategory` where subcategory.hide=0 and subcategory.ID='".$get_subcat_id."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_subcat_id){
                                echo "<option selected value=".$row['ID'].">".$row['subcategory']."</option>";  
                              }
                              else{
                                echo "<option value=".$row['ID'].">".$row['subcategory']."</option>";
                              }
                            }
                          }
                    ?>
                  </select>
                </div>

                <div class="form-group col-md-4 subcategoryid" style="display:none">
                  <label for="subcategoryid">SubSubcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subsubcategory_id" id="subsubcategoryid">
                    <option>Select SubSubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_subcat_id ) {
                            $res = mysqli_query($con,"SELECT ID,subsubcategory_name FROM `subsubcategory` where subsubcategory.hide=0 and subsubcategory.ID='".$get_subsubcat_id."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_subsubcat_id){
                                echo "<option selected value=".$row['ID'].">".$row['subsubcategory_name']."</option>";  
                              }
                              else{
                                echo "<option value=".$row['ID'].">".$row['subsubcategory_name']."</option>";
                              }
                            }
                          }
                    ?>
                  </select>
                </div>

                <?php } ?> 
                <div class="form-group col-md-4">
                  <label for="name">Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="title" value="<?= @$get_title; ?>" autocomplete="off" placeholder="Offer Title" required>
                </div>
               
                <div class="form-group col-md-4">
                  <label for="name">Sort <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="sort" value="<?= @$get_sort; ?>" autocomplete="off" placeholder="Sort Value" required>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="name">Width <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="width" value="<?= @$get_width; ?>" autocomplete="off" placeholder="Width Value" required>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="name">Height <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="height" value="<?= @$get_height; ?>" autocomplete="off" placeholder="Height Value" required>
                </div>
                
                
                
                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">Offers Image (Size: 1600x670 px WEBP Format)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="pic" id="pic" class="img" style="width:250px;" <?= $pic_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'new_lunch_offers/'.$get_pic; ?>" width="200" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1;
                $pic = ($row['oimage']!="") ? $row['oimage'] : "noimg.webp";
               ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?= $row['ID'] ?>" style="cursor:pointer;"></td> -->
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
                <td align="left">
                  <span class="text-green bold font-15">Type Clickable: </span><span><?php if($row['click'] == 0){echo 'None';}else if($row['click'] == 1){echo 'Clickable';} ?></span><br>
                  <span class="text-purple bold font-15">Category Name: </span><span><?php echo $row['cname']; ?></span><br>
                  <span class="text-blue bold font-15">Sub Category Name: </span><span><?php echo $row['subcat_name']; ?></span><br>
                  <span class="text-darkgreen bold font-15">Sub Sub Category Name: </span><span><?php echo $row['subsubsubcat_name']; ?></span><br>
                  <span class="text-red bold font-15">Title: </span><?php echo $row['title']; ?><br>

                </td>
                <td align="center">
                  <a href="<?= UPLOAD_PATH.'new_lunch_offers/'.$pic; ?>" target="_blank">
                    <img src="<?= UPLOAD_PATH.'new_lunch_offers/'.$pic; ?>" width="200" style="max-height: 150px;">
                  </a>
                </td>
                <td title="Modified on: <?php echo $row['modifiedon']; ?>"><?php echo formatDate($row['modifiedon']); ?></td>
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
<!-- <script type='text/javascript'>
 CKEDITOR.replace('details',{
  width :'98%', height:180,
  toolbar : [
['Source', '-', 'Bold', 'Italic', 'Underline', 'Font', 'FontSize', 'Link', 'Unlink','Strike', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', '-', 'Table', 'Templates', 'HorizontalRule', 'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize'] ],
filebrowserBrowseUrl : 'bower_components/ckeditor/ckfinder/ckfinder.html',
  filebrowserImageUploadUrl : 'bower_components/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
   }); 
</script> -->

<script>
  $(document).ready(function(){
    jQuery('#category_id').change(function(){

    var get_scid = "";
    console.log("SubCategory ID: "+ get_scid);

      var id=jQuery(this).val();
      console.log("Category ID: "+ id);
      if(id=='-1'){
        jQuery('#subcategoryid').html('<option value="-1">Select SubCategory </option>');
      }else{
        $("#divLoading").addClass('show');
        jQuery('#subcategoryid').html('<option value="-1">Select SubCategory </option>');
        jQuery.ajax({
          type:'post',
          url:'get_data.php?mode=subcategory',
          data:'id='+id+'&get_scid='+get_scid,
          // data:'id='+id,
          success:function(result){
            $("#divLoading").removeClass('show');
            jQuery('#subcategoryid').append(result);
          }
        });
      }
    });
  });
</script>

<script>
  $(document).ready(function(){
    jQuery('#subcategoryid').change(function(){

    var get_sscid = "";
    console.log("SubSubCategory ID: "+ get_sscid);

      var id=jQuery(this).val();
      console.log("Category ID: "+ id);
      if(id=='-1'){
        jQuery('#subsubcategoryid').html('<option value="-1">Select SubSubCategory </option>');
      }else{
        $("#divLoading").addClass('show');
        jQuery('#subsubcategoryid').html('<option value="-1">Select SubSubCategory </option>');
        jQuery.ajax({
          type:'post',
          url:'get_data1.php?mode=subsubcategory',
          data:'id='+id+'&get_sscid='+get_sscid,
          // data:'id='+id,
          success:function(result){
            $("#divLoading").removeClass('show');
            jQuery('#subsubcategoryid').append(result);
          }
        });
      }
    });
  });
</script>