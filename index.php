<?php
require_once("includes/db_connect.php");
require_once("includes/login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="includes/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
	  <form action="" method="POST">
      <div class="modal-body">
        
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="forgotUsername" name="forgotUsername" placeholder="Enter username" required>
			</div>
			<div class="form-group">
				<label for="emailAddress">Email address</label>
				<input type="email" class="form-control" id="forgetEmail" name="forgetEmail" placeholder="Enter email address" value="@aai.com.ph" required>
			</div>
		
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="forgotPass" class="btn btn-primary">Send</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<div class="container">
<div class="row" style="margin-top: 80px;">

    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <img src="http://wmsonline.aai.com.ph/AAIWL_Letterhead.png" title="AAI"/>
        <h2 class="lestitle">Logistics Enterprise System</h2>
    </div>
    <div class="col-lg-2">

    </div>

</div>
<div class="row" style="margin-top: 50px">
    <div class="col-lg-4 col-md-3">

    </div>
    <div class="col-md-6 col-lg-4">
	<?php 
	if (!empty($error))
		echo "<div class=\"alert alert-warning alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>
  <strong>Warning!</strong> $error.</div>";
	?>
    <form class="form-signin" role="form" method="POST">
        <h3 class="form-signin-heading">Please sign in</h3>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputUser" class="form-control" placeholder="Username" name="username" required autofocus>
        <br/>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <div class="checkbox">
            <label class="rememberme">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
		<p align="right"><a class="forgotpassword" class="forgotpassword">I forgot my password</a></p>
    </form>
    </div>
    <div class="col-lg-4 col-md-4">

    </div>
</div> <!-- /container -->
</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$(".forgotpassword").click(function(){

	$("#myModal").modal("show");
	});
});
</script>
</body>
</html>