<?php 
require('check.php');
$pageurl      = "services$extn";
$tblname      = "services";
$pagename     = "Services";
$id           = @$_GET['id']; 
$pic_required = '';
$sessionid    = date("ymdHis"); 


// Get POST Values
$CID      = get_safe_value($con,@$_POST['category_id']);
$SCID     = get_safe_value($con,@$_POST['subcategoryid']);
$SSCID     = get_safe_value($con,@$_POST['subsubcategoryid']);
$type     = get_safe_value($con,@$_POST['type']);
$title    = get_safe_value($con,@$_POST['title']);
$surl     = createUrl($title.'-'.$type);
$skucode  = get_safe_value($con,@$_POST['skucode']);
$duration = get_safe_value($con,@$_POST['duration']);
$short_desc     = get_safe_value($con,@$_POST['short_description']);
$long_desc     = get_safe_value($con,@$_POST['long_description']);
$ori_amt      = get_safe_value($con,@$_POST['original_amount']);  
$dis_amt      = get_safe_value($con,@$_POST['discount_amount']);  
$discount     = get_safe_value($con,@$_POST['discount']);


// Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "service-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/service/'.$newfilename.$ext;
  move_uploaded_file($_FILES['cover_img']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";} 

// Insert new entry Query
if(@$_GET['mode']=="addnew"){
  $sql = "INSERT INTO `$tblname`(`status`, `category`, `subcategory`, `subsubcategory`, `type`, `title`, `url`, `original_amount`, `discount_amount`, `pic`, `skucode`, `short_description`,`long_description`, `duration`, `discount` , `createdon`, `rd`, `date`, `time`, `sort`, `sessionid`) VALUES ('1', '$CID', '$SCID', '$SSCID' , '$type', '$title', '$surl', '$ori_amt', '$dis_amt', '$pic', '$skucode', '$short_desc','$long_desc', '$duration', '$discount' ,'$now', '$rd', '$dd', '$dt', '1', '$sessionid')";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=Service%20Added%20Successfully...'>";  exit(0);
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
$img_required ="";
  $sql="UPDATE `$tblname` SET `category`='$CID', `subcategory`='$SCID', `subsubcategory`='$SSCID', type='$type', `title`='$title', `url`='$surl', `original_amount`='$ori_amt', `discount_amount`='$dis_amt', `skucode`='$skucode', `short_description`='$short_desc', `long_description`='$long_desc' ,`duration`='$duration', `discount`='$discount' ,`skucode`='$skucode',  `modifiedon`='$now' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

// Edit Image Upload Code
$ext="";
if((!empty($_FILES["cover_img"])) && ($_FILES['cover_img']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['cover_img']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "service-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/service/'.$newfilename.$ext;
  move_uploaded_file($_FILES['cover_img']['tmp_name'],$newname);  
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

// feature Update Query
else if(@$_GET['mode']=="update_feature" && $id !=""){ 
  $feature = get_safe_value($con,$_GET['feature']);
  $sql="UPDATE `$tblname` SET feature ='$feature' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); } 
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Status%20updated%20Successfully !!'>"; exit(0);
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
      $get_cid      = $row['category'];
      $get_scid     = $row['subcategory'];
      $get_sscid     = $row['subsubcategory'];
      $get_type     = $row['type'];
      $get_title    = $row['title'];
      $get_ori_amt      = $row['original_amount'];
      $get_dis_amt   = $row['discount_amount'];
      $get_short_desc     = $row['short_description'];
      $get_long_desc     = $row['long_description'];
      $get_pic      = $row['pic'];
      $get_sku      = $row['skucode'];
      $get_duration = $row['duration'];
      $get_discount = $row['discount'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT t1.*, t2.category FROM `$tblname` t1 INNER JOIN `category` t2 ON t2.ID=t1.category WHERE t1.hide='0' ORDER BY t1.ID DESC";

$sql = "SELECT t1.*, t2.category, t3.subcategory,t4.subsubcategory_name,t1.hide  FROM `$tblname` t1 
LEFT JOIN `category` t2 ON t2.ID=t1.category 
LEFT JOIN `subcategory` t3 ON t3.ID = t1.subcategory
LEFT JOIN `subsubcategory` t4 ON t4.ID = t1.subsubcategory
ORDER BY t1.ID DESC";
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
                  <label for="category_id">Category <span class="text-red">*</span></label>
                  <select class="form-control" name="category_id" required id="category_id">
                    <option class="text-blue bold">Select Category</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,category FROM `category` where category.hide=0 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        // echo 'c_id:'.$get_cid;
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
                <div class="form-group col-md-4">
                  <label for="subcategoryid">Subcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subcategoryid" id="subcategoryid">
                    <option>Select SubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_cid ) {
                            $res = mysqli_query($con,"SELECT ID,subcategory FROM `subcategory` where subcategory.hide=0 and subcategory.ID='".$get_scid."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_scid){
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

                <div class="form-group col-md-4">
                  <label for="subcategoryid">SubSubcategory <span class="text-red">*</span></label>
                  <select class="form-control" name="subsubcategoryid" id="subsubcategoryid">
                    <option>Select SubSubCategory</option>
                    <?php
                    // echo $get_cid;
                          if( @$get_scid ) {
                            $res = mysqli_query($con,"SELECT ID,subsubcategory_name FROM `subsubcategory` where subsubcategory.hide=0 and subsubcategory.ID='".$get_sscid."' ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if($row['ID']==$get_sscid){
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
                
                <!--<div class="form-group col-md-4">-->
                <!--  <label for="type">Service Type <span class="text-red">*</span></label>-->
                <!--  <select name="type" class="form-control">-->
                <!--    <option value="">Select Service Type</option>-->
                <!--    <option value="Basic Facial" <?php if(@$get_type=="Basic Facial"){?> selected="selected"<?php } ?>>Basic Facial</option>-->
                <!--    <option value="Premium Facial" <?php if(@$get_type=="Premium Facial"){?> selected="selected"<?php } ?>>Premium Facial</option>-->
                <!--    <option value="Luxury Facial" <?php if(@$get_type=="Luxury Facial"){?> selected="selected"<?php } ?>>Luxury Facial</option>-->

                <!--    <option value="Rica Brazilian" <?php if(@$get_type=="Rica Brazilian"){?> selected="selected"<?php } ?>>RICA BRAZILIAN (PEEL-OFF) WAXING</option>-->
                <!--    <option value="Rica Wax" <?php if(@$get_type=="Rica Wax"){?> selected="selected"<?php } ?>>Rica Wax</option>-->
                <!--    <option value="Normal Wax" <?php if(@$get_type=="Normal Wax"){?> selected="selected"<?php } ?>>Normal Wax</option>-->

                <!--    <option value="CLASSIC" <?php if(@$get_type=="CLASSIC"){?> selected="selected"<?php } ?>>CLASSIC</option>-->
                <!--    <option value="Premium Sara" <?php if(@$get_type=="Premium Sara"){?> selected="selected"<?php } ?>>Premium (Sara)</option>-->
                <!--    <option value="Luxury O3" <?php if(@$get_type=="Luxury O3"){?> selected="selected"<?php } ?>>Luxury (O3+)</option>-->

                <!--    <option value="Facial" <?php if(@$get_type=="Facial"){?> selected="selected"<?php } ?>>Facial</option>-->
                <!--    <option value="CleanUp" <?php if(@$get_type=="CleanUp"){?> selected="selected"<?php } ?>>Clean Up</option>-->

                <!--    <option value="De-Tan" <?php if(@$get_type=="De-Tan"){?> selected="selected"<?php } ?>>De-Tan</option>-->
                <!--    <option value="Bleach" <?php if(@$get_type=="Bleach"){?> selected="selected"<?php } ?>>Bleach</option>-->

                <!--    <option value="Hair-Spa" <?php if(@$get_type=="Hair-Spa"){?> selected="selected"<?php } ?>>Hair Spa</option>-->
                <!--    <option value="Hair-Colour" <?php if(@$get_type=="Hair-Colour"){?> selected="selected"<?php } ?>>Hair Colour</option>-->

                <!--    <option value="PREMIUM" <?php if(@$get_type=="PREMIUM"){?> selected="selected"<?php } ?>>PREMIUM</option>-->
                <!--    <option value="LUXURY" <?php if(@$get_type=="LUXURY"){?> selected="selected"<?php } ?>>LUXURY</option>-->
                <!--  </select>-->
                <!--</div>-->
                <!-- // INSERT INTO `services`(`ID`, `status`, `category`, `subcategory`, `subsubcategory`, `type`, `title`, `url`, `mrp`, `original_amount`, `discount_amount`, `pic`, `skucode`, `short_description`, `long_description`, `duration`, `discount`, `hotdeal`, `supersaving`, `createdon`, `modifiedon`, `rd`, `date`, `time`, `sort`, `hide`, `sessionid`) -->

                <div class="form-group col-md-12">
                  <label for="title">Service Title <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="title" placeholder="Service title" value="<?= @$get_title; ?>" required autocomplete="off">
                </div>
                <!--<div class="form-group col-md-3">-->
                <!--  <label for="skucode"> SKU Code </label>-->
                <!--  <input type="text" class="form-control" name="skucode" value="<?= @$get_sku; ?>" placeholder="Enter SKU Code">-->
                <!--</div>-->
                <div class="form-group col-md-3">
                  <label for="duration"> Duration <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="duration" value="<?= @$get_duration; ?>" placeholder="Enter Duration in Minutes"  autocomplete="off" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="mrp"> Original Price <span class="text-red">*</span></label>
                  <input type="number" class="form-control" name="original_amount" value="<?= @$get_ori_amt; ?>" placeholder="Enter Original Price"  autocomplete="off" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="amount">Offer Price <span class="text-red">*</span></label>
                  <input type="number" class="form-control" name="discount_amount" value="<?= @$get_dis_amt; ?>" placeholder="Enter Offer Price"  autocomplete="off" required>
                </div>                
                <div class="form-group col-md-12">
                  <label for="short_description">Short Description <span class="text-red">*</span></label>
                  
                  <textarea id="tinyeditor1" name="short_description" rows="5" class="form-control" placeholder="Enter Short Description"><?= @$get_short_desc; ?></textarea>
                </div> 
                <div class="form-group col-md-12">
                  <label for="short_description">Long Description <span class="text-red">*</span></label>
                  <textarea id="tinyeditor" name="long_description" rows="5" class="form-control" placeholder="Enter Long Description"><?= @$get_long_desc; ?></textarea>
                </div> 
                <div class="form-group col-md-3">
                  <label for="discount"> Discount <span class="text-red">*</span></label>
                  <input type="text" class="form-control" name="discount" value="<?= @$get_discount; ?>" placeholder="Enter Discount"  autocomplete="off" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="cover_img"> <span class="text-red">Upload only Image (size : 400 * 265)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="cover_img" id="cover_img" class="img" style="width:250px;" <?= $pic_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'service/'.$get_pic; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                <th width="50">Feature</th>
                <th width="50">Status</th>
                <th width="20">Img</th>
                <th width="150">Other Details</th>
                <th>Service Details</th>
                <th width="120">Price</th>
                <th width="70">Created On</th>
                <th width="20">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1;
                $pic = ($row['pic']!="") ? $row['pic'] : "noimg.webp";
               ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?= $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <td><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['feature']=='1'){
                      echo "<a href='$pageurl?mode=update_feature&feature=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_feature&feature=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                
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
                <?php if($row['pic'] !=""){ ?>
                  <a href="<?= UPLOAD_PATH.'service/'.$pic; ?>" target="_blank">
                    <img src="<?= UPLOAD_PATH.'service/'.$pic; ?>" width="50" height="50" style="border-radius:10%;">
                  </a>
                <?php } ?>
                </td>
                <td style="text-align: left;">
                  <span class="text-blue bold ps12">Category:</span> <?php echo $row['category']; ?> <br>
                  <span class="text-green bold ps12">Subcategory: </span> <?php echo $row['subcategory']; ?><br>
                  <span class="text-pink bold ps12">SubSubcategory: </span> <?php echo $row['subsubcategory_name']; ?><br>
                  <?php if($row['type']!=""): ?>
                  <!--<span class="text-red bold ps12">Type: </span> <?php echo $row['type']; ?>-->
                  <?php endif; ?>
                </td>
                <td style="text-align: left;">
                  <span class="text-red bold ps12">Title:</span> <?php echo $row['title']; ?> <br>
                  <span class="text-green bold ps12">Duration:</span> <?php echo $row['duration']; ?> <br>
                  <?php if($row['skucode']!=""): ?>
                  <!--<span class="text-blue bold ps12">SKU: </span> <?php echo $row['skucode']; ?>-->
                  <?php endif; ?>
                </td>
                <td style="text-align: left;">
                  <span class="text-red bold ps13">Original Price: </span> <span class="ps14 bold"><?php echo '&#8377; '.number_format($row['original_amount']).'/-'; ?></span> <br>
                  <span class="text-green bold ps13">Offer Price: </span> <span class="ps14 bold"><?php echo '&#8377; '.number_format($row['discount_amount']).'/-'; ?></span> 
                </td>
                <td title="Modified on: <?php echo $row['modifiedon']; ?>"><?php echo $row['createdon']; ?></td>
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