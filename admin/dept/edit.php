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
var x=check_required('DeptInfo','Department Code','inputError');
var y=check_required('DeptInfoCode','Department Description','inputError');
	return x && y;
}
</script>      
        <title></title>
</head>

    <body>
<div id="wrapper">
<b class="module">Department List</b>
<span id="inputError"></span>
<form onSubmit="return checkrequired(this)" method="post" id="form">

<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="
return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='dept.php'" />
    </div>
</div>
<fieldset style="float:left;width:600px;">

<div>

<?php
//EDIT QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');

if (isset($_POST['save'])){
$deptCode = strtoupper($_POST['DepartmentCode']);
$deptDesc = strtoupper($_POST['DepartmentDescription']);
$sapCode = strtoupper($_POST['SAPCode']);
$deptQry = "UPDATE department SET dept_desc='$deptDesc', sap_code='$sapCode' WHERE dept_code='$getValiD'";

$deptUpdate = sybase_query($deptQry);

if(!$deptUpdate){
 echo "Unable to add Department Information";
}
else{
redirect('dept.php');
}
}

?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query=sybase_query("SELECT * FROM department WHERE dept_code = '$getValiD'");
while($row=sybase_fetch_array($query)){
?>
<label class="field">Dept. Code:</label> 	
<input type="text" id="DeptInfo" name="DepartmentCode" value="<?php echo @$row["dept_code"] ?>" class="input" disabled/></div>

<div><label class="field">Dept. Desc:</label>
<input type="text" id="DeptInfoCode" name="DepartmentDescription" value="<?php echo @$row["dept_desc"] ?>" class="input bigtxt" maxlength="50"/></div>

<div><label class="field">Dept. SAP Code:</label>		
<input type="text" id="DeptInfo" name="SAPCode" maxlength="3" value="<?php echo @$row["sap_code"] ?>" class="input"/></div>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
?>
</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>