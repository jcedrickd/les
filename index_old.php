<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<!--<script src="jquery-1.9.1.min.js"></script>-->
<meta name="description" content="" />

<link rel="icon" href="http://192.168.2.81/les_old_web/includes/favicon.ico" />

<meta name="keywords" content="" />

<meta name="author" content="" />

<link rel="stylesheet" type="text/css" href="login.css" media="screen" />

<title>Logistics Enterprise System</title>
<script>
/**$(document).ready(function(){
     $("#forgotpassworddiv").hide();
  $("#forgotpasswordlink").click(function(){
    $("#forgotpassworddiv").fadeToggle(1000);
  });
});**/
function username_focus(){
username.focus();
}
</script>
</head>

	<body onLoad="username_focus();">

		<div id="wrapper">

<div id="header">
<?php 
include('includes/header.php');
?>
</div> <!-- end #header -->

<!--<div id="nav">
 <?php 
//include('includes/nav.php');
?>
</div> --> <!-- end #nav -->

<div id="content">
    <br /><br />
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
if(isset($_POST['loginbutton']) && (strlen($_POST['username'])>0 || strlen($_POST['password'])>0)){
include('includes/sybase_connect.php');
$usercode=trim(strtoupper($_POST['username']));
$query="SELECT user1,fullname,sat_group FROM useracc WHERE user1='$usercode' AND mainscreen='$_POST[password]'"; 
$rs = sybase_query($query) or die("Cannot execute query: $query\n");
$result=sybase_fetch_array($rs);
if(sybase_num_rows($rs)>0){
    sybase_free_result($rs);
    sybase_close($link);
    header('location:home.php');
    session_start();
    $_SESSION['username']=$usercode;
	$_SESSION['fullname']=$result['fullname'];
	$_SESSION['sat_group']=$result['sat_group'];
    $_SESSION['login']=true;
}
else{
    sybase_free_result($rs);
    sybase_close($link);
    echo '<p style=color:red>Username or password is invalid</p>';
    }
}
?>
    <form name="loginform" method="POST" action="index.php">
Username: <input type="text" name="username" value=""  style="text-transform: uppercase" id="username" />
Password: <input type="password" name="password" value=""  />
        <input type="submit" value="Log In" name="loginbutton"  />        
    </form>

    <br />
    <p id="forgotpasswordlink" style="display: none">Forgot Password?</p>
    <br /><br />
    <div id="forgotpassworddiv" style="display: none">
    <form name="forgotpasswordform" method="get" action="index.php">
Email Address: <input type="text" name="mail" value="" />
<input type="submit" value="Send Password" name="sendpassword" />
    </form>    
<?php 
if(isset($_GET['sendpassword'])){
if(filter_var($_GET['mail'],FILTER_SANITIZE_EMAIL)==true && filter_var($_GET['mail'],FILTER_VALIDATE_EMAIL)==true){
 include('connect.php');    
$p="userpassword";
$m=$_GET['mail'];   
$query="SELECT $p FROM useraccess WHERE user_email='$m'";
$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");
if(pg_num_rows($rs)>0){
$row=  pg_fetch_row($rs);
pg_close($con); 
ini_set("smtp_port","465");
$to=$_GET['mail'];
//$to="felix_labayen@aai.com.ph";
$subject = "WMS Password Recovery";
$txt = "Your password has been retrieved. "
."This is your password: " .$row[0] 
." .You can now visit the <a href=http://wmsonline.aai.com.ph/les>WMS website of AAI</a>."; 
$headers = "From: aaisender@aai.com.ph" . "\r\n" .
"CC: " .$_GET['mail'];
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($to,$subject,$txt,$headers);
echo '<br /><br />';
echo '<font color=green>Congratulations! You can now check your e-mail to see your password.';
}
else{
echo '<font color=red>Your e-mail address does not exists in this system.</font>';   
}       
 }
else{
echo '<font color=red>E-mail address is invalid.</font>';
}
}
?>
    </div>
</div> <!-- end #content -->

<div id="sidebar">
<!-- <?php
include('includes/sidebar.php');
?> -->
</div> <!-- end #sidebar -->

<div id="footer">
<?php 
include('includes/footer.php');
?>
</div> <!-- end #footer -->

		</div> <!-- End #wrapper -->

	</body>

</html>

