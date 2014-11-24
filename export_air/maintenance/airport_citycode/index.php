<?php

define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."db_connect.php");
require_once(__CORE__."common_functions.php");
$sybase	= new db_connect('boss');


$display_msg	= "";
if (isset($_POST['submit']))
{
$aircode		= isset($_POST['aircode']) ? validate_input($_POST['aircode']) : "";
$airportname	= isset($_POST['airportname']) ? validate_input($_POST['airportname']) : "";
$ctry			= isset($_POST['ctry']) ? validate_input($_POST['ctry']) : null;
$area			= isset($_POST['area']) ? validate_input($_POST['area']) : null;

$oldcode	= isset($_POST['oldcode']) ? ($_POST['oldcode']) : null;
$action		= isset($_POST['action']) ? ($_POST['action']) : null;

$dataValue	= new stdClass();
$dataValue->airport_code	= $aircode;
$dataValue->airport_desc	= $airportname;
$dataValue->ctry			= $ctry;
$dataValue->carea			= $area;

	if ($action=='edit')
	{
	if($sybase->update_record("airport_code",$dataValue,"airport_code = '$oldcode'"))
		$display_msg	= "Airport successfully updated.";
	else
		$display_msg	= "Airport updating failed.";
	}
	else
	{
	if($sybase->insert_record("airport_code",$dataValue))
		$display_msg	= "Airport successfully added.";
	else
		$display_msg	= "Airport addition failed.";
	}	
}
elseif (isset($_POST['delete']))
{
	foreach($_POST['code'] as $codeVal)
	{
		$sybase->delete_record('airport_code',"airport_code = '$codeVal'");
	}
	$display_msg	= "Airport(s) successfully deleted.";
}

//$fields	= array('air_code','air_name','air_no','whse_loc');
$result	= $sybase->get_records('airport_code');
//
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
<div style="float:left;">   
<table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead>
    <tr>
	<th></th>
	<th>CODE</th>
	<th>AIRPORT NAME</th>
	<th>Ctry</th>
	<th>Area</th>
    </tr>
</thead>
<tbody>
<!--tr id="booking_charges_from_csr"></tr-->
<?php
$tbody	= "";
$count	= 0;
foreach ($result as $resultVal)
{
$count++;
	$tbody	.= "<tr>";
	$tbody	.= "<td><input type='checkbox' name='code[]' class='highlight_row checkbox' onclick='updateEditBox(this.value)' value='$resultVal->airport_code'/></td>";
	$tbody	.= "<td>$resultVal->airport_code</td>";
	$tbody	.= "<td>$resultVal->airport_desc</td>";
	$tbody	.= "<td>$resultVal->ctry</td>";
	$tbody	.= "<td>$resultVal->carea</td>";
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
				<label class="field">Airport Code :</label>
				<input type="text" name="aircode" value="" class="input bigtxt" placeholder="" id="aircode" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Airport Name :</label>
				<input type="text" name="airportname" value="" class="input bigtxt" placeholder="" id="airportname" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Ctry :</label>
				<input type="text" name="ctry" value="" class="input bigtxt" placeholder="" id="ctry" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Area :</label>
				<textarea name="area" class="input bigtxt" id="area"></textarea> 
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
$.post('http://<?php echo $_SERVER['SERVER_NAME']?>/les/export_air/maintenance/ajax/ajaxlib.php',{code : code, table : 'airport_code' ,type : 'listData',condition : "airport_code = '" + code + "'"},function(data){
var det = data.split('|');
document.getElementById('aircode').value = det[0];
document.getElementById('airportname').value = det[1];
document.getElementById('ctry').value = det[2];
document.getElementById('area').value = det[3];

document.getElementById('oldcode').value = det[0];
document.getElementById('action').value = "edit";
});


});


});



</script>
<?php include_once(__CORE__."page_footer.html");?>
