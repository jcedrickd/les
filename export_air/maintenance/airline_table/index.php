<?php

define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."db_connect.php");
require_once(__CORE__."common_functions.php");
$sybase	= new db_connect('boss');


$display_msg	= "";
if (isset($_POST['submit']))
{
$aircode		= isset($_POST['aircode']) ? validate_input($_POST['aircode']) : "";
$airprefix	= isset($_POST['airprefix']) ? validate_input($_POST['airprefix']) : "";
$airname	= isset($_POST['airname']) ? validate_input($_POST['airname']) : null;
$address1	= isset($_POST['address1']) ? validate_input($_POST['address1']) : null;
$address2	= isset($_POST['address2']) ? validate_input($_POST['address2']) : null;
$address3	= isset($_POST['address3']) ? validate_input($_POST['address3']) : null;

$commision	= isset($_POST['commision']) ? ($_POST['commision']) : null;
$warn		= isset($_POST['warn']) ? ($_POST['warn']) : null;
$warehouse	= isset($_POST['warehouse']) ? validate_input($_POST['warehouse']) : null;

$oldcode	= isset($_POST['oldcode']) ? ($_POST['oldcode']) : null;
$action		= isset($_POST['action']) ? ($_POST['action']) : null;

$dataValue	= new stdClass();
$dataValue->air_code	= $aircode;
$dataValue->air_no		= $airprefix;
$dataValue->air_name	= $airname;
$dataValue->air_add1	= $address1;
$dataValue->air_add2	= $address2;
$dataValue->air_add3	= $address3;
$dataValue->comm		= $commision;
$dataValue->warn		= $warn;
//$dataValue->cass_trans	= $warn;
$dataValue->whse_loc	= $warehouse;

if ($action=='edit')
{
if($sybase->update_record("air_info",$dataValue,"air_code = '$oldcode'"))
	$display_msg	= "Airline successfully updated.";
else
	$display_msg	= "Airline updating failed.";
}
else
{
if($sybase->insert_record("air_info",$dataValue))
	$display_msg	= "Airline successfully added.";
else
	$display_msg	= "Airline addition failed.";
}	
}
elseif (isset($_POST['delete']))
{
	foreach($_POST['code'] as $codeVal)
	{
		$sybase->delete_record('air_info',"air_code = '$codeVal'");
	}
	$display_msg	= "Airline(s) successfully deleted.";
}

//$fields	= array('air_code','air_name','air_no','whse_loc');
$sybase->current_page	= isset($_GET['pg']) ? $_GET['pg'] : 1;
$sybase->perpage		= 20; //item per page
$result	= $sybase->get_records('air_info');
$pages	= $sybase->pages();
$count	= $sybase->itemlist;
$sybase->total_records;
//$pageinfo	= $sybase->pageinfo;
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
<p><?php echo $pages ?></p>
<form method='POST' onsubmit="return checkDelete()">
<p align="center"><?php echo $display_msg?></p>
<button type="button" class="btn btn-danger css_button btn-xs <?php //echo @$access_add; ?>" data-toggle="modal" data-target="#myModal">Add</button>

