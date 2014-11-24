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
    <!--div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="add" value="Add" onClick="return();" />
    </div-->
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="
return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='dept.php'" />
    </div>
</div>
<fieldset style="float:left;width:600px;">
<br />
<input type="hidden" name="foreign_recno_dbid" value="<?php echo @$_GET['foreign_recno_dbid']; ?>" />
<input type="hidden" name="recno" value="<?php echo @$_GET['recno']; ?>" />
<?php
//ADD QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 

if(isset($_POST['save'])){
$dept_code = strtoupper($_POST['DepartmentCode']);
$dept_desc = strtoupper($_POST['DepartmentDescription']);
$SapCode = strtoupper($_POST['SapCode']);

$sql="INSERT INTO department (dept_code, dept_desc, sap_code) VALUES ('$dept_code', '$dept_desc', '$SapCode')";
$insDept = sybase_query($sql);
if (!$insDept) {
 echo "Unable to add Container Description";
}
else{
redirect('dept.php');
}
sybase_close($link);
}?> 
<div><label class="field">Dept. Code:</label> 	
<input type="text" id="DeptInfo" name="DepartmentCode" value="" class="input" placeholder="Department Code" maxlength="12"/></div>

<div><label class="field">Dept. Desc:</label>
<input type="text" id="DeptInfoCode" name="DepartmentDescription" value="" class="input" placeholder="Department Description" maxlength="50"/></div>

<div><label class="field">Dept. SAP Code:</label>		
<input type="text" name="SapCode" maxlength="3" value="" class="input" placeholder="Department SAP Code"/></div>


</fieldset>
</form>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>