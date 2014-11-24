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
<!--center><b class="module">Job Order Entry</b></center><br /><br /-->
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/transaction/job_order_entry/summon_functions.php');
?>
<!--br /><br /-->
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
<form method="get">
<label class="field">Customer Name:</label><input type="text" name="client" value="" class="input" /> <input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" />
</form>
	</div>
</div>
<br /><br />
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
    <caption>JO Entry from <?php echo $date=get_three_month(); ?> to <?php echo date("m/d/Y"); ?></caption>
<thead>
<tr>
<th>Job Order No.</th>
<th>Transaction Date</th>
<th>Customer Name</th>
<th>Status</th>
<th>Prepared By</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
if((isset($_GET['search']) || !isset($_GET['search'])) && strlen(@$_GET['client']) < 1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT jo_numb,transaction_date,client,status,prepared_by FROM oth_services WHERE transaction_date >= '$date' ORDER BY transaction_date DESC");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?> 
<td><input type="text" name="jo_numb" value="<?php echo $row['jo_numb']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(this.value);" /></td>
<td><?php echo date("M d,Y",strtotime($row['transaction_date'])); ?></td>
<td><?php echo $row['client']; ?></td>
<td><?php echo show_status($row['status']); ?></td>
<td><?php echo $row['prepared_by']; ?></td>
</tr>
<?php 
}
sybase_free_result($query1);
sybase_close($link);
}
elseif(isset($_GET['search']) && strlen($_GET['client']) > 0){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$client=trim(strtoupper($_GET['client']));
$query2=sybase_query("SELECT jo_numb,c_code,transaction_date,client,status,prepared_by FROM oth_services WHERE client LIKE '%$client%' AND transaction_date >= '$date' ORDER BY transaction_date DESC");
$numrows=sybase_num_rows($query2);
while($row2=sybase_fetch_array($query2)){
?>
<td><input type="text" name="jo_numb" value="<?php echo $row2['jo_numb']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(this.value);" /></td>
<td><?php echo date("M d,Y",strtotime($row2['transaction_date'])); ?></td>
<td><?php echo $row2['client']; ?></td>
<td><?php echo show_status($row2['status']); ?></td>
<td><?php echo $row2['prepared_by']; ?></td>
</tr>
<?php
}
sybase_free_result($query2);
sybase_close($link);
}
?>
</tbody>
<tfoot>
<tr>
<p>Total No. of Records: <?php echo number_format($numrows); ?></p>
</tr>
</tfoot> 
</table>
		</div> <!-- End #wrapper -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
    </body>
</html>