<span><input type="submit" class="btn btn-danger css_button btn-xs <?php //echo @$access_delete; ?>" name="delete" value="Delete" id="delete" <?php //echo @$delete_disabled; ?> /></span>
<span><input type="button" data-toggle="modal" data-target="#editModal" class="btn btn-danger css_button btn-xs" name="edit" value="Edit" id="edit" <?php //echo @$view_tariff_disabled; ?> /></span>
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
	<th>A/L Code</th>
	<th>Airline Name</th>
	<th>Prefix</th>
	<th>Address 1</th>
	<th>Address 2</th>
	<th>Whse</th>
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
	$tbody	.= "<td><input type='checkbox' name='code[]' class='highlight_row checkbox' onclick='updateEditBox(this.value)' value='$resultVal->air_code'/></td>";
	$tbody	.= "<td>$resultVal->air_code</td>";
	$tbody	.= "<td>$resultVal->air_name</td>";
	$tbody	.= "<td>$resultVal->air_no</td>";
	$tbody	.= "<td>$resultVal->air_add1</td>";
	$tbody	.= "<td>$resultVal->air_add2</td>";
	$tbody	.= "<td>$resultVal->whse_loc</td>";
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
				<label class="field">Air Code :</label>
				<input type="text" name="aircode" value="" class="input bigtxt" placeholder="" id="aircode" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Air Prefix :</label>
				<input type="text" name="airprefix" value="" class="input bigtxt" placeholder="" id="airprefix" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Air Name.:</label>
				<input type="text" name="airname" value="" class="input bigtxt" placeholder="" id="airname" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 1 :</label>
				<textarea name="address1" class="input bigtxt" id="address1"></textarea> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 2 :</label>
				<textarea name="address2" class="input bigtxt" id="address2"></textarea> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 3 :</label>
				<textarea name="address3" class="input bigtxt" id="address3"></textarea>
			</div>
			<div class='form-group'>
				<label class="field" style="float:left">Commision :</label>
				<input type="text" style="float:left; width: 50px;" name="commision" value="" class="input" placeholder="" id="commision" autocomplete="off" />
				<label class="field" style="float:left; width: 80px; margin-left:0">%&nbsp;&nbsp; Warn at :</label>
				<input type="text" style="float:left; width: 50px;" name="warn" value="" class="input" placeholder="" id="warn" autocomplete="off" />
			</div>
			<div class='form-group' style="clear:both; padding-top: 5px;">
				<label class="field">Warehouse :</label>
				<input type="text" name="warehouse" value="" class="input bigtxt" placeholder="" id="warehouse" autocomplete="off" /> 
			</div>
		
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
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Airline</h4>
      </div>
	  <form role="form" method="POST">
      <div class="modal-body">
	  <!-- start body -->
			<img src="../../../loading.gif" style="display :none" id="loading"/>
			<div class='form-group'>
				<label class="field">Air Code :</label>
				<input type="text" name="aircode" value="" class="input bigtxt" placeholder="" id="aircode_x" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Air Prefix :</label>
				<input type="text" name="airprefix" value="" class="input bigtxt" placeholder="" id="airprefix_x" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Air Name.:</label>
				<input type="text" name="airname" value="" class="input bigtxt" placeholder="" id="airname_x" autocomplete="off" /> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 1 :</label>
				<textarea name="address1" class="input bigtxt" id="address1_x"></textarea> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 2 :</label>
				<textarea name="address2" class="input bigtxt" id="address2_x"></textarea> 
			</div>
			<div class='form-group'>
				<label class="field">Address Line 3 :</label>
				<textarea name="address3" class="input bigtxt" id="address3_x"></textarea>
			</div>
			<div class='form-group'>
				<label class="field" style="float:left">Commision :</label>
				<input type="text" style="float:left; width: 50px;" name="commision" value="" class="input" placeholder="" id="commision_x" autocomplete="off" />
				<label class="field" style="float:left; width: 80px; margin-left:10px">%&nbsp;&nbsp; Warn at :</label>
				<input type="text" style="float:left; width: 50px;" name="warn" value="" class="input" placeholder="" id="warn_x" autocomplete="off" />
			</div>
			<div class='form-group' style="clear:both; padding-top: 5px;">
				<label class="field">Warehouse :</label>
				<input type="text" name="warehouse" value="" class="input bigtxt" placeholder="" id="warehouse_x" autocomplete="off" /> 
			</div>
			<input type="hidden" name="action" value="edit"/>
			<input type="hidden" name="oldcode" value="" id="oldcode"/>
		
		<!-- end body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger css_button btn-xs" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-danger css_button btn-xs" value="Save changes" name="submit"/>
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

$('#editModal').on('shown.bs.modal', function (e) {
  var code	= document.getElementById('editBox').value;
if (code == '')
{
	alert('Please select 1 item.');
	$('#editModal').modal('hide');
}
else
{
$.post('http://<?php echo $_SERVER['SERVER_NAME']?>/les/export_air/maintenance/ajax/ajaxlib.php',{code : code, table : 'air_info' ,type : 'listData',condition : "air_code = '" + code + "'" },function(data){
document.getElementById('loading').style	= "display: inline";
var det = data.split('|');
document.getElementById('aircode_x').value = det[1];
document.getElementById('airprefix_x').value = det[0];
document.getElementById('airname_x').value = det[2];
document.getElementById('address1_x').value = det[3];
document.getElementById('address2_x').value = det[4];
document.getElementById('address3_x').value = det[5];
document.getElementById('commision_x').value = det[6];
document.getElementById('warn_x').value = det[7];
document.getElementById('oldcode').value = det[1];
document.getElementById('warehouse_x').value = det[10];
});
document.getElementById('loading').style	= "display: none";
}
});

});

</script>
<?php include_once(__CORE__."page_footer.html");?>
