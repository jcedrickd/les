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
	
    <!-- jQuery library -->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>	
	
	<!-- css for table-->
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/table_style.css" />
	
	<!-- jQuery hover table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/hover_row.js"></script>
	
    <!-- jQuery highlight table row-->
    <script src="http://wmsonline.aai.com.ph/usual_js/highlight_row.js"></script>

<script>
</script>
</head>

<body>
<div id="wrapper">
<b class="module">Conversion Rate Setup</b>
<span id="inputError"><?php include 'logic.php'; ?></span>
<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />
<div class="form-inline col-xs-12 inline_elements">
	<div class="form-group">
	<label>Date</label>
	<input type="text" class="input datepicker" name="ConversDate" value="<?php echo date("m/d/Y")?>"/>
	</div><!--div class="form-group"-->
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="Retrieve" onclick="" value="Retrieve" />
	</div><!--div class="form-group"-->
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="New" onclick="" value="New" />
	</div><!--div class="form-group"-->
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="Delete" onclick="" value="Delete" />
	</div><!--div class="form-group"-->
</div><!--div class="form-inline col-xs-12 inline_elements"-->
<div style="height:25px;width:inherit;"> </div><br/>
<div style="float:left;">
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
	<tr>
	<th style="<?php //echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php //echo @$access_update; ?>">Edit</th>
	<th style="<?php //echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php //echo @$access_delete; ?>">Delete</th>
	<th>Currency Code</th>
	<th>Currency Description</th>
	<th>Actual (USD)</th>
	<th>+5 % (USD)</th>
	<th>USD-PHP</th>
	<th>Effective From</th>
	<th>Date To</th>
	<th>Curr Apply</th>
	<th>Add / Edit By</th>
	<th>Add / Edit Date</th>
	<th>Add / Edit Time</th>
	</tr>
</thead>	
<tbody>
    <tr>
<?php
isset($_GET['ConversDate']) == false ? $date=validate_input($_POST['ConversDate']) : $date=validate_input($_GET['ConversDate']);
if((isset($_POST['Retrieve']) && strlen($date) > 0) || isset($_GET['ConversDate'])){
//Database Connections
@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
@$db = @sybase_select_db("BOSS");	
$result=sybase_query("SELECT conversion_table.effect_date,conversion_table.curr_code,
conversion_table.effect_date_to,conversion_table.usd_php,conversion_table.add_edit,           
conversion_table.add_date,conversion_table.add_time,conversion_table.curr_usd,           
conversion_table.curr_desc,conversion_table.curr_usdx,conversion_table.curr_apply,
conversion_table.convtable_ctrlno     
FROM conversion_table      
WHERE (conversion_table.effect_date <= '$date') And   (conversion_table.effect_date_to >= '$date')
ORDER BY conversion_table.curr_code ASC");
    while($row=sybase_fetch_array($result)){
?>
        <td><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/domestic/maintenance/conversion_rate_setup/convtable_ctrlno.php?convtable_ctrlno=<?php echo $row['convtable_ctrlno']; ?>&ConversDate=<?php echo urlencode($date); ?>" class="hover_row">Override</a></td>
        <td><input type="checkbox" name="checkbox[]" class="highlight_row" value="<?php echo $row['convtable_ctrlno']; ?>" /></td>
        <td><?php echo $row['curr_code']; ?></td>
	<td><?php echo $row['curr_desc']; ?></td>
	<td><?php echo number_format(@$row['curr_usd'],4); ?></td>
	<td><?php echo number_format(@$row['curr_usdx'],4); ?></td>
	<td><?php echo number_format(@$row['usd_php'],2); ?></td>
	<td><?php echo date("m/d/Y",strtotime($row['effect_date'])); ?></td>
	<td><?php echo date("m/d/Y",strtotime($row['effect_date_to'])); ?></td>
	<td><?php echo $row['curr_apply']=="M" ? "M (*)" : "D (/)"; ?></td>
	<td><b><?php echo $row['add_edit']; ?></b></td>
	<td><b><?php echo date("m/d/Y",strtotime($row['add_date'])); ?></b></td>
	<td><b><?php echo date("H:i",strtotime($row['add_time'])); ?></b></td>
    </tr>
<?php 
    }
sybase_free_result($result);
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
<p></p>
</div>
</form>
</div>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/les/includes/bootstrap/bootstrap.js"></script>
</body>
</html>