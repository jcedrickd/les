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
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- css of bootstrap-->
        <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">
	
        <!-- css for forms-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />
	
        <!-- css for table-->
        <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
       
        <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
                	 
        <!-- jQuery hover table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
        
        <!-- jQuery highlight table row-->
        <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script> 
        
        <!--js validation-->
        <script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/js/check_required.js"></script>
        <script>
        function validate_save(){
        var check_jo=check_required('job_order_no','Job Order No.','inputError');
        return check_jo;
        }
        </script>   
        
    </head>
    <body>
<div id="wrapper">
<b class="module">PCV Entry New</b>
<span id="inputError"><?php include 'logic_pcv_hdrx.php'; ?></span>
<form method="post" id="form">
<input type="hidden" value="134" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
	<input type="submit" name="save" value="Save" class="btn btn-danger css_button btn-xs" onClick="return validate_save();" />        
	</div>
        <div class="form-group">
            <input type="submit" name="back_to_pcv_hdrx" value="Back" class="btn btn-danger css_button btn-xs" /> 
        </div>
</div>
<fieldset style="float:left;">
<input type="hidden" name="pcv_no" value="<?php echo @$_GET['pcv_no']; ?>" />
<input type="hidden" name="pcvhdrx_ctrlno" value="<?php echo @$_GET['pcvhdrx_ctrlno']; ?>" />
<div><label class="field">Doc Type:</label> <input type="text" name="doc_type" value="<?php echo @$doc_type; ?>" class="input" id="doc_type" /></div>
<div><label class="field">Doc Ref:</label> <input type="text" name="doc_ref" value="<?php echo @$doc_ref; ?>" class="input" id="doc_ref" /> </div>
<div><label class="field">Job Order No.:</label> <input type="text" name="job_order_no" value="<?php echo @$job_order_no; ?>" class="input" id="job_order_no" /></div>
</fieldset>
</form>     
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>