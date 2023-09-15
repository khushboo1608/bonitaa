<?php 
require('check.php');
$pageurl      = "rechargefine$extn";
$tblname      = "recharge_fine";
$pagename     = "Recharge/Rewards/Fine";
$id           = @$_GET['id']; 
$img_required = 'required';
$sessionid    = date("ymdHis"); 

// Get POST Values
$staff_id    = get_safe_value($con,@$_POST['staff_id']);
$recharge_fine_type    = get_safe_value($con,@$_POST['recharge_fine_type']);
$title    = get_safe_value($con,@$_POST['title']);
$description    = get_safe_value($con,@$_POST['description']);
$price    = get_safe_value($con,@$_POST['price']);
$start_date    = get_safe_value($con,@$_POST['start_date']);
$type    = get_safe_value($con,@$_POST['type']);





// Insert new entry Query
if(@$_GET['mode']=="addnew"){

    //$sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE start_date='$start_date' and recharge_fine_type='$recharge_fine_type' and staff_id='$staff_id' ");
  //$check = mysqli_num_rows($sql);
  //if($check>0){
    //echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=$pagename Already Exist...'>";  exit(0);
  //}else{
    $sql = "INSERT INTO `$tblname`(`status`, `staff_id`, `recharge_fine_type`, `title`, `description`, `price`, `cdate`, `start_date`, `type`) 
    VALUES ('1', '$staff_id', '$recharge_fine_type', '$title', '$description', '$price', '$now', '$start_date','$type')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Upload%20Successfully...'>";  exit(0);
  //}
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){

 $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE start_date='$start_date' and recharge_fine_type='$recharge_fine_type' and staff_id!='$staff_id'  AND ID != '".$id."'");
  $check = mysqli_num_rows($sql);
  //if($check>0){
    //echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=$pagename Already Exist...'>";  exit(0);
  //}else{
// INSERT INTO `recharge_fine`(`status`, `staff_id`, `recharge_fine_type`, `title`, `description`, `price`, `cdate`, `start_date`, `end_date`, `type`)
  $sql="UPDATE `$tblname` SET `staff_id`='$staff_id',`recharge_fine_type`='$recharge_fine_type',`title`='$title',`description`='$description',`price`='$price',`start_date`='$start_date',`type`= '$type' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
 //}
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
      
      // INSERT INTO `recharge_fine`(`status`, `staff_id`, `recharge_fine_type`, `title`, `description`, `price`, `cdate`, `start_date`,  `type`)

      $get_staff_id    = $row['staff_id'];
      $get_recharge_fine   = $row['recharge_fine_type'];
      $get_title    = $row['title'];
      $get_description = $row['description'];
      $get_price     = $row['price'];
      $get_cdate  = $row['cdate'];
      $get_start_date  = $row['start_date'];
      $get_type  = $row['type'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}

//Select Query to display the records (join)
// $sql = "SELECT $tblname.*, courses.title FROM $tblname, courses WHERE $tblname.course_id=courses.ID ORDER BY $tblname.ID desc";
$sql = "SELECT *,s.name as staffname, s.ID as staffid,rf.ID,rf.type as rechargefinetype,rf.cdate as rechargefinecdate,rf.start_date as rechargefinesdate,rf.end_date as rechargefineedate,rf.status as rechargefinestatus,rf.title as rechargefinetitle,rf.description as rechargefinedesc,rf.price as rechargefineprice,rf.recharge_fine_type as recharge_fine_type
         FROM recharge_fine rf
        left join staff s on s.ID = rf.staff_id 
        ORDER BY rf.ID DESC";
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
       $("#leave_status").change(function(){
       var type=$("#leave_status").val();
          
          if(type=="4")
          { 
            //alert(type);
            $(".cancel_reason").show();
          } else{
            $(".cancel_reason").hide();
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
                <!-- 1-full day,2-Moring half day,3- Evening half day,4-mutiple days  -->
                
                
                <div class="form-group col-md-4">
                  <label for="staff_id">Select Staff </label>
                  <select class="form-control" name="staff_id" >
                    <option class="text-blue bold">Select Staff</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT ID,name FROM `staff` where status=1 ORDER BY ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        if($row['ID']==$get_staff_id){
                          echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                        }
                        else{
                          echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="type">Type </label>
                  <select name="recharge_fine_type" id="recharge_fine_type" class="form-control" >
                    <option value="">Select Type</option>
                    <option value="1" <?php if(@$get_recharge_fine=="1"){?> selected="selected"<?php } ?>>Recharge</option>
                    <option value="2" <?php if(@$get_recharge_fine=="2"){?> selected="selected"<?php } ?>>Rewards</option>
                    <option value="3" <?php if(@$get_recharge_fine=="3"){?> selected="selected"<?php } ?>>Fine</option>
                  </select>
                </div>

                
                <div class="form-group col-md-4">
                  <label for="name">Title </label>
                  <input type="text" class="form-control" name="title" value="<?= @$get_title; ?>" autocomplete="off" placeholder="Enter Title" >
                </div>

                <div class="form-group col-md-4">
                  <label for="desc">Description: </label>
                  <textarea name="description" id="details1" rows="5" class="form-control" placeholder="Enter Category Description Here"><?=  @$get_description; ?></textarea>
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
                  <label for="name">Price </label>
                  <input type="text" class="form-control" name="price" value="<?= @$get_price; ?>" autocomplete="off" placeholder="Enter Price" >
                </div>
            
                <div class="form-group col-md-4 start_date">
                  <label for="name">Start Date <span class="text-red">*</span></label>
                  <input type="date" class="form-control" name="start_date" value="<?= @$get_start_date; ?>" autocomplete="off" placeholder="Start date" >
                </div>

         
                
                <div class="form-group col-md-4">
                  <label for="type"> Status </label>
                  <select name="type" id="type" class="form-control" >
                    <option value="">Select Type</option>
                    <!-- 1-Pending,2-approve,3-reject,4-cancel  -->
                    <option value="1" <?php if(@$get_type=="1"){?> selected="selected"<?php } ?>>Pending</option>
                    <option value="4" <?php if(@$get_type=="4"){?> selected="selected"<?php } ?>>Payment Hold</option>
                    <option value="3" <?php if(@$get_type=="3"){?> selected="selected"<?php } ?>>Complete</option>
                    <option value="2" <?php if(@$get_type=="2"){?> selected="selected"<?php } ?>>Reject</option>
                  </select>
                </div>

                
              <!-- /.box-body -->
              <div align="right" class="box-footer">
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <button type="submit" class="<?= $btncolor; ?>"><i class="fa fa-save"></i>&nbsp; Update</button>
                <?php }else{ ?>
                <button type="submit" class="<?= $btncolor; ?>"><i class="fa fa-save"></i>&nbsp; Save</button>
                <?php } ?>
              </div>
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
                <th width="20">Staff Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Leaves Status</th>
                <th width="140">Created by</th>
                <th width="20">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; 
              while($row=mysqli_fetch_array($result)){ $num=$num+1; 

            
                ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <td align="center"><?php echo $num; ?></td>
                <td>
                  <?php  
                    if($row['rechargefinestatus']=='1'){
                      echo "<a href='$pageurl?mode=update_status&status=0&id=".$row['ID']."'><small class='label bg-green'>Active</small></a>";
                    }else{
                      echo "<a href='$pageurl?mode=update_status&status=1&id=".$row['ID']."'><small class='label bg-red'>Inactive</small></a>";
                    }
                  ?>
                </td>
                <td align="center"><?php echo $row['staffname']; ?></td>
                <td valign="middle">
                  <!-- 1-recharge,2-rewards,3-fine  -->
                  <span class="text-green bold font-15">Type: </span><span><?php  if($row['recharge_fine_type'] == 1)
                    { 
                      echo $type = 'Recharge';
                    }else if($row['recharge_fine_type'] == 2){
                      echo $type ='Rewards';
                    }else if($row['recharge_fine_type'] == 3){
                      echo $type ='Fine';
                    }

                  ?></span><br>


                </td>
                <td align="center"><?php echo $row['rechargefineprice']; ?></td>
                <td><?php if($row['rechargefinetype'] == 1) {echo 'Pending'; }else if($row['rechargefinetype'] == 2) {echo 'Reject'; }else if($row['rechargefinetype'] == 3) {echo 'Complete'; }else if($row['rechargefinetype'] == 4) {echo 'Payment Hold'; } ?></td>
                <td title="Modified on: <?php echo $row['modifiedon']; ?>"><?php echo formatDate($row['cdate']); ?></td>
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