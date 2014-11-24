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
var x=check_required('McatNo','Menu Catergory Control No','inputError');
var y=check_required('McatName','Menu Category Name','inputError');
	return x && y;
}
</script>
		
        <title></title>
		
    </head>
    <body>
<div id="wrapper">
<b class="module">Menu Category</b>
<span id="inputError"></span>
<form onSubmit="return checkrequired(this)" method="post" id="form">
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<input type="submit" class="btn btn-danger css_button btn-xs" name="save" value="Save" onClick="
return validate_many();" />
    </div>
    <div class="form-group">
<input type="button" class="btn btn-danger css_button btn-xs" name="back" value="Back" onClick="window.location.href='menu_category.php'" />
    </div>
</div>

<fieldset style="float:left;width:600px;">

<div>

<?php
//EDIT QUERY
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');

if (isset($_POST['save'])){
$mCtrlNo = $_POST['MenuCatergoryControlNo'];
$mCName = strtoupper($_POST['MenuCategoryName']);
$ImgPath = $_POST['image_path'];
$MCatQry = "UPDATE menu_category SET mcat_name='$mCName', image_path='$ImgPath' WHERE  mcategory_ctrlno=$getValiD";

$MCatUpdate = sybase_query($MCatQry);

if(!$MCatUpdate){
 echo "Unable to add Menu Category!";
}
else{
redirect('menu_category.php');
}
sybase_close($link);
}
?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query=sybase_query("SELECT * FROM menu_category WHERE mcategory_ctrlno =$getValiD");
while($row=sybase_fetch_array($query)){
?>
<label class="field">M. Ctgry. Ctrl No.:</label> 	
<input type="text" id="McatNo" name="MenuCatergoryControlNo" value="<?php echo @$row['mcategory_ctrlno']; ?>" class="input" disabled/></div>

<div><label class="field">M. Ctgry.:</label>
<input type="text" id="McatName" name="MenuCategoryName" value="<?php echo @$row['mcat_name']; ?>" class="input"  maxlength="40"/></div>

<div><label class="field">Image Path:</label>		
<input type="text" name="image_path" value="<?php echo @$row['image_path']; ?>" class="input"/></div>
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