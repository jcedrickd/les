<?php
if(isset($_GET['foreign_recno_dbid']) && !isset($_POST['save']) && !isset($_POST['post'])){
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT recno,chg_grp,chg_grp_desc,service_code,service_description,selling_rate,selling_currency,collect_tag,bill_to_code,bill_to_name,
prepared_by,date_prepared,override_by,date_override FROM booking_charges WHERE foreign_recno_dbid=$_GET[foreign_recno_dbid]");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
	<td><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/transaction/job_order_entry/recno.php?recno=<?php echo $row['recno']; ?>&foreign_recno_dbid=<?php echo $_GET['foreign_recno_dbid']; ?>" class="hover_row">Override</a></td>
	<td><input type="checkbox" value="<?php echo @$row['recno']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php echo @$row['chg_grp']; ?></td>
	<td><?php echo @$row['chg_grp_desc']; ?></td>
	<td><?php echo @$row['service_code']; ?></td>
	<td><?php echo @$row['service_description']; ?></td>
	<td><?php echo number_format($row['selling_rate'],2); ?></td>
	<td><?php echo @$row['selling_currency']; ?></td>
	<td><?php echo show_collect_tag($row['collect_tag']); ?></td>
	<td><?php echo @$row['bill_to_code']; ?></td>
	<td><?php echo @$row['bill_to_name']; ?></td>
	<td><?php echo @$row['prepared_by']; ?></td>
	<td><?php echo date("m/d/Y H:i",strtotime($row['date_prepared'])); ?></td>
	<td><?php echo @$row['override_by']; ?></td>
	<td><?php echo date("m/d/Y H:i",strtotime($row['date_override'])); ?></td>
</tr>
<?php 
	}
sybase_free_result($query);
sybase_close($link);    
}
?>
