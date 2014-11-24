<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/transaction/job_order_entry/access.php');
$foreign_recno_dbid= trim(pg_escape_string(strtoupper($_GET["foreign_recno_dbid"])));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT recno,chg_grp,chg_grp_desc,service_code,service_description,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,
prepared_by,date_prepared,override_by,date_override FROM booking_charges WHERE foreign_recno_dbid=$foreign_recno_dbid");
$numrows=sybase_num_rows($query);
?>
<div style="height:5px;width:inherit;"></div>
<div class="form-inline col-xs-12 inline_elements">
<div style="height:5px;width:inherit;"></div>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_insert; ?>" name="add" value="Add" id="add" disabled="disabled" /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs <?php echo @$access_delete; ?>" name="delete" value="Delete" id="delete" disabled="disabled" /></span>
<span><input type="submit" class="btn btn-danger css_button btn-xs" name="get_pcv_cost" value="Get PCV Cost" id="get_pcv_cost" disabled="disabled" /></span>
</div>
<br />
<div style="height:25px;width:inherit;"> </div>
<div style="float:left;"><table style="white-space:nowrap;" id="tfhover" class="tftable" border="1">
<thead><tr>
	<th class="hidable_column <?php echo @$access_update; ?>">Override</th>
	<th class="hidable_column <?php echo @$access_delete; ?>">Delete</th>
	<th>GRP</th>
	<th>Group Description</th>
	<th>CHG</th>
	<th>Charge Description</th>
	<th>Selling Rate</th>
	<th>Currency</th>
	<th>Collect Tag</th>
	<th>Bill To Code</th>
	<th>Bill To Name</th>
	<th>Prepared By</th>
	<th>Date Prepared</th>
	<th>Override By</th>
	<th>Date Override</th>
</tr></thead>
<tbody id="booking_charges_from_csr"></tbody>
<tbody>
		<tr>
<?php
	if($numrows > 0){
		while($row=sybase_fetch_array($query)){
?>
		<td class="hidable_column <?php echo @$access_update; ?>"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/transaction/job_order_entry/recno.php?recno=<?php echo $row['recno']; ?>&foreign_recno_dbid=<?php echo $foreign_recno_dbid; ?>" class="hover_row">Override</a></td>
		<td class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="<?php echo $row['recno']; ?>" name="checkbox[]" class="highlight_row" /></td>
		<td><?php echo $row['chg_grp']; ?></td>
		<td><?php echo $row['chg_grp_desc']; ?></td>
		<td><?php echo $row['service_code']; ?></td>
		<td><?php echo $row['service_description']; ?></td>
		<td><?php echo number_format($row['selling_rate'],2); ?></td>
		<td><?php echo $row['selling_currency']; ?></td>
		<td><?php echo show_collect_tag($row['collect_tag']); ?></td>
		<td><?php echo $row['bill_to_code']; ?></td>
		<td><?php echo $row['bill_to_name']; ?></td>
		<td><?php echo $row['prepared_by']; ?></td>
		<td><?php echo date("m/d/Y H:i",strtotime($row['date_prepared'])); ?></td>
		<td><?php echo $row['override_by']; ?></td>
		<td><?php echo date("m/d/Y H:i",strtotime($row['date_override'])); ?></td>
		</tr>
<?php 
		}
	}else{
?>
		<td class="hidable_column <?php echo @$access_update; ?>"><a href="#" class="hover_row">Override</a></td>
		<td class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="" name="checkbox[]" class="highlight_row" /></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
<?php
	}	
sybase_free_result($query);
sybase_close($link);
?>
		</tbody>
		</table></div>
<p>Total No. of Records: <?php echo number_format($numrows,0); ?></p>
<?php
function show_collect_tag($collect_tag){
switch(pg_escape_string(trim($collect_tag))){
case 'C':
echo 'Collect';
break;
case 'P':
echo 'Prepaid';
break;
default: echo '';
	}
}

?>