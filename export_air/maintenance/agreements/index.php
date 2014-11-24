<?php

define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."db_connect.php");
require_once(__CORE__."common_functions.php");
$sybase	= new db_connect('boss');

$table			= "bb_agreement";
$display_msg	= "";
if (isset($_POST['submit']))
{
$agent				= isset($_POST['agent']) ? validate_input($_POST['agent']) : "";
$inbound_per_hawb	= isset($_POST['inbound_per_hawb']) ? validate_input($_POST['inbound_per_hawb']) : "";
$inbound_min		= isset($_POST['inbound_min']) ? validate_input($_POST['inbound_min']) : null;
$inbound_flag		= isset($_POST['inbound_flag']) ? validate_input($_POST['inbound_flag']) : null;
$outbound_per_hawb	= isset($_POST['outbound_per_hawb']) ? validate_input($_POST['outbound_per_hawb']) : null;
$outbound_min		= isset($_POST['outbound_min']) ? validate_input($_POST['outbound_min']) : null;
$outbound_flag		= isset($_POST['outbound_flag']) ? validate_input($_POST['outbound_flag']) : null;
$agt_name			= isset($_POST['agt_name']) ? validate_input($_POST['agt_name']) : null;
$grp_code			= isset($_POST['grp_code']) ? validate_input($_POST['grp_code']) : null;

$oldcode	= isset($_POST['oldcode']) ? ($_POST['oldcode']) : null;
$action		= isset($_POST['action']) ? ($_POST['action']) : null;

$dataValue						= new stdClass();
$dataValue->agent				= $agent;
$dataValue->inbound_per_hawb	= $inbound_per_hawb;
$dataValue->inbound_min			= $inbound_min;
$dataValue->inbound_flag		= $inbound_flag;
$dataValue->outbound_per_hawb	= $outbound_per_hawb;
$dataValue->outbound_min		= $outbound_min;
$dataValue->outbound_flag		= $outbound_flag;
$dataValue->agt_name			= $agt_name;
$dataValue->grp_code			= $grp_code;

	if ($action=='edit')
	{
	if($sybase->update_record($table,$dataValue,"agt_name = '$oldcode'"))
		$display_msg	= "Airport successfully updated.";
	else
		$display_msg	= "Airport updating failed.";
	}
	else
	{
	if($sybase->insert_record($table,$dataValue))
		$display_msg	= "Airport successfully added.";
	else
		$display_msg	= "Airport addition failed.";
	}	
}
elseif (isset($_POST['delete']))
{
	foreach($_POST['code'] as $codeVal)
	{
		$sybase->delete_record($table,"agt_name = '$codeVal'");
	}
	$display_msg	= "Airport(s) successfully deleted.";
}

//$fields	= array('air_code','air_name','air_no','whse_loc');
$sybase->current_page	= isset($_GET['pg']) ? $_GET['pg'] : 1;
$sybase->perpage		= 50; //item per page
$result	= $sybase->get_records($table);
$pages	= $sybase->pages();
$count	= $sybase->itemlist;
$sybase->total_records;
/*
agent
inbound_per_hawb
inbound_min
inbound_flag
outbound_per_hawb
outbound_min
outbound_flag
agt_name
grp_code
*/
?>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once(__CORE__."page_header.html");?>
<body>

<div style="float:left" id="table">
<div style="height:5px;width:inherit;"></div>
<div class="form-inline col-xs-12">
<div style="height:5px;width:inherit;"></div>
<form method='POST' onsubmit="return checkDelete()">
<p align="center"><?php echo $display_msg?></p>
<button type="button" class="btn btn-danger css_button btn-xs <?php //echo @$access_add; ?>" data-toggle="modal" data-target="#myModal">Add</button>

<span><input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_delete; ?>" name="delete" value="Delete" id="delete" <?php //echo @$delete_disabled; ?> /></span>
<span><input type="button" id="editbutton" class="btn btn-danger css_button btn-xs" name="edit" value="Edit" id="edit" <?php //echo @$view_tariff_disabled; ?> /></span>
</div>
<!-- Button trigger modal -->
<br />
<br />

<div style="height:25px;width:inherit;"> </div>
<p><?php echo $pages ?></p>
<div style="float:left;">   
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
    <tr>
	<th></th>
	<th>Outbound Code</th>
	<th>Inbound Code</th>
	<th>Agent</th>
	<th>IA per HAWB</th>
	<th>IA Min</th>
	<th>IA Remarks</th>
	<th>EA per HAWB</th>
	<th>EA Min</th>
	<th>EA Remarks</th>
    </tr>
