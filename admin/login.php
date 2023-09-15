<?php 
require('config.inc.php');

//if session is there then redirect us to dashboard page
if(isset($_COOKIE['ADMIN_USERNAME'])){
  echo"<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=dashboard$extn'>";  
  exit(0); 
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $admintitle; ?> | Admin Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="Shortcut Icon" href="../uploads/favicon.png" type="image/x-png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Field validation (check for blank fields) -->
  <script src="assets/js/FieldValidation.js"></script>
  <script>
    function check_blank_login() {
      if(isblank(document.getElementById("username"))) {
        alert("Error! You must enter Login ID/E-mail");
        document.getElementById("username").focus();
        return false;
      }

    if(isblank(document.getElementById("password"))) {
        alert("Error! You must enter a password...");
        document.getElementById("password").focus();
        return false;
      }
    }
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<img src="<?= UPLOAD_PATH.'/'.APP_LOGO; ?>" alt="Bonitaa Logo" width="150">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="text-center"><?= APP_NAME; ?></h3>
    <?php 
    if(@$_GET['msg']==''){
      echo '<p class="login-box-msg">Login Now</p>';
    }else{
      echo '<p class="login-box-msg text-red text-bold">' . $_GET['msg']. '</p>';
    }?>

    <form action="verify.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" placeholder="Username OR Email ID">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" onclick="return check_blank_login();" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
