<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- css of bootstrap-->
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.css" rel="stylesheet">
	
    <!-- css for forms-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/form_style.css?version=1" />	
	
    <!-- jQuery library -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	
	<!-- css for table-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
	
	<!-- jQuery hover table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
	
    <!-- jQuery highlight table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	
	<link rel="stylesheet" href="/resources/demos/style.css">
	

<script type="text/javascript">
			$(function() {
			$( "#fromDate" ).datepicker();
			});
			
			$(function() {
			$( "#toDate" ).datepicker();
			});
			function printDiv(prnt) {
			var printContents = document.getElementById(prnt).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			}	
			
			var tableToExcel = (function () {
			var uri = 'data:application/vnd.ms-excel;base64,'
			, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
			, base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
			, format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
			return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
		}
		})()
</script>
	
</head>

<body>		

<div id="wrapper">
	<b class="module">PCV Summary Report</b>
	
<form name="rprt" method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
	
<div class="form-inline col-xs-12 inline_elements">
	
	<div class="form-group">
		FROM:
		<input class="input" type="text" name="from" id="fromDate">
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		TO:
		<input class="input" type="text" name="to" id="toDate">
	</div><!--div class="form-group"-->
	
	<div class="form-group">
			TYPE:
			<select name="type" class="input" id="smry_type" onchange="location = this.options[this.selectedIndex].value;">
					 <option selected="selected" value="pcv_summary_report.php">Summary</option>
					 <option value="pcv_summary_report_wdc.php">With Detail Charges</option>
					 <option value="pcv_summary_report_spj.php">Summary per JO</option>
			</select>

	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="submit" class="btn btn-danger css_button btn-xs" value="Retrieve" name="retrieve" />
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" onclick="printDiv('prntMe')" value="Print"/>
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" onClick="tableToExcel('table','name','file')" value="Save to Excel"/>
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" value="Filter" name="filter" />
	</div><!--div class="form-group"-->

</div><!--div class="form-inline col-xs-12 inline_elements"-->

	<div style="height:25px;width:inherit;"> </div>
	<div id="prntMe" name="prnt" style="float:left;"><table id="maramq" style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

		<font size="2"><b>AAI WORLDWIDE LOGISTICS</b></font><br>
		<font size="2"><b>PCV SUMMARY REPORT</b></font><br><br><br>

<thead>
	<tr>
		<th>PCV  DATE</th>
		<th>PCV #</th>
		<th>PCV TYPE</th>
		<th>JO #</th> 
		<th>CUSTOMER</th>
		<th>MAWB</th>
		<th>HAWB</th>
		<th>PAYEE NAME</th>
		<th>TOTAL CASH</th>
		<th>PREPARED BY</th> 
		<th>PCV STAT</th>
		<th>VALIDATED</th>
	</tr>
</thead>	

<tbody>

<?php 

include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
	if(isset($_POST['retrieve']) && strlen(validate_input($from = isset($_POST['from']) ? $_POST['from'] : '')) > 0 && strlen(validate_input($to = isset($_POST['to']) ? $_POST['to'] : '')) > 0){
$gt = 0;	
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$query=sybase_query("SELECT pcv_hdr.pcv_no,   		pcv_hdr.pcv_date,   
								pcv_hdr.job_order_no,   pcv_hdr.cust_name,   
								pcv_hdr.hcarref,   		pcv_hdr.mcarref,   
								pcv_hdr.tot_cash,   	pcv_hdr.bill_no,   
								pcv_hdr.bill_cust_code, pcv_hdr.tot_cheque,   
								pcv_hdr.station_id,   	pcv_hdr.payee_name,   
								pcv_hdr.pcv_type,   	pcv_hdr.type_by,   
								pcv_hdr.pcv_stat,   	pcv_hdr.validate_stat  
						 FROM 	pcv_hdr  
						 WHERE((pcv_hdr.pcv_date >= '$from'  AND
								pcv_hdr.pcv_date <= '$to')	 OR
							   (pcv_hdr.pcv_date >= '$from'  AND
								pcv_hdr.pcv_date <= '$to' 	 AND
								pcv_hdr.pcv_date <> '$to' ))AND
								pcv_hdr.service_type = 'OS'
						 ORDER BY pcv_no"); 
							 
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){	
?>

<?php
	if ( @$row['pcv_type'] >= 'Y'){
	@$row['pcv_type']="Cash";}
	elseif ( @$row['pcv_type'] <= 'MC'){
	@$row['pcv_type']="Manager Cheque";}
	elseif ( @$row['pcv_type'] >= 'CC'){
	@$row['pcv_type']="Company Cheque";
	}
			
	if ( @$row['pcv_stat'] >= 'X'){
	@$row['pcv_stat']="Posted";}
	elseif ( @$row['pcv_stat'] >= 'C'){
	@$row['pcv_stat']="Cancelled";}
	elseif ( @$row['pcv_stat'] <= 'A'){
	@$row['pcv_stat']="Acvite";
	}
								
	if ( @$row['validate_stat'] >= 'X'){
	@$row['validate_stat']="Yes";}
	elseif ( @$row['validate_stat'] <= 'A'){
	@$row['validate_stat']="No";
	}
								
?>

<?php
	if ( @$row['pcv_type'] >= 'Manager Cheque'){
	@$row['tot_cash']="$tot_cash";}
	elseif ( @$row['pcv_type'] >= 'Company Cheque'){
	@$row['tot_cash']="$tot_cash";}
	elseif ( @$row['pcv_type'] <= 'Manager Cheque'){
	@$row['tot_cheque']="$tot_cheque";}
	elseif ( @$row['pcv_type'] <= 'Company Cheque'){
	@$row['tot_cheque']="$tot_cheque";}
?>

<tr>

	<td><?php echo date("m/d/Y",strtotime(@$row['pcv_date'])); ?></td>
	<td><?php echo @$row['pcv_no']; ?></td>
	<td><?php echo @$row['pcv_type']; ?></td>
	<td><?php echo @$row['job_order_no']; ?></td>
	<td><?php echo @$row['cust_name']; ?></td>
	<td><?php echo @$row['mcarref']; ?></td>
	<td><?php echo @$row['hcarref']; ?></td>
	<td><?php echo @$row['payee_name']; ?></td>
	<td><?php echo number_format($row['tot_cash'] + ($row['tot_cheque']),2); ?></td>
	<td><?php echo @$row['type_by']; ?></td>
	<td><?php echo @$row['pcv_stat']; ?></td>
	<td><?php echo @$row['validate_stat']; ?></td>
	
</tr>

<?php 
$gt += @$row['tot_cash']+@$row['tot_cheque'];
}
sybase_free_result($query);
sybase_close($link);
}
?>

</tbody>

<!--tfoot><tr><td colspan="13"><div id="paging"><ul>
	<li><a href="#"><span>Previous</span></a></li>
	<li><a href="#" class="active"><span>1</span></a></li>
	<li><a href="#"><span>2</span></a></li>
	<li><a href="#"><span>3</span></a></li>
	<li><a href="#"><span>4</span></a></li>
	<li><a href="#"><span>5</span></a></li>
	<li><a href="#"><span>Next</span></a></li>
</ul></div></tr></tfoot-->

</table>

<p>Total No. of Records: <?php echo number_format(@$numrows); ?></p>
<P>Grand Total: <?php echo number_format((@$gt),2); ?></p>

</div>
</form>
</div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>

</body>
</html>