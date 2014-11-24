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
$getValiD=$_GET['getValiD'];
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
        <title></title>
    </head>
    <body>
	
<div id="wrapper">
<b class="module">Container Type</b>
<span id="inputError"></span>
<form onSubmit="return checkrequired(this)" method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="return check_required('ContainerDescriptioniD','Container Description','inputError');" />
    </div>
    <div class="form-group">
<input type="button" onClick="history.go(-1);return true;" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='container.php'" />
    </div>
</div>

<?php
//$link=odbc_connect("Driver={Adaptive Server Anywhere 7.0};Server=192.168.2.52;Database=wms_barcode;", "dba", "sql");

	@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
	@$db = @sybase_select_db("seales");

if (isset($_POST['save'])){
$ContainerDescription = strtoupper($_POST['ContainerDescription']);
$Cntr = "UPDATE cntr_type SET cntr_desc='$ContainerDescription' WHERE cntr_code=$getValiD";

$CntrUpdate = sybase_query($Cntr);

if(!$CntrUpdate){
 echo "Unable to add Container Description";
}
else{
redirect('container.php');
}
}
?>


<fieldset style="float:left;width:600px;">
<thead>
	<tr>
	<label class="field">Cntr. Desc.:</label>
	</tr>
</thead>
<tbody>	
<?php
//$link=odbc_connect("Driver={Adaptive Server Anywhere 7.0};Server=192.168.2.52;Database=wms_barcode;", "dba", "sql");

	@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
		@$db = @sybase_select_db("seales");

	/*if ($link) {
		echo "Sybase Connection Successful";
	}
	else {
		echo "Sybase Connection Failed";
	}*/
        //sybase_close($link);
$query=sybase_query("SELECT * FROM cntr_type WHERE cntr_code=$getValiD");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
	<tr>
	<td><input type="text" id="ContainerDescriptioniD" name="ContainerDescription" class="input bigtxt" value="<?php echo @$row["cntr_desc"] ?>"  maxlength="30"/></td>
	</tr>	
</tbody>
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