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
           
        <script>
        function validate_attach_pcv(){
        var inputElems = document.getElementsByTagName("input"),count = 0;
            for(var i=0; i<inputElems.length; i++) {
                if(inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
                count++;
                }
            }
            if(count != 1){
            alert("Error: Please attach one JO only!");
            return false;
            }
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
	<input type="submit" name="add" value="Add" class="btn btn-danger css_button btn-xs" />        
	</div>
	<div class="form-group">
	<input type="submit" name="delete_pcv_hdrx" value="Delete" class="btn btn-danger css_button btn-xs" /> 
        </div>
        <div class="form-group">
	<input type="submit" name="attach_to_pcv" value="Attach to PCV" class="btn btn-danger css_button btn-xs" onClick="return validate_attach_pcv();" /> 
        </div>
        <div class="form-group">
            <input type="submit" name="back" value="Back" class="btn btn-danger css_button btn-xs" /> 
        </div>
    
</div>
<div style="height:35px;width:inherit;"> </div>
<table border="1" style="white-space:nowrap;width:10%" id="tfhover" class="tftable">
<caption>JO Entry List for PCV No. <?php echo $_GET['pcv_no']; ?></caption>
<thead>
<tr>
<th>Select</th>
<th>Edit</th>
<th>Doc Type</th>
<th>Doc Ref</th>
<th>Job Order No</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
$pcv_no=  validate_input(strtoupper($_GET['pcv_no']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT * FROM pcv_hdrx WHERE pcv_no='$pcv_no'");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?> 
<td><input type="checkbox" name="pcvhdrx_ctrlno[]" value="<?php echo $row['pcvhdrx_ctrlno']; ?>" class="highlight_row" /></td>
<td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/other_transaction/billing/pcv_entry_new/save_pcv_hdrx.php?pcv_no=<?php echo $_GET['pcv_no']; ?>&pcvhdrx_ctrlno=<?php echo $row['pcvhdrx_ctrlno']; ?>" class="hover_row">Edit</a></td>
<td><?php echo $row['doc_type']; ?></td>
<td><?php echo $row['doc_ref']; ?></td>
<td><?php echo $row['job_order_no']; ?></td>
</tr>
<?php 
}
sybase_free_result($query1);
sybase_close($link);
?>
</tbody>
<!--tfoot>
<tr>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</tr>
</tfoot-->
</table>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>

<input type="hidden" name="pcv_no" value="<?php echo $pcv_no; ?>" />
</form>     
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
