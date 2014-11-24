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

<!--start jquery datepicker-->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/date_picker.js"></script>
		
<script language="javascript"> 
function changeParent(str) { 
  window.opener.document.getElementById('pcv_numb_search').value= str;
  window.close();
} 
</script>        
<title>Logistics Enterprise System</title>
    </head>
    <body>
		<div id="wrapper_lookup">
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/summon_functions.php');
?>
<br /><br />
<form method="get">
<div class="form-inline col-xs-12">
	<div class="form-group">
	Customer Name:
	<input type="text" name="cust_name" value="" class="input" />
	</div>
	<div class="form-group">
	From: 
	<input type="text" name="from" value="" class="datepicker input" /> 
	</div>
	<div class="form-group">
	To: 
	<input type="text" name="to" value="" class="datepicker input" /> 
	</div>
	<div class="form-group">
	<input type="submit" value="Search" name="search" class="btn btn-danger css_button btn-xs" />
	</div>
</div>
</form>
<br /><br />
<table border="1" style="white-space:nowrap;" id="tfhover" class="tftable">
<caption>JO Entry from <?php if(!isset($_GET['search'])){echo $date=get_one_month();}else{ echo $_GET['from']; } ?> to <?php if(!isset($_GET['search'])){echo date("m/d/Y");}else{ echo $_GET['to']; } ?></caption>
<thead>
<tr>
<th>PCV No.</th>
<th>Date</th>
<th>Payee Name</th>
<th>Customer Name</th>
<th>MAWB</th>
<th>HAWB</th>
<th>PCV Status</th>
<th>Validated</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
if((isset($_GET['search']) || !isset($_GET['search'])) && strlen(@$_GET['from']) < 1 && strlen(@$_GET['to']) < 1){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$date=get_one_month();
$query1=sybase_query("SELECT pcv_no,pcv_date,payee_name,cust_name,mcarref,hcarref,pcv_stat,validate_stat FROM pcv_hdr WHERE pcv_date >= '$date' AND pcv_no LIKE 'OS%' ORDER BY pcv_date DESC");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?> 
<td><input type="text" name="pcv_numb" value="<?php echo $row['pcv_no']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(this.value);" /></td>
<td><?php echo date("m/d/Y",strtotime($row['pcv_date'])); ?></td>
<td><?php echo $row['payee_name']; ?></td>
<td><?php echo $row['cust_name']; ?></td>
<td><?php echo $row['mcarref']; ?></td>
<td><?php echo $row['hcarref']; ?></td>
<td><?php echo show_status($row['pcv_stat']); ?></td>
<td><?php echo show_validate($row['validate_stat']); ?></td>
</tr>
<?php 
}
sybase_free_result($query1);
sybase_close($link);
}
elseif(isset($_GET['search']) && strlen($_GET['from']) > 0 && strlen($_GET['to']) > 0){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$cust_name=trim(strtoupper($_GET['cust_name']));
$query2=sybase_query("SELECT pcv_no,pcv_date,payee_name,cust_name,mcarref,hcarref,pcv_stat,validate_stat FROM pcv_hdr WHERE cust_name LIKE '%$cust_name%' AND pcv_date >= '$_GET[from]' AND pcv_date <= '$_GET[to]' AND pcv_no LIKE 'OS%' ORDER BY pcv_date DESC");
$numrows=sybase_num_rows($query2);
while($row2=sybase_fetch_array($query2)){
?>
<td><input type="text" name="pcv_numb" value="<?php echo $row2['pcv_no']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(this.value);" /></td>
<td><?php echo date("m/d/Y",strtotime($row2['pcv_date'])); ?></td>
<td><?php echo $row2['payee_name']; ?></td>
<td><?php echo $row2['cust_name']; ?></td>
<td><?php echo $row2['mcarref']; ?></td>
<td><?php echo $row2['hcarref']; ?></td>
<td><?php echo show_status($row2['pcv_stat']); ?></td>
<td><?php echo show_validate($row2['validate_stat']); ?></td></tr>
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

    </body>
</html>
