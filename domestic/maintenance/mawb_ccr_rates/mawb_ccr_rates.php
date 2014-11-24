<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
//Database Connections
@$link = sybase_connect("AAIASE", "cris", "aaigoc"); //or die(sybase_set_message_handler());
@$db = @sybase_select_db("DCS");
?>
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

	<!-- Alert Box for Deleting Item -->
<script>
</script>
</head>

<body>		
<div id="wrapper">
<b class="module">MAWB CCR Rates</b>
<form method="post" id="form">
	<input type="hidden" value="73" name="module_no" id="module_no" />

<div class="form-inline col-xs-12 inline_elements">
<!--
	<div class="form-group">
	<input type="button" class="btn btn-danger css_button btn-xs" name="SaveAs" value="Save As" onClick="">
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="ViewAWBList" onclick="" value="View AWB List" />
	</div>
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="ForNewMAWBFormat" onclick="" value="For New MAWB Format" />
	</div>
-->
</div>
<div style="height:25px;width:inherit;"> </div>
<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
	<tr>
		<!--
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>">Edit</th>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
		-->
	<th>Commodity Code</th>
	<th>Rate Type Apply</th>
	<th>Percent of Apply Rate</th>
	</tr>
</thead>	

<tbody>
<?php
	//MAWB STOCK ENTRY QUERY
	$sql = "SELECT * FROM mawb_ccr_rate ORDER BY comm_code";
	$qry = sybase_query($sql);

	while($row = sybase_fetch_array($qry)){
?>
<tr>
	<!--<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>"><a class="hover_row" href="edit.php?getValiD=<?php echo @$row['comm_code'];?>">Edit<a/></td>
	<td style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>"><input type="checkbox" value="<?php echo @$row['comm_code']; ?>" name="checkbox[]" class="highlight_row"/></td>
	-->
	<td><?php echo $row['comm_code'];?></td>
	<td><?php echo $row['rate_apply'];?></td>
	<td><?php echo $row['rate_percent'];?></td>
</tr>
<?php
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