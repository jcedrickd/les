<?php
$sybase = new db_connect();

if (isset($_SESSION['username'])) {
    $table = "useracc";
    $condition = "user1 = '" . $_SESSION['username'] . "'";
    $fields = array('user1', 'fullname', 'sat_group');
    $getAccess = $sybase->get_records($table, $fields, $condition);

    if (!empty($getAccess))
        header("Location : home.php");
}
if (isset($_POST['submit']))
{
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    if (empty($username))
        $error  = "Please enter username.";

    if (empty($password))
        $error  = "Please enter password";

    $table      = "useracc";
    $condition  = "user1='$username' AND mainscreen='$password'";
    $fields     = array('user1','fullname','sat_group');
    $getAccess  = $sybase->get_records($table,$fields,$condition);
    if (!empty($getAccess))
	{
		foreach ($getAccess as $getVal)
		{
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['fullname']=$getVal->fullname;
			$_SESSION['sat_group']=$getVal->sat_group;
			$_SESSION['login']=true;

			header('location: home.php');
		}
	}
	else
		$error	= "Invalid username or password";
}

if (isset($_POST['forgotPass']))
{
	$username	= $_POST['forgotUsername'];
	$email		= $_POST['forgetEmail'];
	
	$table      = "useracc";
	$condition  = "user1='$username' AND user_email='$email'";
    $fields     = array('password','fullname');
	
	$retAccount	= $sybase->get_records($table,$fields,$condition);
	foreach($retAccount as $retVal)
	{
		$userPassword	= $retVal->password;
		$fullname		= $retVal->fullname;
	}
	
	if (!empty($retAccount))
	{
		$to 		= $email;
		//$to			= "cedrickdayangco@gmail.com";
		$subject 	= "WMS Password Recovery";
		$messege 	= "Mr/Mrs $fullname, <br/><br/>
		Your password has been retrieved. <br/>
		This is your password: $userPassword. <br/><br/>
		You can now visit the <a href='http://wmsonline.aai.com.ph/les'>WMS website of AAI</a>."; 
		
		$headers = "From: aaisender@aai.com.ph" . "\r\n" .
		"CC: " .$email;
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		ini_set("smtp_port","465");
		if (mail($to,$subject,$messege,$headers))
			header("LOCATION : index.php?success=1");
		else
			$error	= "Sending email failed. Please try again.";
	}
	else
	{
		$error	= "Invalid username or email address.";
	}
}
?>