</thead>
<tbody>
<!--tr id="booking_charges_from_csr"></tr-->
<?php
$tbody	= "";
foreach ($result as $resultVal)
{
	$inboundFlag	= ($resultVal->inbound_flag == 'A') ? "All Shipments" : (($resultVal->inbound_flag == 'R') ? "Routed" : ($resultVal->inbound_flag == 'N') ? "Non-routed" : "");
	$outboundFlag	= ($resultVal->outbound_flag == 'A') ? "All Shipments" : (($resultVal->outbound_flag == 'R') ? "Routed" : ($resultVal->outbound_flag == 'N') ? "Non-routed" : "");
	$count++;
	$tbody	.= "<tr onclick=\"'test'\">";
	$tbody	.= "<td><input type='checkbox' name='code[]' class='highlight_row checkbox' onclick='updateEditBox(this.value)' value='$resultVal->agt_name'/></td>";
	//$tbody	.= "<td>$count</td>";
	$tbody	.= "<td>$resultVal->grp_code</td>";
	$tbody	.= "<td>$resultVal->agent</td>";
	$tbody	.= "<td>$resultVal->agt_name</td>";
	$tbody	.= "<td>$resultVal->inbound_per_hawb</td>";
	$tbody	.= "<td>$resultVal->inbound_per_hawb</td>";
	$tbody	.= "<td>$inboundFlag</td>";
	$tbody	.= "<td>$resultVal->outbound_per_hawb</td>";
	$tbody	.= "<td>$resultVal->outbound_min</td>";
	$tbody	.= "<td>$outboundFlag</td>";
	$tbody	.= "</tr>";
}
$tbody	.= "</form>";

echo $tbody;
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
</table></div>
<p>Total No. of Records: <?php echo $sybase->num_rows($result) ?></p>

</div>
<input type="hidden" id="editBox" value=""/> 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new Airline</h4>
      </div>
	  <form role="form" method="POST">
      <div class="modal-body">
	  <!-- start body -->
	  

			<div class='form-group'>
				<label class="field">Agent :</label>
				<input type="text" name="agt_name" value="" class="input bigtxt" placeholder="" id="agt_name" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Outbound Code :</label>
				<input type="text" name="grp_code" value="" class="input bigtxt" placeholder="" id="grp_code" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Inbound Code :</label>
				<input type="text" name="agent" value="" class="input bigtxt" placeholder="" id="agent" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">IA per HAWB :</label>
				<input type="text" name="inbound_per_hawb" value="" class="input bigtxt" placeholder="" id="inbound_per_hawb" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">IA Min :</label>
				<input type="text" name="inbound_min" value="" class="input bigtxt" placeholder="" id="inbound_min" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">IA Remarks :</label>
				<select name="inbound_flag" id="inbound_flag">
					<option	value=""></option>
					<option value="A">All Shipments</option>
					<option value="R">Routed</option>
					<option value="N">Non-routed</option>
				</select>
			</div>
			<div class='form-group'>
				<label class="field">EA per HAWB :</label>
				<input type="text" name="outbound_per_hawb" value="" class="input bigtxt" placeholder="" id="outbound_per_hawb" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">EA Min :</label>
				<input type="text" name="outbound_min" value="" class="input bigtxt" placeholder="" id="outbound_min" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">EA Remarks :</label>
				<select name="outbound_flag" id="outbound_flag">
					<option	value=""></option>
					<option value="A">All Shipments</option>
					<option value="R">Routed</option>
					<option value="N">Non-routed</option>
				</select> 
			</div>
			
			<input type="hidden" name="action" value="add" id="action"/>
			<input type="hidden" name="oldcode" value="" id="oldcode"/>
		
		<!-- end body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger css_button btn-xs" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger css_button btn-xs" value="Save" name="submit"/>
      </div>
	  </form>
    </div>
  </div>
</div>

<script>
function checkDelete()
{
	var r	= confirm("Are you sure to delete selected item(s)?");
	if (r == true)
		return true;
	else
		return false;
}

function updateEditBox(value)
{
var checkedValue = document.querySelector('.checkbox:checked').value;
	document.getElementById('editBox').value = checkedValue;
}

$(document).ready(function(){

$('#editbutton').click(function(e){
var code	= document.getElementById('editBox').value;
if (code == '')
{
	alert('Please select 1 item.');
}
else
	$('#myModal').modal('show');
$.post('http://<?php echo $_SERVER['SERVER_NAME']?>/les/export_air/maintenance/ajax/ajaxlib.php',{code : code, table : '<?php echo $table ?>' ,type : 'listData',condition : "agt_name = '" + code + "'"},function(data){
var det = data.split('|');

document.getElementById('agent').value = det[0];
document.getElementById('inbound_per_hawb').value	 = det[1];
document.getElementById('inbound_min').value		 = det[2];
document.getElementById('inbound_flag').value		 = det[3];
document.getElementById('outbound_per_hawb').value	 = det[4];
document.getElementById('outbound_min').value		 = det[5];
document.getElementById('outbound_flag').value		 = det[6];
document.getElementById('agt_name').value			 = det[7];
document.getElementById('grp_code').value			 = det[8];

document.getElementById('oldcode').value = det[0];
document.getElementById('action').value = "edit";
});


});


});



</script>
<?php include_once(__CORE__."page_footer.html");?>
