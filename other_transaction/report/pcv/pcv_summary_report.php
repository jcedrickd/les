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
	    
     <!-- jQuery library -->
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
                	 
    <!--start jquery datepicker-->
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/jQuery/date_picker.js"></script>
        
	
</head>

<body>		

<div id="wrapper">
	<b class="module">PCV Summary Report</b>
	
<form name="rprt" method="POST" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
	
<div class="form-inline col-xs-12 inline_elements">
<?php 
@$from=trim($_POST['from']);
@$to=trim($_POST['to']);
?>	
	<div class="form-group">
		FROM:
		<input class="input datepicker" type="text" name="from" value="<?php echo $from; ?>">
	</div><!--div class="form-group"-->
	
	<div class="form-group">
		TO:
		<input class="input datepicker" type="text" name="to" value="<?php echo $to; ?>">
	</div><!--div class="form-group"-->
	
	<div class="form-group">
			TYPE:
			<select name="type" class="input" id="smry_type">
					 <option value="1">Summary</option>
					 <option value="2">With Detail Charges</option>
					 <option value="3">Summary per JO</option>
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

<?php 
if(isset($_POST['retrieve']) && $_POST['type']==1){ 
?>    
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

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
?>
</tbody>
</table>
<p>Total No. of Records: <?php echo number_format(@$numrows); ?></p>
<p>Grand Total: <?php echo number_format((@$gt),2); ?></p>
<?php 
}
elseif(isset($_POST['retrieve']) && $_POST['type']==2){
//echo '<br />With detail charges!'; 
?>
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

		<font size="2"><b>AAI WORLDWIDE LOGISTICS</b></font><br>
		<font size="2"><b>PCV SUMMARY REPORT WITH DETAIL CHARGES - OS</b></font><br><br><br>

<thead>
        <tr>
            <th colspan="4" style="visibility: hidden;"></th>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
//query charge desc receipted = 'Y'
$result_chg_desc_y=  sybase_query("SELECT DISTINCT pcv_dtl.chg_desc FROM 	pcv_hdr,pcv_dtl  
						 WHERE  pcv_hdr.pcv_no = pcv_dtl.pcv_no  and 
							    pcv_hdr.pcv_date >= '$from'   	 AND
							    pcv_hdr.pcv_date <= '$to'   	 AND   
							    pcv_hdr.service_type = 'OS'		 AND
							    pcv_hdr.pcv_stat = 'X'  		 AND  
							    pcv_hdr.validate_stat = 'X' AND
                                pcv_dtl.receipted_exp ='Y'
					 ORDER BY   pcv_dtl.chg_desc ASC");
//get the number of rows make it in the value of columns
?>
            <th colspan="<?php echo @sybase_num_rows($result_chg_desc_y); ?>">Receipted</th>
<?php 
//query charge desc receipted <> 'Y'
$result_chg_desc_n=  sybase_query("SELECT DISTINCT pcv_dtl.chg_desc FROM 	pcv_hdr,pcv_dtl  
						 WHERE  pcv_hdr.pcv_no = pcv_dtl.pcv_no  and 
							    pcv_hdr.pcv_date >= '$from'   	 AND
							    pcv_hdr.pcv_date <= '$to'   	 AND   
							    pcv_hdr.service_type = 'OS'		 AND
							    pcv_hdr.pcv_stat = 'X'  		 AND  
							    pcv_hdr.validate_stat = 'X' AND
                                pcv_dtl.receipted_exp = 'N'
					 ORDER BY   pcv_dtl.chg_desc ASC");
?>
            <th colspan="<?php echo @sybase_num_rows($result_chg_desc_n); ?>">Unreceipted</th>
        </tr>
	<tr>
		<th colspan="1">PCV #</th>
		<th colspan="1">HOUSE REF.</th>
		<th colspan="1">JO NO.</th> 
		<th colspan="1">CUSTOMER</th>
<?php
//create empty array
$receipted_y_list=array();
while ($th_chg_desc_y = sybase_fetch_array($result_chg_desc_y)) {
?>
		<th colspan="1"><?php echo $receipted_y_list[]=$th_chg_desc_y['chg_desc']; ?></th>
<?php 
}
@sybase_free_result($result_chg_desc_y);
?>	
<?php 
$receipted_n_list=array();
while ($th_chg_desc_n = sybase_fetch_array($result_chg_desc_n)) {
?>
		<th colspan="1"><?php echo $receipted_n_list[]=$th_chg_desc_n['chg_desc']; ?></th>
<?php 
}
@sybase_free_result($result_chg_desc_n);
?>
	</tr>
	
</thead>	

<tbody>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$gt = 0;	
	$query=sybase_query("SELECT pcv_hdr.pcv_no,   		pcv_hdr.hcarref,   
								pcv_hdr.job_order_no,   pcv_hdr.cust_name,   
								pcv_dtl.chg_desc,   	pcv_dtl.php_cost,   
								pcv_dtl.receipted_exp  
						 FROM 	pcv_hdr,   				pcv_dtl  
						 WHERE  pcv_hdr.pcv_no = pcv_dtl.pcv_no  and 
							    pcv_hdr.pcv_date >= '$from'   	 AND
							    pcv_hdr.pcv_date <= '$to'   	 AND   
							    pcv_hdr.service_type = 'OS'		 AND
							    pcv_hdr.pcv_stat = 'X'  		 AND  
							    pcv_hdr.validate_stat = 'X' 
					 ORDER BY   pcv_hdr.pcv_no");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){	
?>

<tr>
	<td><?php echo @$row['pcv_no']; ?></td>
	<td><?php echo @$row['hcarref']; ?></td>
	<td><?php echo @$row['job_order_no']; ?></td>
	<td><?php echo @$row['cust_name']; ?></td>
	
<?php
foreach ($receipted_y_list as $receipted_y){
?>  

	<td>
<?php 
//get the amount for receipted
$result_receipt_cost=sybase_query("SELECT pcv_dtl.php_cost 
									 FROM pcv_hdr,pcv_dtl 
									WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no 	  AND 
										  pcv_hdr.pcv_date >= '$from'     	  AND 
										  pcv_hdr.pcv_date <= '$to'       	  AND   
										  pcv_hdr.service_type = 'OS' 	  	  AND
										  pcv_hdr.pcv_stat = 'X' 		  	  AND 
										  pcv_hdr.validate_stat = 'X' 	  	  AND 
										  pcv_dtl.pcv_no='$row[pcv_no]' AND 
										  pcv_dtl.chg_desc='$receipted_y' 	  AND 
										  pcv_dtl.receipted_exp='Y'
								 ORDER BY pcv_hdr.pcv_no");
$receipt_cost=  sybase_fetch_array($result_receipt_cost);
echo number_format($receipt_cost['php_cost'],2);
?>    
    </td>
	
<?php    
}
sybase_free_result($result_receipt_cost);
?>
		
<?php 
foreach ($receipted_n_list as $receipted_n){
?> 

	<td>
<?php 
//get the amount for receipted
$result_receipt_cost=sybase_query("SELECT pcv_dtl.php_cost 
									 FROM pcv_hdr,pcv_dtl 
									WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no 	  AND 
										  pcv_hdr.pcv_date >= '$from'     	  AND 
										  pcv_hdr.pcv_date <= '$to'       	  AND   
										  pcv_hdr.service_type = 'OS' 	  	  AND
										  pcv_hdr.pcv_stat = 'X' 		  	  AND 
										  pcv_hdr.validate_stat = 'X' 	  	  AND 
										  pcv_dtl.pcv_no='$row[pcv_no]' AND 
										  pcv_dtl.chg_desc='$receipted_n' 	  AND 
										  pcv_dtl.receipted_exp='N'
								 ORDER BY pcv_hdr.pcv_no");
$receipt_cost=  sybase_fetch_array($result_receipt_cost);
echo number_format($receipt_cost['php_cost'],2);
?>    
    </td>

<?php    
}
?>
		
</tr>	
<?php
$gt += @$row['php_cost'];
}
sybase_free_result($query);
sybase_close($link);

?>

</tbody>
</table>

<p>Total No. of Records: <?php echo number_format(@$numrows); ?></p>
<P>Grand Total: <?php echo number_format((@$gt),2); ?></p>

<?php	 
}elseif(isset($_POST['retrieve']) && $_POST['type']==3){
?>
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">

		<font size="2"><b>AAI WORLDWIDE LOGISTICS</b></font><br>
		<font size="2"><b>PCV SUMMARY REPORT WITH DETAIL CHARGES - OS</b></font><br><br><br>

<thead>
        <tr>
            <th colspan="3" style="visibility: hidden;"></th>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
//query charge desc receipted = 'Y'
$result_chg_desc_y = sybase_query ("SELECT DISTINCT pcv_dtl.chg_desc 
											   FROM pcv_hdr,pcv_dtl  
											  WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no  and 
													pcv_hdr.pcv_date >= '$from'   	 AND
													pcv_hdr.pcv_date <= '$to'   	 AND   
													pcv_hdr.service_type = 'OS'		 AND
													pcv_hdr.pcv_stat = 'X'  		 AND  
													pcv_hdr.validate_stat = 'X'		 AND
													pcv_dtl.receipted_exp ='Y'
										   ORDER BY pcv_dtl.chg_desc ASC");
//get the number of rows make it in the value of columns
?>
            <th colspan="<?php echo @sybase_num_rows($result_chg_desc_y); ?>">Receipted</th>
<?php 
//query charge desc receipted <> 'Y'
$result_chg_desc_n = sybase_query ("SELECT DISTINCT pcv_dtl.chg_desc 
											   FROM pcv_hdr,pcv_dtl  
											  WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no  and 
													pcv_hdr.pcv_date >= '$from'   	 AND
													pcv_hdr.pcv_date <= '$to'   	 AND   
													pcv_hdr.service_type = 'OS'		 AND
													pcv_hdr.pcv_stat = 'X'  		 AND  
													pcv_hdr.validate_stat = 'X' 	 AND
													pcv_dtl.receipted_exp = 'N'
										   ORDER BY pcv_dtl.chg_desc ASC");
?>
            <th colspan="<?php echo @sybase_num_rows($result_chg_desc_n); ?>">Unreceipted</th>
        </tr>
	<tr>
		<th colspan="1">JO NO.</th>
		<th colspan="1">HOUSE REF.</th>
		<th colspan="1">CUSTOMER</th>
<?php
//create empty array
$receipted_y_list=array();
while ($th_chg_desc_y = sybase_fetch_array($result_chg_desc_y)) {
?>
		<th colspan="1"><?php echo $receipted_y_list[]=$th_chg_desc_y['chg_desc']; ?></th>
<?php 
}
@sybase_free_result($result_chg_desc_y);
?>	
<?php 
$receipted_n_list=array();
while ($th_chg_desc_n = sybase_fetch_array($result_chg_desc_n)) {
?>
		<th colspan="1"><?php echo $receipted_n_list[]=$th_chg_desc_n['chg_desc']; ?></th>
<?php 
}
@sybase_free_result($result_chg_desc_n);
?>
	</tr>
	
</thead>	

<tbody>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
$gt = 0;	
	$query=sybase_query ("SELECT pcv_hdr.hcarref,   
								 pcv_hdr.job_order_no,   
								 pcv_hdr.cust_name,   
								 pcv_dtl.chg_desc,   
								 pcv_dtl.receipted_exp,   
								 sum(pcv_dtl.php_cost) as tot_php  
							FROM pcv_hdr,   
								 pcv_dtl  
						   WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no  and  
								 pcv_hdr.pcv_date >= '$from'  	  AND  
								 pcv_hdr.pcv_date <= '$to'  	  AND  
								 pcv_hdr.service_type = 'OS'  	  AND  
								 pcv_hdr.pcv_stat = 'X' 	 	  AND  
								 pcv_hdr.validate_stat = 'X'
						GROUP BY pcv_hdr.job_order_no,   
								 pcv_hdr.cust_name,   
								 pcv_hdr.hcarref,   
								 pcv_dtl.chg_desc,   
								 pcv_dtl.receipted_exp
						ORDER BY pcv_hdr.job_order_no");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){	
?>

<tr>
	<td><?php echo @$row['job_order_no']; ?></td>
	<td><?php echo @$row['hcarref']; ?></td>
	<td><?php echo @$row['cust_name']; ?></td>

<?php 
foreach ($receipted_y_list as $receipted_y){
?>  

	<td>
<?php 
//get the amount for receipted
$result_receipt_cost=sybase_query("SELECT sum(pcv_dtl.php_cost) as tot_php
									 FROM pcv_hdr,pcv_dtl 
									WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no 	  AND 
										  pcv_hdr.pcv_date >= '$from'     	  AND 
										  pcv_hdr.pcv_date <= '$to'       	  AND   
										  pcv_hdr.service_type = 'OS' 	  	  AND
										  pcv_hdr.pcv_stat = 'X' 		  	  AND 
										  pcv_hdr.validate_stat = 'X' 	  	  AND 
										  pcv_hdr.job_order_no='$row[job_order_no]' AND 
										  pcv_dtl.chg_desc='$receipted_y' 	  AND 
										  pcv_dtl.receipted_exp='Y'
								 ORDER BY pcv_hdr.job_order_no");
$receipt_cost=  sybase_fetch_array($result_receipt_cost);
echo number_format($receipt_cost['tot_php'],2);
?>    
    </td>
	
<?php    
}
sybase_free_result($result_receipt_cost);
?>
		
<?php
foreach ($receipted_n_list as $receipted_n){
?>
	
	<td>
<?php 
//get the amount for receipted
$result_receipt_cost=sybase_query("SELECT sum(pcv_dtl.php_cost) as tot_php
									 FROM pcv_hdr,pcv_dtl 
									WHERE pcv_hdr.pcv_no = pcv_dtl.pcv_no 	  AND 
										  pcv_hdr.pcv_date >= '$from'     	  AND 
										  pcv_hdr.pcv_date <= '$to'       	  AND   
										  pcv_hdr.service_type = 'OS' 	  	  AND
										  pcv_hdr.pcv_stat = 'X' 		  	  AND 
										  pcv_hdr.validate_stat = 'X' 	  	  AND 
										  pcv_hdr.job_order_no='$row[job_order_no]' AND 
										  pcv_dtl.chg_desc='$receipted_n'     AND 
										  pcv_dtl.receipted_exp='N'
								 ORDER BY pcv_hdr.job_order_no");
$receipt_cost=  sybase_fetch_array($result_receipt_cost);
echo number_format($receipt_cost['tot_php'],2);
?>    
	</td>

<?php    
}
?>
		
</tr>	
<?php
$gt += @$row['tot_php'];
}
sybase_free_result($query);
sybase_close($link);

?>

</tbody>
</table>

<p>Total No. of Records: <?php echo number_format(@$numrows); ?></p>
<P>Grand Total: <?php echo number_format((@$gt),2); ?></p>
<?php
} 
?>
</div>
</form>
</div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>

</body>
</html>