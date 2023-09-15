<?php
require('check.php');
$pageurl = "users$extn";
$pagename = "Users";
$tblname = "user_registration";
$id = @$_GET['id'];
$img_required = 'required';

// Get POST Values
// $CID       = get_safe_value($con,@$_POST['category_id']);
$userfullname = get_safe_value($con,@$_POST['user_fullname']);
$usermobile   = get_safe_value($con,@$_POST['user_mobile']);
$useremail    = get_safe_value($con,@$_POST['user_email']);
$usercityid    = get_safe_value($con,@$_POST['user_city_id']);
// $userpass     = get_safe_value($con,@$_POST['user_pass']);
$sessionid = date('YmdHis');

// Image Upload Code
$ext="";
if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
  $filename    = strtolower(basename($_FILES['dp']['name']));
  $ext         = substr($filename, strrpos($filename, '.') + 1);
  $namefile    = str_replace(".$ext","", $filename);
  $newfilename = "users-".date("ymdHis");
  //Determine the path to which we want to save this file
  $ext=".".$ext;
  $newname = '../uploads/users/'.$newfilename.$ext;
  move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
} 
if($ext==""){$pic="";} else {$pic="$newfilename$ext";}  

// Insert new entry Query
if(@$_GET['mode']=="addnew"){

  // check for duplicate entry is there or not
  $sql = mysqli_query($con,"SELECT * FROM `$tblname` WHERE email='$useremail' OR mobile='$usermobile'");
  $check = mysqli_num_rows($sql);
  if($check>0){
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?dupl_msg=User Already Exist...'>";  exit(0);
  }else{
    $sql = "INSERT INTO `$tblname`(`status`,`name`, `email`, `mobile`, `dp`,`city_id`,`sessionid`, `ip`, `createdon`) 
    VALUES ('1','$userfullname', '$useremail', '$usermobile', '$pic','$usercityid', '$sessionid', '$ipa', '$now')";
    if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=User%20Created%20Successfully...'>";  exit(0);
  }
}

// Row Update Query 
else if(@$_GET['mode']=="update" && $id !=""){
  $img_required ="";
  $sql="UPDATE `$tblname` SET `name`='$userfullname', `email`='$useremail', `mobile`='$usermobile', `city_id`='$usercityid' WHERE ID =$id";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }

  // Edit Image Upload Code
  $ext="";
  if((!empty($_FILES["dp"])) && ($_FILES['dp']['error'] == 0)){
    $filename    = strtolower(basename($_FILES['dp']['name']));
    $ext         = substr($filename, strrpos($filename, '.') + 1);
    $namefile    = str_replace(".$ext","", $filename);
    $newfilename = "users-".date("ymdHis");
    //Determine the path to which we want to save this file
    $ext=".".$ext;
    $newname = '../uploads/users/'.$newfilename.$ext;
    move_uploaded_file($_FILES['dp']['tmp_name'],$newname);  
  } 
    if($ext!=""){$pic="$newfilename$ext";
      $sqlx="UPDATE `$tblname` SET `dp`='$pic' WHERE ID='$id'"; 
      if (!mysqli_query($con,$sqlx)){die('Error: ' . mysqli_error($con)); } 
    } 
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=$pagename%20Updated%20Successfully...'>";  exit(0);
}



// Delete Query
if(@$_GET['mode']=="delete" && $id !=""){
  $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  // $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Users%20Deleted%20successfully...'>";  exit(0);
}
// Statue Update Query
else if(@$_GET['mode']=="update_status" && $id !=""){
  $status = get_safe_value($con,$_GET['status']);
  $sql="UPDATE `$tblname` SET status ='$status' WHERE ID ='$id'";
  if (!mysqli_query($con,$sql)){die('Invalid query: ' . mysqli_error($con)); }
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msg=User%20Status%20updated%20Successfully !!'>"; exit(0);
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
    //   $get_userpass = $row['password'];
      $get_pic      = $row['dp'];
      $get_city      = $row['city_id'];
    }
  }else{
    echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Dont change in URL...'>";  exit(0);
  }
}


