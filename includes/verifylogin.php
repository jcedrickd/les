<?php
$username=$_SESSION['username'];
if(!isset($_SESSION['login']) || $_SESSION['login'] !== true && !isset($_SESSION['username']) || $_SESSION['username']==false){
// not logged in, move to login page
    header('location:http://'.$_SERVER['SERVER_NAME'].'/les/index.php');
}
?>