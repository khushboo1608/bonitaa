<?php require('check.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $admintitle; ?> | Dashboard</title>
  <?php require('bootstrap.inc.php'); ?>  
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
      <h1> Dashboard <!-- <small>Version 1.0</small> --> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-th-large"></i></span>
            <a href="category<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Category</span>
                <span class="info-box-number"><?php getCountWhere($con,'category',"WHERE hide=0"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="subcategory<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Sub Category</span>
                <span class="info-box-number"><?php getCountWhere($con,'subcategory',"WHERE hide=0"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>
            <a href="subsubcategory<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Sub Sub Category</span>
                <span class="info-box-number"><?php getCountWhere($con,'subsubcategory',"WHERE hide=0"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
            <a href="services<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Services</span>
                <span class="info-box-number"><?php getCountWhere($con,'services',"WHERE hide=0"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Appointment</span>
                <span class="info-box-number"><?php getCount($con,'orders'); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Appointment Pending</span>
                <span class="info-box-number"><?php getCountWhere($con,'orders',"WHERE payment_type='1'"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Appointment Completed</span>
                <span class="info-box-number"><?php getCountWhere($con,'orders',"WHERE payment_type='3'"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
            <a href="order<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Appointment Rejected</span>
                <span class="info-box-number"><?php getCountWhere($con,'orders',"WHERE payment_type='5'"); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-vcard"></i></span>
            <a href="users<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Registered Users</span>
                <span class="info-box-number"><?php getCount($con,'user_registration'); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-comment"></i></span>
            <a href="contact<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Enquiry</span>
                <span class="info-box-number"><?php //getCountWhere($con,'contact',"WHERE hide='0'"); ?></span>
              </div>
            </a> -->
            <!-- /.info-box-content -->
          <!-- </div> -->
          <!-- /.info-box -->
        <!-- </div> -->
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file-image-o"></i></span>
            <a href="banner<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Banners</span>
                <span class="info-box-number"><?php getCount($con,'banner'); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-question-circle fa-1.5x"></i></span>
            <a href="faqs<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total FAQ's</span>
                <span class="info-box-number"><?php //getCount($con,'faqs'); ?></span>
              </div>
            </a> -->
            <!-- /.info-box-content -->
          <!-- </div> -->
          <!-- /.info-box -->
        <!-- </div> -->
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-cyan"><i class="fa fa-quote-left"></i></span>
            <a href="testimonials<?= $extn; ?>">
              <div class="info-box-content">
                <span class="info-box-text">Total Testimonials</span>
                <span class="info-box-number"><?php getCountWhere($con,'review',""); ?></span>
              </div>
            </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->



      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <!-- /.box -->
          
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <?php /* ?>
          <div class="box box-info">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: flex; justify-content: center;height: 300px;">
              <h1 style="margin-top: 120px;">Welcome to <?= $webtitle; ?> Dashboard</h1>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
            <!-- /.box-footer -->
          </div>
          <?php */ ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer include  -->
<?php require('footer.inc.php'); ?>  
</div>
<!-- ./wrapper -->  
<?php require('plugin.inc.php'); ?>
</body>
</html>
