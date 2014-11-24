<?php 
session_start();
// if the user is logged in, unset the session
if(isset($_SESSION['login'])){
unset($_SESSION['login']);
unset($_SESSION['username']);
unset($_SESSION['fullname']);
unset($_SESSION['sat_group']);
}
//$loc=  include($_SERVER['DOCUMENT_ROOT'].'WMS/index.php');
header('location:index.php');
?>
