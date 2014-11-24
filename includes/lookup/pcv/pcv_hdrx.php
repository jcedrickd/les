<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="icon" href="http://wmsonline.aai.com.ph/favicon.ico" />

<meta name="description" content="" />
<meta name="keywords" content="" />

<meta name="author" content="" />
<!-- css of bootstrap-->
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">

<!-- jQuery library -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 	 
<!-- css for table-->
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/table_style.css" />

<!-- css for form-->
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/form_style.css" />
	 
<!-- jQuery hover table row-->
<script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
        
<!-- jQuery highlight table row-->
<script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>      
	
<script language="javascript"> 
function changeParent(str) { 
  window.opener.document.getElementById('jo_numb_search').value= str;
  window.close();
} 
</script>        
<title>Logistics Enterprise System</title>
    </head>
    <body>
		<div id="wrapper_lookup">
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<caption>JO Entry List for PCV No. <?php echo $_GET['pcv_no']; ?></caption>
<thead>
<tr>
<th>Doc Type</th>
<th>Doc Ref</th>
<th>Job Order No</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$pcv_no=  validate_input(strtoupper($_GET['pcv_no']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT * FROM pcv_hdrx WHERE pcv_no='$pcv_no'");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?> 
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
<tfoot>
<tr>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</tr>
</tfoot>
</table>
		</div> <!-- End #wrapper -->

    </body>
</html>
