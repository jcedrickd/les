<?php 
define('__CORE__',dirname(dirname(dirname(dirname(__FILE__)))) . '\includes\\');
require_once(__CORE__."db_connect.php");
require_once(__CORE__."common_functions.php");
$sybase	= new db_connect('boss');
session_start(); 
include_once($_SERVER['DOCUMENT_ROOT'].'les/includes/verifylogin.php');
include_once(__CORE__."page_header.html");


$date= isset($_POST['ConversDate']) ? validate_input($_POST['ConversDate']) : "";
$condition = "";

if(isset($_POST['Retrieve'])){
	$condition	= "(ct.effect_date <= '$date') AND (ct.effect_date_to >= '$date') ORDER BY ct.curr_code ASC";
}
$table	= "conversion_table ct";

$fields	= array(
				'ct.effect_date',
				'ct.curr_code',
				'ct.effect_date_to',
				'ct.usd_php',
				'ct.add_edit',
				'ct.add_date',
				'ct.add_time',
				'ct.curr_usd',
				'ct.curr_desc',
				'ct.curr_usdx',
				'ct.curr_apply',
				'ct.convtable_ctrlno');
$tableJoin	= "";
$result	= $sybase->get_records($table,$fields,$condition,$tableJoin);
$display	= "";
 foreach ($result as $resultVal)
{
	$effdate	= date("m/d/Y",strtotime($resultVal->effect_date));
	$currcode	= $resultVal->curr_code;
	$edddateto	= date("m/d/Y",strtotime($resultVal->effect_date_to));
	$addedit	= $resultVal->add_edit;
	$adddate	= date("m/d/Y",strtotime($resultVal->add_date));
	$addtime	= date("H:i",strtotime($resultVal->add_time));
	$currdesc	= $resultVal->curr_desc;
	$usdphp		= number_format($resultVal->usd_php,2);
	$currusd	= number_format($resultVal->curr_usd,4);
	$currusdx	= number_format($resultVal->curr_usdx,4);
	$currapply	= $resultVal->curr_apply;
	$ctrlno		= $resultVal->convtable_ctrlno;
	
	$display	.= "<tr>";
	$display	.= "<td><input type='checkbox' name='checkbox[]' class='highlight_row' value='$ctrlno' /></td>";
    $display	.= "<td>$currcode</td>";
	$display	.= "<td>$currdesc</td>";
	$display	.= "<td>$currusd</td>";
	$display	.= "<td>$currusdx</td>";
	$display	.= "<td>$usdphp</td>";
	$display	.= "<td>$effdate</td>";
	$display	.= "<td>$edddateto</td>";
	$display	.= "<td>$currapply</td>";
	$display	.= "<td><b>$addedit</b></td>";
	$display	.= "<td><b>$adddate</b></td>";
	$display	.= "<td><b>$addtime</b></td>";
	$display	.= "</tr>";
}
?>

<body>
<div id="wrapper">
<b class="module">Conversion Rate Setup</b>
<span id="inputError"><?php include_once('logic.php'); ?></span>
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
	<button class="btn btn-danger css_button btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
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
	<th></th>
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
<?php echo $display?>
</tbody>

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