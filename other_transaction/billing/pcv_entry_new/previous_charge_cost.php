<?php
if(isset($_GET['pcv_no']) && !isset($_POST['save']) && !isset($_POST['post'])){ 
include($_SERVER['DOCUMENT_ROOT'].'les/includes/sybase_connect.php'); 
$query=sybase_query("SELECT * FROM pcv_dtl WHERE pcv_no='$_GET[pcv_no]'");
$numrows=sybase_num_rows($query);
	while($row=sybase_fetch_array($query)){
?>
	<td style="<?php echo $hide_column; ?>" class="hidable_column <?php echo @$access_update; ?>"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/les/other_transaction/billing/pcv_entry_new/pcvdtl_ctrlno.php?pcvdtl_ctrlno=<?php echo @$row['pcvdtl_ctrlno']; ?>" class="hover_row">Override</a></td>
	<td style="<?php echo $hide_column; ?>" class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="<?php echo @$row['pcvdtl_ctrlno']; ?>" name="checkbox[]" class="highlight_row" /></td>
	<td><?php echo @$row['job_order_no']; ?></td>
        <td><?php echo @$row['chg_code']; ?></td>
        <td><?php echo @$row['chg_desc']; ?></td>
        <td><?php echo @$row['grp_code']; ?></td>
        <td><?php echo @$row['grp_desc']; ?></td>
        <td><?php echo number_format(@$row['php_cost'],2); ?></td>
        <td><?php echo number_format(@$row['usd_cost'],2); ?></td>
        <td><input type="checkbox" name="receipted_exp" value="<?php echo @$row['receipted_exp']; ?>" <?php echo show_receipted_exp(@$row['receipted_exp']); ?> onclick="return false;" /></td>
        <td><?php echo show_pcv_type(@$row['cash']); ?></td>
        <td><?php echo @$row['check_bp']; ?></td>
</tr>
<?php 
	}
sybase_free_result($query);
sybase_close($link);
}
?>