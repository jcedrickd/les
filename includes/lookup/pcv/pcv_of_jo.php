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
<th>PCV #</th>
<th>PCV Date</th>
<th>PCV Type</th>
<th>Status</th>
<th>Validated</th>
<th>J.O. No.</th>
<th>Total Cash</th>
<th>Total Cheque</th>
<th>Payee</th>
<th>Customer</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/billing/pcv_entry_new/summon_functions.php');
$jo_numb=  validate_input(strtoupper($_GET['jo_numb']));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php');
$query1=sybase_query("SELECT pcv_no,pcv_date,pcv_type,pcv_stat,validate_stat,job_order_no,tot_cash,tot_cheque,payee_name,cust_name 
FROM pcv_hdr INNER JOIN pcv_hdrx ON pcv_hdr.pcv_no=pcv_hdrx.pcv_no WHERE pcv_hdrx.job_order_no='$jo_numb'");
$numrows=sybase_num_rows($query1);
while($row=sybase_fetch_array($query1)){
?>
<td><input type="text" name="pcv_numb" value="<?php echo $row['pcv_no']; ?>" style="cursor:pointer" readonly="readonly" class="input" onClick="changeParent(this.value);" /></td>
<td><?php echo $row['pcv_date']; ?></td>
<td><?php echo show_pcv_type($row['pcv_type']); ?></td>
<td><?php echo show_status($row['pcv_stat']); ?></td>
<td><?php echo show_validate($row['validate_stat']); ?></td>
<td><?php echo $row['job_order_no']; ?></td>
<td><?php echo number_format($row['tot_cash'],2);?></td>
<td><?php echo number_format($row['tot_cheque'],2);?></td>
<td><?php echo $row['payee_name']; ?></td>
<td><?php echo $row['cust_name']; ?></td>
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
