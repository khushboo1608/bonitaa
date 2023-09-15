
<header class="main-header">
  <!-- Logo -->
  <a href="<?= SITE_PATH; ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="<?= $admin_small_logo; ?>" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <!-- <span class="logo-lg"><b>Ekdiary </b>Admin</span> -->
    <span class="logo-lg"><img src="<?= UPLOAD_PATH.'/'.APP_LOGO; ?>" alt="" style="margin-bottom: 10px;"></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top"> 
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- Notifications: style can be found in dropdown.less -->
        <!-- Tasks: style can be found in dropdown.less -->
        <!--<li><a href="contact.php" title="Contact Enquriy"><i class="fa fa-bell-o"></i>-->
            <span class="label label-danger font-12"><?php //getCountWhere($con,'contact', "WHERE hide='0' AND seen='0'"); ?></span>
        <!--</a></li>        -->
        <!-- User Account: style can be found in dropdown.less -->
        <!-- Control Sidebar Toggle Button -->
        <!-- <li><a href="#" data-toggle="control-sidebar" title="Theme Setting"><i class="fa fa-gears"></i></a></li> -->
        <li><a href="<?= SITE_PATH; ?>" target="_new">Vist Website</i></a></li>
        <li><a href="logout<?= $extn; ?>" title="Logout"><i class="fa fa-sign-out"></i></a></li>
      </ul>
    </div>

  </nav>
</header>