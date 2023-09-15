<?php 
require('check.php');
$pageurl = "popup-query$extn";
$pagename = "Popup Form Query";
$tblname = "popupform";
$id = @$_GET['id']; 

// Delete Query
if(@$_GET['mode']=="delete" && $id !=""){
  // $sql = "DELETE FROM `$tblname` WHERE ID='$id'";
  $sql="UPDATE `$tblname` SET hide ='1' WHERE ID='$id'";
  if (!mysqli_query($con,$sql)){die('Error: ' . mysqli_error($con)); }
   echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=$pageurl?msgdanger=Query%20Deleted%20successfully...'>";  exit(0);
}

//Select Query to display the records
$sql    = "SELECT * FROM `$tblname` WHERE hide='0' ORDER BY ID desc";
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
      <div class="<?php echo $boxcolor; ?>">
        <div class="box-header with-border">
          <h3 class="box-title text-blue"><?php echo $pagename. ' ('. $rowcount. ') '; ?></h3>
          <a href="<?=$pageurl;?>"> <i class="fa fa-refresh text-green"></i></a>
        </div>
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
                <th width="20">ID</th>
                <th width="150">Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>City</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php $num=0; while($row=mysqli_fetch_array($result)){ $num=$num+1; ?>
              <tr>
                <!-- <td><input type="checkbox" class="td" name="ids[]" value="<?php echo $row['ID'] ?>" style="cursor:pointer;"></td> -->
                <td><?php echo $num; ?></td>
                <td align="left"><?php echo $row['createdon']; ?><br><span style="font-style: italic; color: green;">IP: <?php echo $row['ip']; ?></span></td>
                <td align="left"><?php echo $row['name']; ?></td>
                <td align="left"><i class="fa fa-envelope text-blue"></i> <?php echo " ".$row['email']; ?></td>
                <td align="left"><i class="fa fa-phone text-red"></i> <?php echo " ".$row['mobile']; ?></td>
                <td align="left"><?php echo $row['location']; ?></td>
                <td>
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