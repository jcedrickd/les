<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
<?php 
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/verifylogin.php');
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
	
        <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 
		<!--js validation-->
        <script src="http://wmsonline.aai.com.ph/usual_js/decimal_only.js"></script>
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
			
<script>
		function validate_many(){
var x=check_required('pcvNo','PCV Code','inputError');
var y=check_required('pcvId','Station ID','inputError');
var z=check_required('pcvTyp','Service Type','inputError');
	return x && y && z;
}
</script>
        <title></title>
    </head>
    <body>
<div id="wrapper">
<b class="module">PCV Approver</b>
<span id="inputError"></span>
<form onSubmit="return checkrequired(this)" method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
    <!--div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="add" value="Add" onClick="return();" />
    </div-->
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='pcv_approver.php'" />
    </div>
</div>
<fieldset style="float:left;width:600px;">
<br />
<input type="hidden" name="foreign_recno_dbid" value="<?php echo @$_GET['foreign_recno_dbid']; ?>" />
<input type="hidden" name="recno" value="<?php echo @$_GET['recno']; ?>" />
<?php
//EDIT QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');

if (isset($_POST['save'])){
$reCode = strtoupper($_POST['PCVCode']);
$reQiD = strtoupper($_POST['StationID']);
$reServiceType = strtoupper($_POST['ServiceType']);
$pcvAQry = "INSERT INTO pcv_approver (code, station_id,service_type) VALUES ('$reCode','$reQiD','$reServiceType')";
$pcvAUpdate = sybase_query($pcvAQry);

if(!$pcvAUpdate){
 echo "Unable to add PCV Information!";
}
else{
redirect('pcv_approver.php');
}
}
?>
<div><label class="field">PCV Code:</label> 	
<input type="text" id="pcvNo" name="PCVCode" value="" class="input" placeholder="PCV Code" maxlength="12"/></div>

<div><label class="field">PCV Statn. ID:</label>
<input type="text" id ="pcvId" name="StationID" maxlength="3" value="" class="input" placeholder="PCV Station ID"/></div>

<div><label class="field">PCV Srvc. Type:</label>		
<input type="text" id = "pcvTyp" name="ServiceType" maxlength="2" value="" class="input" placeholder="PCV Service Type"/></div>

</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>