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
	<b class="module">Transaction Report</b>

<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
	
<div class="form-inline col-xs-12 inline_elements">

	<div class="form-group">
		FROM:
			<input class="input" type="text" name="from" id="fromDate"/>
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		TO:
			<input class="input" type="text" name="to" id="toDate">
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

</div><!--div class="form-inline col-xs-12 inline_elements"-->

	<div style="height:25px;width:inherit;"> </div>
	<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

		<font size="2"><b>AAI WORLDWIDE LOGISTICS</b></font><br>
		<font size="2"><b>OS TRANSACTION REPORT</b></font><br><br><br>

<thead>
	<tr>
		<th>TRANSACTION DATE</th>
		<th>JO #</th>
		<th>TRANS TYPE</th>
		<th>CUSTOMER</th>
		<th>MASTER REFERENCE</th>
		<th>HOUSE REFERENCE</th>
		<th>OTHER REFERENCE</th>
		<th>TOTAL CHARGES</th>
		<th>INSTRUCTIONS</th>
		<th>PREPARED BY</th>
		<th>PREPARED DATETIME</th>
					
	</tr>
</thead>	
<tbody>
<?php
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
	if(isset($_POST['retrieve']) && strlen(validate_input($from = isset($_POST['from']) ? $_POST['from'] : '')) > 0 && strlen(validate_input($to = isset($_POST['to']) ? $_POST['to'] : '')) > 0){

include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
	$query=sybase_query("SELECT  oth_services.transaction_date, oth_services.jo_numb,   
								 oth_services.trans_type,   	oth_services.client,   
								 oth_services.total_charges,   	oth_services.instructions,   
								 oth_services.bill_no,   		oth_services.prepared_by,   
								 oth_services.prepared_datetime,oth_services.mawbno,   
								 oth_services.hawbno,   		oth_services.oth_reference
						  FROM   oth_services 
						  WHERE ( oth_services.transaction_date >= '$from' ) AND  
							    ( oth_services.transaction_date <= '$to' ) AND  
							    ( oth_services.status = 'X')
					   ORDER BY  jo_numb "); 
						  	 
							 
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){		
?>

<tr>
	<td><?php echo date("m/d/Y",strtotime(@$row['transaction_date'])); ?></td>
	<td><?php echo @$row['jo_numb']; ?></td>
	<td><?php echo @$row['trans_type']; ?></td>
	<td><?php echo @$row['client']; ?></td>
	<td><?php echo @$row['mawbno']; ?></td>
	<td><?php echo @$row['hawbno']; ?></td>
	<td><?php echo @$row['oth_reference']; ?></td>
	<td><?php echo number_format($row['total_charges'],2); ?></td>
	<td><?php echo @$row['instructions']; ?></td>
	<td><?php echo @$row['prepared_by']; ?></td>	
	<td><?php echo @$row['prepared_datetime']; ?></td>	
	
</tr>

<?php 	
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

</div>
</form>
</div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>

</body>
</html>