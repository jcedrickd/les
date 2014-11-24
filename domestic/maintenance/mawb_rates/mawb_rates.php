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
//open lookup for carrier list-->
        function open_carrier_list(id_name){
        window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/domestic/carrier_list.php?id_name="+id_name,"_blank","height=300,width=500, status=yes,toolbar=no,menubar=no,location=no"); 
        document.getElementById(id_name).focus();
        }

        function open_destination_origin_list(id_name){
        window.open("http://<?php echo $_SERVER['SERVER_NAME'];?>/les/includes/lookup/domestic/destination_origin_list.php?id_name="+id_name,"_blank","height=400,width=700, status=yes,toolbar=no,menubar=no,location=no"); 
        document.getElementById(id_name).focus();
        }
</script>
</head>

<body>		
<div id="wrapper">
<b class="module">MAWB Rates</b>
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
-->
	<div class="form-group">
	<input type="submit" class="btn btn-danger css_button btn-xs" name="Retrieve" onclick="" value="Retrieve" />
	</div>
</div>
<div style="height:25px;width:inherit;"> </div><br/>
<div style="float:left;">
<!-- Inline Form Table-->
	<fieldset style="float:left;">

<div><label class="field">Airline:</label> <input type="text" id="airlineCode" class="input" name="airlineCode"/>
<!-- LookUP Button-->
<input type="button" class="btn btn-search btn-xs" onClick="open_carrier_list('airlineCode');return false;" />
<input type="text" class="input" name="airlinedesc" readonly="readonly"/></div>

<div><label class="field">Origin:</label> <input type="text" class="input" id="originCode" name="originCode"/>
<!-- LookUP Button-->
<input type="button" class="btn btn-search btn-xs" onClick="open_destination_origin_list('originCode');return false;" />
<input type="text" class="input" name="origindesc" readonly="readonly"/></div>

<div><label class="field">Destination:</label> <input type="text" class="input" id="destinationCode" name="destinationCode"/>
<!-- LookUP Button-->
<input type="button" class="btn btn-search btn-xs" onClick="open_destination_origin_list('destinationCode');return false;" />
<input type="text" class="input" name="destinationdesc" readonly="readonly"/></div>
	</fieldset><br/>
<!-- Table -->
	<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
	<tr>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_update; ?>">Edit</th>
	<th style="<?php echo @$posted_table.' '.@$cancelled_table; ?>" class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
	<th>Commodity Code</th>
	<th>Wt. Break</th>
	<th>Rate</th>
	<th>Curr</th>
	</tr>
</thead>	

<tbody>
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