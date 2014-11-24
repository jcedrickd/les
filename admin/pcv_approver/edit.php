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
	var x = check_required('pcvId','PCV Station ID','inputError');
	var y = check_required('pcvTyp','Service Type','inputError');
		return x && y;
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
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='pcv_approver.php'" />
    </div>
</div>
<fieldset style="float:left;width:600px;">
<div>
<?php
//EDIT QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');

if (isset($_POST['save'])){
$rePCVNo = $_POST['requiredpcvapprv_ctrlno'];
$reCode = strtoupper($_POST['PCVCode']);
$reQiD = strtoupper($_POST['PCVStationID']);
$reServiceType = strtoupper($_POST['ServiceType']);
$pcvAQry = "UPDATE pcv_approver SET code='$reCode',station_id='$reQiD',service_type='$reServiceType' WHERE pcvapprv_ctrlno = $rePCVNo";

$pcvAUpdate = sybase_query($pcvAQry);

if(!$pcvAUpdate){
echo "Unable to add PCV Information!";
}
else{
redirect('pcv_approver.php');
}
}

?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$getValiD = $_GET['getValiD'];
$query=sybase_query("SELECT * FROM pcv_approver WHERE pcvapprv_ctrlno =$getValiD");
while($row=sybase_fetch_array($query)){
?>
<label class="field">PCV Code:</label> 	
<input type="text" value="<?php echo @$row['code']; ?>" class="input" disabled/>
<input type="hidden" name="PCVCode" value="<?php echo @$row['code']; ?>" class="input"/></div>

<div><label class="field">PCV Statn. ID:</label>
<input type="text" id="pcvId" name="PCVStationID" maxlength="3" value="<?php echo @$row['station_id']; ?>" class="input" /></div>

<div><label class="field">PCV Srvc. Type:</label>		
<input type="text" id="pcvTyp" name="ServiceType" maxlength="2" value="<?php echo @$row['service_type']; ?>" class="input" /></div>
		
<input type="hidden" name="requiredpcvapprv_ctrlno" value="<?php echo @$row['pcvapprv_ctrlno']; ?>" class="input"/>

</fieldset>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
?>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>