//Select Query to display the records
$sql    = "SELECT *,user_registration.city_id as cityid, city.name as cityname,user_registration.ID as ID, user_registration.name as username,user_registration.status as status,user_registration.dp as dp FROM `$tblname` 
left join city on city.ID = user_registration.city_id
ORDER BY user_registration.ID desc";
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
                  <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?= @$get_fullname; ?>" placeholder="Enter User Full Name" required>
                </div>
                <div class="form-group col-md-6">
                  <label>Mobile No<span class="text-red">*</span></label>
                  <input type="text" class="form-control" id="user_mobile" name="user_mobile" value="<?= @$get_mobile; ?>" placeholder="Enter User Mobile No." required>
                </div>
                <div class="form-group col-md-6">
                  <label>Email ID<span class="em font-12">(Optional)</span></label>
                  <input type="email" class="form-control" id="user_email" name="user_email" value="<?= @$get_email; ?>" placeholder="Enter user Email ID">
                </div>

                <div class="form-group col-md-6">
                  <label for="category_id">City <span class="text-red">*</span></label>
                  <select class="form-control" name="user_city_id" required id="user_city_id">
                    <option class="text-blue bold">Select City</option>
                    <?php  
                      $res = mysqli_query($con,"SELECT city.ID,city.name FROM `city` where city.status=1 ORDER BY city.ID ASC");
                      while ($row = mysqli_fetch_array($res)) {
                        // echo 'c_id:'.$get_cid;
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

                <!--<div class="form-group col-md-6">-->
                <!--  <label>Password<span class="text-red">*</span></label>-->
                <!--  <input type="text" class="form-control" name="user_pass" value="<?= @$get_userpass; ?>" placeholder="Enter user Password" required>-->
                <!--</div>-->

                <div class="form-group col-md-6">
                  <label for="course_img"> <span class="text-red">Cover Image (Size: 400x400px)</span> </label><br>
                  <span class="btn btn-primary margin">
                    <input type="file" name="dp" id="dp" class="img" style="width:250px;" <?= $img_required; ?>>
                  </span>
                </div>
                <?php if(@$_GET['mode']=="edit" && @$_GET['id']!="") { ?>
                <div class="form-group col-md-3">
                  <img src="<?= UPLOAD_PATH.'users/'.$get_pic; ?>" width="100" height="100" alt="" style="border: 1px solid grey;padding: 2px; border-radius: 10px;">
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
                    <th width="150">Name</th>
                    <th width="30">City Name</th>
                    <th width="50">Img</th>
                    <th width="100">Login info</th>
                    <th width="100">Created on</th>
                    <th width="20">Action</th>
                    <!--<th width="20"></th>-->
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
                    <td align="left"><?php echo $row['username']; ?></td>
                    <td align="left"><?php echo $row['cityname']; ?></td>
                    <td align="center">
                        <?php if($row['dp']!=""){ ?>
                            <img src="<?= UPLOAD_PATH.'users/'.$row['dp']; ?>" width="50" height="50" style="border-radius:10%;">
                        <?php } ?>
                    </td>
                    <td align="left">
                      <i class="fa fa-envelope text-blue"></i> <span class="text-blue bold"><?php echo $row['email']; ?></span><br>
                      <i class="fa fa-phone text-red"></i><span class="text-red"> <?php echo $row['mobile']; ?></span><br>
                      <!--<i class="fa fa-key text-green"></i><span title="User Password" class="text-green bold"> <?php echo $row['password']; ?></span>-->
                    </td>
                    <td align="left"><?php echo $row['createdon']; ?><br><span style="font-style: italic; color: green;">IP: <?php echo $row['ip']; ?></span></td>
                    <td>
                      <a href="<?= $pageurl; ?>?mode=edit&id=<?php echo $row['ID'] ?>" title="Edit"><i class="fa fa-edit"></i>&nbsp;</a>
                      <a onClick="return verifCompare();" href="<?= $pageurl; ?>?id=<?php echo $row['ID'] ?>&mode=delete" class="text-red" title="Delete"><i class="fa fa-trash-o"></i>&nbsp;</a>
                    </td>
                    <!--<td>-->
                    <!--<a href="../forcelogin.php?id=<?= base64_encode($row['sessionid']); ?>" target='_blank'><img src='../uploads/general/forcelogin.png' width='22' /></a>-->
                    <!--</td>-->
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

<style>
  .error{
    color: red;
  }
</style>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
    
var $registrationForm = $('#frmCompare');
if($registrationForm.length){
  $registrationForm.validate({
      rules:{
          user_fullname: {
              required: true
          }
          
      },
      messages:{
          user_fullname: {
              required: 'Please enter user name!'
          }
      },
      errorPlacement: function(error, element) 
      {
        if (element.is(":radio")) 
        {
            error.appendTo(element.parents('.gender'));
        }
        else if(element.is(":checkbox")){
            error.appendTo(element.parents('.hobbies'));
        }
        else 
        { 
            error.insertAfter( element );
        }
        
       }
  });
}

</script>

</body>
</html>