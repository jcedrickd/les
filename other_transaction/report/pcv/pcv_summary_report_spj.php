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

<script>
			$(function() {
			$( "#fromDate" ).datepicker();
			});
			
			$(function() {
			$( "#toDate" ).datepicker();
			});
</script>
	
</head>

<body>		
<div id="wrapper">
	<b class="module">PCV Summary Report</b>
	
<form name="spj" method="post" id="form">
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
					 <option value="pcv_summary_report.php">Summary</option>
					 <option value="pcv_summary_report_wdc.php">With Detail Charges</option>
					 <option selected="selected" value="pcv_summary_report_spj.php">Summary per JO</option>
			</select>
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="submit" class="btn btn-danger css_button btn-xs" value="Retrieve" name="retrieve" />
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" value="Print" name="print"  />
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" value="Save to Excel" name="ste" />
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		<input type="button" class="btn btn-danger css_button btn-xs" value="Filter" name="filter" />
	</div><!--div class="form-group"-->

</div><!--div class="form-inline col-xs-12 inline_elements"-->

	<div style="height:25px;width:inherit;"> </div>
	<div style="float:left;">
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

		<font size="2"><b>AAI WORLDWIDE LOGISTICS</b></font><br>
		<font size="2"><b>PCV SUMMARY REPORT WITH DETAIL CHARGES - OS</b></font><br><br><br>

<thead>
	<tr>
		<th>JO #</th>
		<th>HBL/HAWB</th>
		<th>CUSTOMER</th>		
		<th>CHG DESC</th>
		<th>RECEIPTED EXP</th>
		<th>SUM</th> 
	</tr>
</thead>
<tbody>
<?php 
$smry_type = isset($_POST['smry_type']) ? $_POST['smry_type'] : ''; 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
	if(isset($_POST['retrieve']) && strlen(validate_input($from = isset($_POST['from']) ? $_POST['from'] : '')) > 0 && strlen(validate_input($to = isset($_POST['to']) ? $_POST['to'] : '')) > 0){
$gt = 0;	
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$query=sybase_query("SELECT   pcv_hdr.hcarref,   		pcv_hdr.job_order_no,   
								  pcv_hdr.cust_name,   		pcv_dtl.chg_desc,   
								  pcv_dtl.receipted_exp,  	sum(pcv_dtl.php_cost) as tot_php  
						 FROM	  pcv_hdr,   				pcv_dtl  
						 WHERE 	 (pcv_hdr.pcv_no = pcv_dtl.pcv_no)  and
								((pcv_hdr.pcv_date >= '$from')	    AND
								 (pcv_hdr.pcv_date <= '$to' )		AND
								 (pcv_hdr.service_type = 'OS') 		AND
								 (pcv_hdr.pcv_stat = 'X')			AND
								 (pcv_hdr.validate_stat = 'X'))   
						 GROUP BY pcv_hdr.job_order_no,	pcv_hdr.cust_name,   
								  pcv_hdr.hcarref,   	pcv_dtl.chg_desc,   
								  pcv_dtl.receipted_exp 
						 ORDER BY job_order_no");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){	
?>

<!--?php
if($_POST['s_type'] == "1"){
do
 }
elseif ($_POST['s_type'] == "2"){
do
}
?-->

<tr>
	<td><?php echo @$row['job_order_no']; ?></td>
	<td><?php echo @$row['hcarref']; ?></td>
	<td><?php echo @$row['cust_name']; ?></td>
	<td><?php echo @$row['chg_desc']; ?></td>
	<td><?php echo @$row['receipted_exp']; ?></td>
	<td><?php echo number_format($row['tot_php'],2); ?></td>
</tr>

<?php 	
$gt += @$row['tot_php'];
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