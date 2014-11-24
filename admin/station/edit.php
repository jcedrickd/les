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
$getValiD = $_GET['getValiD'];
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
var x=check_required('stDesc','Station Description','inputError');
var y=check_required('stSap','Sap Code','inputError');
var z=check_required('stID','Station Id','inputError');
	return x && y && z;
}
</script>
        
        <title></title>
    </head>
    <body>
<div id="wrapper">
<b class="module">Station ID</b>
<span id="inputError"></span>
<form onSubmit="return checkrequired(this)" method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='station.php'" />
    </div>
</div>

<fieldset style="float:left;width:600px;">

<div>
<?php
//EDIT QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');

if (isset($_POST['save'])){
$StationId = strtoupper($_POST['StationId']);
$StationDescription = strtoupper($_POST['StationDescription']);
$SapCode = strtoupper($_POST['SapCode']);
$StationQry = "UPDATE branch SET branch_description='$StationDescription', sap_code='$SapCode', date_override=GETDATE() WHERE  branch_code='$getValiD'";

$StationUpdate = sybase_query($StationQry);

if(!$StationUpdate){
 echo "Unable to add Menu Category!";
}
else{
redirect('station.php');
}

sybase_close($link);
}

?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query=sybase_query("SELECT * FROM branch WHERE branch_code ='$getValiD'");
while($row=sybase_fetch_array($query)){
?>
<label class="field">Statn. Code:</label> 	
<input type="text" id="stID" name="StationId" value="<?php echo @$row["branch_code"] ?>" class="input" disabled/></div>

<div><label class="field">Statn. Desc.:</label>
<input type="text" id="stDesc" name="StationDescription" value="<?php echo @$row["branch_description"] ?>" class="input bigtxt"  maxlength="50"/></div>

<div><label class="field">Statn. SAP Code:</label>		
<input type="text" id="stSap" name="SapCode" maxlength="3" value="<?php echo @$row["sap_code"] ?>" class="input" /></div>

</fieldset>
</form>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
?>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>