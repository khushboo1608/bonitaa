<?php 
require('config.inc.php');
unset($_SESSION['ADMIN_USERNAME']);
if (isset($_COOKIE['ADMIN_USERNAME'])) {
    unset($_COOKIE['ADMIN_USERNAME']); 
    setcookie('ADMIN_USERNAME', null, -1); 
}
header('location: login.php?msg=Logout%20Successfully');
die();

?>